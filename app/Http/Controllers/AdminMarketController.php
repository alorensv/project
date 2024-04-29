<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMarketController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function productos()
    {
        return view('adminMarket/productos');
    }

    public function agregarProducto(Request $request){

        $userId = Auth::id();

        $producto = new Productos;
        $producto->nombre = $request->nombre; 
        $producto->descripcion = $request->descripcion; 
        $producto->imagen = $request->imagen;
        $producto->cantidad = $request->cantidad; 
        $producto->costo = $request->costo; 
        $producto->categoria_id = $request->categoria;
        $producto->subcategoria_id = $request->subcategoria; 
        $producto->user_id = $userId;
        if($producto->save()){
            return response()->json(['message' => 'Producto guardado con éxito', 'producto' => $producto]);
        }else{
            return response()->json(['message' => 'error', 'producto' => $producto->save()]);
        }

    }

}
