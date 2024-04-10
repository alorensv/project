<?php

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
Route::get('/market', [MarketController::class, 'show']);
Route::get('/getProductos', [MarketController::class, 'getProductos']); 
Route::get('/getCategorias', [MarketController::class, 'getCategorias']); 
Route::get('/detalle/{id}', [MarketController::class, 'detalle'])->name('detalle');
Route::post('/add-to-cart', [MarketController::class, 'addToCart'])->name('cart.add');
Route::get('/get-cart', [MarketController::class, 'getCart'])->name('cart.get');

/* Route::get('/market', function () {
    return view('pages.market');
})->name('market'); */