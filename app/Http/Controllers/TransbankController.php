<?php

namespace App\Http\Controllers;

use App\Mail\NotificarFirma;
use App\Models\CompraProductos;
use App\Models\Compras;
use App\Models\LexCompra;
use App\Models\LexCompraServicio;
use App\Models\LexFirmanteRedaccionDocumento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransbankController extends Controller
{
    //

    public function pagar()
    {
        $order = Compras::saveCompras(Auth::id());

        $buy_order = $order->id;
        $session_id = $order->user_id;
        $return_url = url('/getResult');
        $type = "sandbox";
        $data = '{
                    "buy_order": "' . $buy_order . '",
                    "session_id": "' . $session_id . '",
                    "amount": ' . $order->monto . ',
                    "return_url": "' . $return_url . '"
                }';
        $method = 'POST';
        $endpoint = '/rswebpaytransaction/api/webpay/v1.0/transactions';

        $response = $this->get_ws($data, $method, $type, $endpoint);
        $url_tbk = $response->url;
        $token = $response->token;

        return view('market/pago', ['url_tbk' => $url_tbk, 'token' => $token]);
    }

    public function lexPagar(Request $request)
    {
        $user_id = auth()->check() ? auth()->id() : null;
        $guest_id = null;
        $selectedItems = $request->input('selectedItems');
        
        if (is_null($user_id)) {
            if (!session()->has('guest_id')) {
                $guest_id = uniqid('guest_', true); // O cualquier identificador único que quieras usar
                session(['guest_id' => $guest_id]);
            }
            $guest_id = session('guest_id');
        }
        $order = LexCompra::saveCompras($user_id, $guest_id, $selectedItems);

        $buy_order = $order->id;
        $session_id = (!empty($order->user_id)) ? $order->user_id : $order->guest_id;
        $return_url = url('/getResult');
        $type = "sandbox";
        $data = '{
                    "buy_order": "' . $buy_order . '",
                    "session_id": "' . $session_id . '",
                    "amount": ' . $order->monto . ',
                    "return_url": "' . $return_url . '"
                }';
        $method = 'POST';
        $endpoint = '/rswebpaytransaction/api/webpay/v1.2/transactions';

        $response = $this->get_ws($data, $method, $type, $endpoint);
        $url_tbk = $response->url;
        $token = $response->token;

        return response()->json(['message' => 'redireccion a transbank', 'url_tbk' => $url_tbk, 'token' => $token]);

        //return view('market/pago', ['url_tbk' => $url_tbk, 'token' => $token]);
    }

    public function getResult()
    {
        if (!isset($_GET["token_ws"])) return redirect()->route('carroCompras');
        /** Token de la transacción */
        $token = filter_input(INPUT_GET, 'token_ws');
        $request = array(
            "token" => filter_input(INPUT_GET, 'token_ws')
        );
        $data = '';
        $method = 'PUT';
        $type = 'sandbox';
        $endpoint = '/rswebpaytransaction/api/webpay/v1.2/transactions/' . $token;
        $response = $this->get_ws($data, $method, $type, $endpoint);
        /** detalles de la compra */
        if (isset($response->buy_order)) {
            $auth = Auth::loginUsingId($response->session_id);
            $compra = LexCompra::find($response->buy_order);
            $compra->estado = LexCompra::ESTADO_PAGADO;
            $compra->ultimos_num_tarjeta = $response->card_detail->card_number;
            $compra->fecha_transaccion = Carbon::parse($response->transaction_date)->format('Y-m-d H:i:s');
            $compra->codigo_auth = $response->authorization_code;
            $compra->codigo_tipo_transaccion = $response->payment_type_code;
            $compra->num_cuotas = $response->installments_number;

            //$compra->response_code = ;
            if ($compra->save()) {
                //$order = Compras::updateCompraTransbank($response);
                $detallesCompra = LexCompraServicio::getServiciosPagadosById($compra->id);
                foreach ($detallesCompra as $redaccion) {


                    $firmantesDoc = LexFirmanteRedaccionDocumento::where('lex_redaccion_id', $redaccion->idRedaccion)->get();

                    $respuestas = [];
                    foreach ($firmantesDoc as $firmaDocumento) {
                        $token = bin2hex(random_bytes(30)); // Genera un token de 60 caracteres
                        $expiration = now()->addDays(5); // Establece la expiración en 5 días a partir de ahora
                        $duration = $expiration->diffInMinutes(now()); // Calcula la duración en minutos

                        $firmaDocumento->token = hash('sha256', $token);
                        $firmaDocumento->expires_at = $expiration;

                        if ($firmaDocumento->save()) {

                            $send = Mail::to([$firmaDocumento->correo, 'alorensv@gmail.com'])->send(new NotificarFirma($firmaDocumento));
                            if ($send) {
                                $respuestas[] = ['status' => 'ok', 'datos' => $firmaDocumento];
                            } else {
                                $respuestas[] = [
                                    'status' => 'error',
                                    'message' => 'No se pudo enviar el correo a ' . $firmaDocumento->correo,
                                    'error' => $send
                                ];
                            }
                        } else {
                            $respuestas[] = ['status' => 'error', 'message' => 'No se pudo guardar el token firmante ' . $firmaDocumento->id];
                        }
                    }//fin token y envio de correo a firmantes
                }
            }
        }

        if (!$auth) {
            return view('lex/market/getResult', [
                'response' => $response,
                'compra' => $compra ?? null,
                'detallesCompra' => $detallesCompra ?? null
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function getStatus()
    {

        $url = "https://webpay3g.transbank.cl/"; //Live
        $url = "https://webpay3gint.transbank.cl/"; //Testing
        $message = null;
        $post_array = false;

        if (!isset($_POST["token_ws"])) die;

        /** Token de la transacción */
        $token = filter_input(INPUT_POST, 'token_ws');

        $request = array(
            "token" => filter_input(INPUT_POST, 'token_ws')
        );

        $data = '';
        $method = 'GET';
        $type = 'sandbox';
        $endpoint = '/rswebpaytransaction/api/webpay/v1.2/transactions/' . $token;

        $response = $this->get_ws($data, $method, $type, $endpoint);

        $message .= "<pre>";
        $message .= print_r($response, TRUE);
        $message .= "</pre>";

        $url_tbk =  url('/refund');
        $submit = 'Refund!';
        return view('market/pago', ['message' => $message, 'url_tbk' => $url_tbk, 'token' => $token, 'submit' => $submit]);
    }

    public function refund()
    {
        $url = "https://webpay3g.transbank.cl/"; //Live
        $url = "https://webpay3gint.transbank.cl/"; //Testing
        $message = null;
        $post_array = false;

        if (!isset($_POST["token_ws"])) die;
        /** Token de la transacción */
        $token = filter_input(INPUT_POST, 'token_ws');

        $request = array(
            "token" => filter_input(INPUT_POST, 'token_ws')
        );
        $amount = 15000;
        $data = '{
                        "amount": ' . $amount . '
                        }';
        $method = 'POST';
        $type = 'sandbox';
        $endpoint = '/rswebpaytransaction/api/webpay/v1.2/transactions/' . $token . '/refunds';

        $response = $this->get_ws($data, $method, $type, $endpoint);

        $message .= "<pre>";
        $message .= print_r($response, TRUE);
        $message .= "</pre>";
        $submit = 'Crear nueva!';
        $url_tbk = url('/detail');

        return view('market/pago', ['message' => $message, 'url_tbk' => $url_tbk, 'token' => $token, 'submit' => $submit]);
    }

    public function detail()
    {
        var_dump($_POST);
    }

    private function get_ws($data, $method, $type, $endpoint)
    {
        $curl = curl_init();
        if ($type == 'live') {
            $TbkApiKeyId = '597055555532';
            $TbkApiKeySecret = '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
            $url = "https://webpay3g.transbank.cll" . $endpoint; //Live
        } else {
            $TbkApiKeyId = '597055555532';
            $TbkApiKeySecret = '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
            $url = "https://webpay3gint.transbank.cl" . $endpoint; //Testing
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Tbk-Api-Key-Id: ' . $TbkApiKeyId . '',
                'Tbk-Api-Key-Secret: ' . $TbkApiKeySecret . '',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        //echo $response;
        return json_decode($response);
    }
}
