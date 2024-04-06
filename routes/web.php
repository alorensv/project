<?php

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
