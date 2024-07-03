<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $web = 'tbl'; 

        if($web == 'tbl'){
            return view('tbl.intranet.home');
        }

        return view('home');
    }

    public function misCompras(){
        //
        return view('adminMarket/misCompras');
    }

    public function getMisCompras(){
        $misCompras = Compras::where('user_id', Auth::id())
        ->with('productos', 'productos.producto')
        ->orderBy('id', 'desc')
        ->get();
        return response()->json($misCompras);
    }
}
