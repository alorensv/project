<?php

use App\Http\Controllers\AdminMarketController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.inicio');
})->name('inicio');

Route::get('/paginaWeb', function () {
    return view('pages.paginaWeb');
})->name('web');

Route::get('/desarrolloWeb', function () {
    return view('pages.desarrolloWeb');
})->name('desarrollo');

Route::get('/portafolio', function () {
    return view('pages.portafolio');
})->name('portafolio');

Route::get('/generarQr', function () {
    return view('pages.generarQr');
})->name('generarQr');

Route::get('/contacto', function () {
    return view('pages.contacto');
})->name('contacto');

Route::post('/enviarEmail', [WebController::class, 'store'])->name('enviarEmail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/** MARKET DIVISION */
Route::get('/market', [MarketController::class, 'show'])->name('market');;
Route::get('/getProductos', [MarketController::class, 'getProductos']); 
Route::get('/getCategorias', [MarketController::class, 'getCategorias']); 
Route::get('/getSubcategorias/{idCategoria}', [MarketController::class, 'getSubcategorias'])->name('getSubcategorias');
Route::get('/detalle/{id}', [MarketController::class, 'detalle'])->name('detalle');
Route::post('/add-to-cart', [MarketController::class, 'addToCart'])->name('cart.add');
Route::get('/get-cart', [MarketController::class, 'getCart'])->name('cart.get');
Route::get('/carro', [MarketController::class, 'carro'])->name('carro');
Route::post('/deleteCart/{id}', [MarketController::class, 'deleteCart'])->name('deleteCart');
Route::post('/updateCart/{id}', [MarketController::class, 'updateCart'])->name('updateCart');

/* anexos */
Route::get('/existeUsuario/{email}', [RegisterController::class, 'existeUsuario'])->name('existeUsuario');
Route::post('/agregarDireccion', [MarketController::class, 'agregarDireccion'])->name('agregarDireccion');
Route::get('/getUserDirecciones', [MarketController::class, 'getUserDirecciones'])->name('getUserDirecciones');

Route::get('/regiones', [MarketController::class, 'regiones'])->name('regiones');
Route::get('/comunas/{region}', [MarketController::class, 'comunas'])->name('comunas');


/* ADMIN MARKET PLACE */
Route::get('/productos', [AdminMarketController::class, 'productos'])->name('productos');
Route::post('/agregarProducto', [AdminMarketController::class, 'agregarProducto'])->name('agregarProducto');

/* Route::get('/market', function () {
    return view('pages.market');
})->name('market'); */