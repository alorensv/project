<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\CompraProductos;
use App\Models\Compras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;


use App\Models\Productos;
use App\Models\Subcategorias;
use App\Models\User;
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

    public function existeUsuario(Request $request){
        $email = $request->input('correo');
        
        $user = User::where('email', $email)->first();
         if(empty($user)){
             return response()->json(['message' => 'error', 'email' => $email]);
         }else{
             return response()->json(['message' => 'ok', 'user' => $user]);
         }
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
            //$productos = Productos::where('cantidad', '>', 0)->get();
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

            $producto = Productos::find($itemId);

            if ($action === 'increment') {
                if($cart[$itemId] < $producto->cantidad){
                    $cart[$itemId] += 1;
                }
                
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
        $carrito = Compras::getSessionCart();
        return response()->json($carrito);
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

        $is_default = $request->input('is_default') ? 1 : 0;
        if($is_default == 1){
            $userDirecciones = UserDirecciones::where('user_id', $userId)->get();
            foreach ($userDirecciones as $direccion) {
                $direccion->is_default = 0;
                $direccion->save();
            }
        }

        $userDireccion = new UserDirecciones();
        $userDireccion->region = $request->input('region');
        $userDireccion->comuna = $request->input('comuna');
        $userDireccion->codigo_postal = $request->input('codigo_postal');
        $userDireccion->direccion = $request->input('direccion');
        $userDireccion->user_id = $userId; // Asignar el ID del usuario logeado
        $userDireccion->nombre_contacto = $request->input('nombre_contacto');
        $userDireccion->fono_contacto = $request->input('fono_contacto');
        $userDireccion->is_default = $is_default;
        $userDireccion->save();

        return response()->json(['message' => 'request', 'userDireccion' => $userDireccion]);
    }

    public function getUserDirecciones()
    {
        $userId = Auth::id();
        $userDirecciones = UserDirecciones::where('user_id', $userId)->get();

        return response()->json(['message' => 'request', 'userDirecciones' => $userDirecciones]);
    }

    public function updateDireccionPredeterminada($id){
        $userId = Auth::id();
        $userDirecciones = UserDirecciones::where('user_id', $userId)->get();
        foreach ($userDirecciones as $direccion) {
            $direccion->is_default = ($direccion->id == $id)?  1 : 0;
            $direccion->save();
        }
        return response()->json(['message' => 'ok']);
    }

}
