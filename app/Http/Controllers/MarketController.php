<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

use App\Models\Productos;


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

    public function carro(){
        return view('market/carro');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (\Illuminate\Support\Facades\Auth::check()) {
            // El usuario está autenticado, agrega el producto al carrito en la base de datos
            // Aquí puedes agregar la lógica para almacenar el producto en la base de datos
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

        return response()->json(['message' => 'Producto añadido al carrito', 'cantidad' => $quantity]);
    }
    
    public function getCart()
    {
        $carts = session()->get('cart', []);

        $carrito = [];
        foreach($carts as $key => $value){
            $producto = Productos::find($key);
            $producto->cantidad = $value;
            $carrito[] = $producto;
        }
        return response()->json($carrito);
    }

    public function deleteCart($id) {
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

    
}