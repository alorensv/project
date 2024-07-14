<?php

use App\Http\Controllers\AdminMarketController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntranetTblController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\QrManagerController;
use App\Http\Controllers\TransbankController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WebtblController;

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

/* Route::get('/', function () {
    return view('pages.inicio');
})->name('inicio'); */

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
Route::get('/', [MarketController::class, 'show'])->name('inicio');
//Route::get('/market', [MarketController::class, 'show'])->name('market');
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
Route::get('/existeUsuario', [MarketController::class, 'existeUsuario'])->name('existeUsuario');
Route::post('/agregarDireccion', [MarketController::class, 'agregarDireccion'])->name('agregarDireccion');
Route::get('/getUserDirecciones', [MarketController::class, 'getUserDirecciones'])->name('getUserDirecciones');
Route::post('/updateDireccionPredeterminada/{id}',[MarketController::class, 'updateDireccionPredeterminada'])->name('updateDireccionPredeterminada');

Route::get('/regiones', [MarketController::class, 'regiones'])->name('regiones');
Route::get('/comunas/{region}', [MarketController::class, 'comunas'])->name('comunas');


/* ADMIN MARKET PLACE */
Route::get('/misCompras',[HomeController::class, 'misCompras'])->name('misCompras');
Route::get('/getMisCompras',[HomeController::class, 'getMisCompras'])->name('getMisCompras');
Route::get('/verDetalleCompra/{id}',[AdminMarketController::class, 'verDetalleCompra'])->name('verDetalleCompra');
Route::get('/productos', [AdminMarketController::class, 'productos'])->name('productos');
Route::post('/agregarProducto', [AdminMarketController::class, 'agregarProducto'])->name('agregarProducto');


Route::get('/pagar', [TransbankController::class, 'pagar'])->name('pagar');
Route::get('/enviarPago', [TransbankController::class, 'enviarPago'])->name('enviarPago');
Route::post('/getResult', [TransbankController::class, 'getResult'])->name('getResult');
Route::post('/getStatus', [TransbankController::class, 'getStatus'])->name('getStatus');
Route::post('/refund', [TransbankController::class, 'refund'])->name('refund');  
Route::post('/detail', [TransbankController::class, 'detail'])->name('detail');  
/* Route::get('/market', function () {
    return view('pages.market');
})->name('market'); */


/* CODIGOS QR*/
Route::get('/view', [QrManagerController::class, 'view'])->name('view');


/* TRANSPORTES BULNES */
Route::get('/', [WebtblController::class, 'index'])->name('inicio');
Route::get('/servicio_sobredimensionado', [WebtblController::class, 'servicio_sobredimensionado'])->name('servicio_sobredimensionado');
Route::get('/servicio_cargas_especiales', [WebtblController::class, 'servicio_cargas_especiales'])->name('servicio_cargas_especiales');
Route::get('/transporte_equipos_forestales', [WebtblController::class, 'transporte_equipos_forestales'])->name('transporte_equipos_forestales');
Route::get('/rescate_equipos_siniestrados', [WebtblController::class, 'rescate_equipos_siniestrados'])->name('rescate_equipos_siniestrados');
Route::get('/transporte_maquinaria', [WebtblController::class, 'transporte_maquinaria'])->name('transporte_maquinaria');
Route::get('/servicios_izajes', [WebtblController::class, 'servicios_izajes'])->name('servicios_izajes');
Route::get('/venta_combustible', [WebtblController::class, 'venta_combustible'])->name('venta_combustible');

Route::get('/cantidadVisitas', [WebtblController::class, 'cantidadVisitas'])->name('cantidadVisitas');  
Route::post('/guardarVisita', [WebController::class, 'guardarVisita'])->name('guardarVisita');  


Route::get('/equipos', [WebtblController::class, 'equipos'])->name('equipos'); 
Route::get('/getEquipos', [WebtblController::class, 'getEquipos'])->name('getEquipos');
Route::get('/tiposEquipos', [WebtblController::class, 'tiposEquipos'])->name('tiposEquipos');

Route::get('/transportes_bulnes', [WebtblController::class, 'transportes_bulnes'])->name('transportes_bulnes');

Route::get('/presentacion', [WebtblController::class, 'presentacion'])->name('presentacion');
Route::get('/presentacionEquipo', [WebtblController::class, 'presentacionEquipo'])->name('presentacionEquipo');

Route::post('/guardarContacto',[WebtblController::class, 'guardarContacto'])->name('guardarContacto');
Route::post('/guardarCotizacion',[WebtblController::class, 'guardarCotizacion'])->name('guardarCotizacion');


/*INTRANET TBL */

// routes/web.php

Route::middleware(['auth'])->group(function () {
    Route::get('/adminEquipos', [IntranetTblController::class, 'adminEquipos'])->name('adminEquipos');
    Route::get('/getEquiposPerPage',[IntranetTblController::class, 'getEquiposPerPage'])->name('getEquiposPerPage');
    Route::post('/agregarTipoEquipo', [IntranetTblController::class, 'agregarTipoEquipo']);
    Route::post('/agregarEquipo', [IntranetTblController::class, 'agregarEquipo']);
    Route::get('/adminCotizaciones', [IntranetTblController::class, 'adminCotizaciones'])->name('adminCotizaciones');
    Route::get('/getCotizaciones', [IntranetTblController::class, 'getCotizaciones'])->name('getCotizaciones');
    Route::post('/activarEquipo', [IntranetTblController::class, 'activarEquipo'])->name('activarEquipo');
});


