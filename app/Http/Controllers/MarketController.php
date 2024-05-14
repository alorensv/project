<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Compras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;


use App\Models\Productos;
use App\Models\Subcategorias;
use App\Models\UserDirecciones;
use Illuminate\Support\Facades\Auth;

use Transbank\Webpay\WebpayPlus\Transaction;

class MarketController extends Controller
{
    //

    public function show()
    {
        return view('market/index');
    }

    public function getCategorias(Request $request)
    {

        $datos = Categorias::obtenerCategoriasConSubcategorias();
        //dd($datos);
        return response()->json(['datos' => $datos]);
    }

    public function getSubcategorias($idCategoria)
    {

        // Buscar todas las subcategorías con el ID de categoría proporcionado
        $subcategorias = Subcategorias::where('categoria_id', $idCategoria)->get();

        // Devolver las subcategorías como respuesta JSON
        return response()->json($subcategorias);
    }

    public function getProductos(Request $request)
    {
        // Obtener subcategorias del request
        $subcategorias = $request->input('subcategorias');

        if (empty($subcategorias)) {
            $productos = Productos::all();
        } else {
            $productos = Productos::whereIn('subcategoria_id', $subcategorias)->get();
        }

        return response()->json(['message' => 'Productos disponibles', 'productos' => $productos]);
    }


    public function detalle($id)
    {
        // Obtener el contenido del carrito de la sesión
        $cart = session()->get('cart', []);
        $producto = Productos::find($id);

        return view('market/detalle', ['producto' => $producto, 'cart' => $cart]);
    }

    public function carro()
    {
        return view('market/carro');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (\Illuminate\Support\Facades\Auth::check()) {
            $cart = session()->get('cart', []);

            // Verifica si el producto ya está en el carrito
            if (array_key_exists($productId, $cart)) {
                // Si el producto ya está en el carrito, actualiza la cantidad
                $cart[$productId] += $quantity;
            } else {
                // Si el producto no está en el carrito, añádelo
                $cart[$productId] = $quantity;
            }

            session()->put('cart', $cart);
        } else {
            // El usuario no está autenticado, agrega el producto al carrito en la sesión
            $cart = session()->get('cart', []);

            // Verifica si el producto ya está en el carrito
            if (array_key_exists($productId, $cart)) {
                // Si el producto ya está en el carrito, actualiza la cantidad
                $cart[$productId] += $quantity;
            } else {
                // Si el producto no está en el carrito, añádelo
                $cart[$productId] = $quantity;
            }

            session()->put('cart', $cart);

            //$cart = session()->get('cart');
            //dd($cart);
        }

        return response()->json(['message' => 'Producto añadido al carrito', 'carro' => $cart]);
    }

    public function updateCart(Request $request)
    {
        $itemId = $request->itemId;
        $action = $request->action; // 'increment' o 'decrement'

        $cart = session()->get('cart', []);

        // Verifica si el producto ya está en el carrito
        if (array_key_exists($itemId, $cart)) {
            // Si el producto ya está en el carrito, actualiza la cantidad

            if ($action === 'increment') {
                $cart[$itemId] += 1;
            } elseif ($action === 'decrement') {
                $cart[$itemId] -= 1;
                if ($cart[$itemId] < 1) {
                    // Si la cantidad es menor que 1, elimina el producto del carrito
                    unset($cart[$itemId]);
                }
            }
        } else {
            // Si el producto no está en el carrito, añádelo
            //error
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function getCart()
    {
        $carts = session()->get('cart', []);

        $carrito = [];
        foreach ($carts as $key => $value) {
            $producto = Productos::find($key);
            $producto->cantidad = $value;
            $carrito[] = $producto;
        }
        return response()->json($carrito);
    }

    private function getTotalamountCart(){
        $productos = $this->getCart();
        $amount = 0;
        foreach($productos->getData() as $producto){
            $amount = $amount + ($producto->costo * $producto->cantidad);
        } 

        return $amount;
    }

    public function deleteCart($id)
    {
        try {
            // Aquí debes escribir la lógica para eliminar el producto del carrito
            // Por ejemplo, si estás almacenando el carrito en la sesión, podrías hacer algo como esto:
            $cart = session()->get('cart', []);
            unset($cart[$id]);
            session()->put('cart', $cart);

            // Si estás usando una base de datos, podrías hacer algo como esto:
            // $producto = Producto::find($id);
            // $producto->delete();

            // Después de eliminar el producto, puedes redirigir a la página del carrito o devolver una respuesta JSON
            return response()->json(['message' => 'Producto eliminado del carrito correctamente'], 200);
        } catch (\Exception $e) {
            // Manejar cualquier error que ocurra durante la eliminación del producto
            return response()->json(['message' => 'Error al eliminar el producto del carrito'], 500);
        }
    }

    public function regiones()
    {
        $rutaArchivo = resource_path('data/regiones.json');
        $regiones = json_decode(File::get($rutaArchivo), true);

        return $regiones;
    }

    public function comunas($region)
    {
        $response = Http::get("https://apis.digital.gob.cl/dpa/regiones/{$region}/comunas");

        return $response->json();
    }

    public function agregarDireccion(Request $request)
    {

        //$data = $request->json()->all();
        // Obtener el ID del usuario logeado
        $userId = Auth::id();
        // Crear una nueva instancia de UserDireccion y asignar el user_id
        $userDireccion = new UserDirecciones();
        $userDireccion->region = $request->input('region');
        $userDireccion->comuna = $request->input('comuna');
        $userDireccion->codigo_postal = $request->input('codigo_postal');
        $userDireccion->direccion = $request->input('direccion');
        $userDireccion->user_id = $userId; // Asignar el ID del usuario logeado
        $userDireccion->save();

        return response()->json(['message' => 'request', 'userDireccion' => $userDireccion]);
    }

    public function getUserDirecciones()
    {
        $userId = Auth::id();
        $userDirecciones = UserDirecciones::where('user_id', $userId)->get();

        return response()->json(['message' => 'request', 'userDirecciones' => $userDirecciones]);
    }

    public function pagar()
    {        
        $amount = $this->getTotalamountCart();
        $message = null;

        $order = new Compras();
        $order->user_id =  Auth::id();
        $order->forma_pago_id = 1; 
        $order->monto = $amount;
        $order->estado = Compras::ESTADO_COTIZANDO;
        $order->user_direccion_id = 1; 
        $order->save();

        $message .= 'init';
        $buy_order = $order->id;
        $session_id = Auth::id();
        $return_url = url('/getResult');
        $type = "sandbox";
        $data = '{
                    "buy_order": "' . $buy_order . '",
                    "session_id": "' . $session_id . '",
                    "amount": ' . $amount . ',
                    "return_url": "' . $return_url . '"
                }';
        $method = 'POST';
        $endpoint = '/rswebpaytransaction/api/webpay/v1.0/transactions';

        $response = $this->get_ws($data, $method, $type, $endpoint);
        $message .= "<pre>";
        $message .= print_r($response, TRUE);
        $message .= "</pre>";
        $url_tbk = $response->url;
        $token = $response->token;
        $submit = 'Continuar!';

        return view('market/pago', ['message' => $message, 'url_tbk' => $url_tbk, 'token' => $token, 'submit' => $submit]);

        // Host: https://webpay3gint.transbank.cl
        // Tbk-Api-Key-Id: Código de comercio
        // Tbk-Api-Key-Secret: Llave secreta
        // Content-Type: application/json

        // SDK Versión 2.x
        // El SDK apunta por defecto al ambiente de pruebas, no es necesario configurar lo siguiente
        //\Transbank\Webpay\WebpayPlus::configureForIntegration('597055555532', '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C');

        // Si deseas apuntar a producción: 
        //\Transbank\Webpay\WebpayPlus::configureForProduction('tu-codigo-comercio', 'tu-api-key');
        // SDK Versión 2.x      
        //$response = (new Transaction)->create($buy_order, $session_id, $amount, $return_url);
        // 1) Inicia un cobro por $1.500 CLP con Webpay Plus
        //$response = Transaction::create('OrdenCompra123', 'MyOptionalSessionId', 1500, 'http://example.com/webpay/return');
        // 2) Redirige al usuario a transbank a $response->getUrl() con el token $response->getToken() 🚀
        // 3) Confirma la transacción cuando el usuario vuelva
        //$response = Transaction::commit($token);
    }

    public function getResult()
    {
        if (!isset($_POST["token_ws"])) die;
        /** Token de la transacción */
        $token = filter_input(INPUT_POST, 'token_ws');
        $request = array(
            "token" => filter_input(INPUT_POST, 'token_ws')
        );

        $data = '';
        $method = 'PUT';
        $type = 'sandbox';
        $endpoint = '/rswebpaytransaction/api/webpay/v1.0/transactions/' . $token;
        $response = $this->get_ws($data, $method, $type, $endpoint);
        return view('market/getResult', ['response' => $response]);
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
        $endpoint = '/rswebpaytransaction/api/webpay/v1.0/transactions/' . $token;

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
        $endpoint = '/rswebpaytransaction/api/webpay/v1.0/transactions/' . $token . '/refunds';

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
            $url = "https://webpay3g.transbank.cl" . $endpoint; //Live
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
