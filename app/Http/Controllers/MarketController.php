<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class MarketController extends Controller
{
    //

    public function show()
    {
        $rutaArchivo = resource_path('data/ejemplo.json');
        $datos = json_decode(File::get($rutaArchivo), true);
        return view('market/index')->with('datos', $datos);
    }

    public function getCategorias(Request $request)
    {
        $categoriasSeleccionadas = $request->input('categorias');
        $subcategorias = [];

        $rutaArchivo = resource_path('data/ejemplo.json');
        $datos = json_decode(File::get($rutaArchivo), true);
        
        foreach ($datos['categorias'] as $categoria) {
            foreach ($categoria['subcategorias'] as $subcategoria) {
                $subcategorias[] = $subcategoria;
            }
        }

        return response()->json(['subcategorias' => $subcategorias]);
    }

    public function getProductos(Request $request)
    {
        $subcategoriasSeleccionadas = $request->input('subcategorias');
        $productos = [];

        $rutaArchivo = resource_path('data/ejemplo.json');
        $datos = json_decode(File::get($rutaArchivo), true);
        
        // Verificar si se enviaron subcategorías seleccionadas
        if ($subcategoriasSeleccionadas) {
            foreach ($datos['categorias'] as $categoria) {
                foreach ($categoria['subcategorias'] as $subcategoria) {
                    if (in_array($subcategoria['id'], $subcategoriasSeleccionadas)) {
                        foreach ($subcategoria['productos'] as $producto) {
                            $productos[] = $producto;
                        }
                    }
                }
            }
        } else {
            // Si no se envían filtros, devolver todos los productos
            foreach ($datos['categorias'] as $categoria) {
                foreach ($categoria['subcategorias'] as $subcategoria) {
                    foreach ($subcategoria['productos'] as $producto) {
                        $productos[] = $producto;
                    }
                }
            }
        }
        //dd($productosFiltrados);
        
        
        return response()->json(['message' => 'Producto añadido al carrito', 'productos' => $productos]);
        //return response()->json($productosFiltrados);
    }


    public function detalle($id)
    {
        // Obtener el contenido del carrito de la sesión
        $cart = session()->get('cart', []);

        //dd($cart);
        return view('market/detalle', ['id' => $id, 'cart' => $cart]);
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
    
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart')->with('cart', $cart);
    }

    public function getCart()
{
    $cart = session()->get('cart', []);
    return response()->json($cart);
}

    

    
}
