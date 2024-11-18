<?php

use App\Http\Controllers\AccessTokenController;
use App\Http\Controllers\AdminMarketController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FirmarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntranetTblController;
use App\Http\Controllers\LexWebController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\QrManagerController;
use App\Http\Controllers\SegurosController;
use App\Http\Controllers\TransbankController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WebtblController;
use Illuminate\Support\Facades\Auth;

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/** MARKET DIVISION */
//Route::get('/', [MarketController::class, 'show'])->name('inicio');
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
Route::post('/getStatus', [TransbankController::class, 'getStatus'])->name('getStatus');
Route::post('/refund', [TransbankController::class, 'refund'])->name('refund');  
Route::post('/detail', [TransbankController::class, 'detail'])->name('detail');  
/* Route::get('/market', function () {
    return view('pages.market');
})->name('market'); */


/* CODIGOS QR*/
Route::get('/view', [QrManagerController::class, 'view'])->name('view');


/* TRANSPORTES BULNES */
/* Route::get('/', [WebtblController::class, 'index'])->name('inicio'); */
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
    

    //empleados
    Route::get('/adminEmpleados', [IntranetTblController::class, 'adminEmpleados'])->name('adminEmpleados');
    Route::get('/getEmpleadosPerPage',[IntranetTblController::class, 'getEmpleadosPerPage'])->name('getEmpleadosPerPage');
    Route::post('/agregarEmpleado', [IntranetTblController::class, 'agregarEmpleado']);
    
});


Route::middleware(['auth'])->group(function () {
    Route::post('/tokens/create', [AccessTokenController::class, 'createToken']);           
});


Route::post('/autoriza', [App\Http\Controllers\IntranetTblController::class, 'autoriza'])->name('autoriza');
Route::post('/tokens/validate', [AccessTokenController::class, 'validateToken']); 
Route::get('empleados/photo/{rut}', [WebController::class, 'showElement']);
Route::get('equipos/documentation/{id}', [WebController::class, 'showDocumentation']);


/* SEGUROS NCS */
//Route::get('/', [SegurosController::class, 'index'])->name('seguros');
Route::get('/seguros', [SegurosController::class, 'index'])->name('seguros');

Route::get('/seguro-vehicular', function () {
    return view('seguros/web/seguroVehicular');
});

Route::get('/seguro-hogar', function () {
    return view('seguros/web/seguroHogarIncendioComercial');
});


Route::get('/seguro-responsabilidad-civil', function () {
    return view('seguros/web/seguroResponsabilidadCivil');
});

Route::get('/seguro-todo-riesgo-construccion', function () {
    return view('seguros/web/seguroTodoRiesgoConstruccion');
});

Route::get('/seguro-garantia', function () {
    return view('seguros/web/seguroGarantia');
});

Route::get('/seguro-transporte-terrestre', function () {
    return view('seguros/web/seguroTransporteTerrestre');
});

Route::get('/seguro-rc', function () {
    return view('seguros/web/seguroRC');
});

Route::get('/seguro-ingenieria', function () {
    return view('seguros/web/seguroIngenieria');
});

Route::get('/seguro-accidentes-personales', function () {
    return view('seguros/web/seguroAccidentesPersonales');
});

Route::get('/corredora-seguros', function () {
    return view('seguros/web/corredoraSeguros');
});



/* LEX **/


Route::get('/', [LexWebController::class, 'index'])->name('inicio');
Route::get('/redactar/{id}', [LexWebController::class, 'redactar'])->name('redactar');
Route::post('/generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('/carroCompras', [LexWebController::class, 'carroCompras'])->name('carroCompras');
Route::post('/guardarRedaccion', [LexWebController::class, 'guardarRedaccion']);
Route::get('/getRedaccionesPorPagar', [LexWebController::class, 'getRedaccionesPorPagar']);
Route::get('/lexPagar', [TransbankController::class, 'lexPagar'])->name('lexPagar');
Route::get('/getResult', [TransbankController::class, 'getResult'])->name('getResult');
Route::get('/getPDFUrl', [LexWebController::class, 'getPDFUrl'])->name('getPDFUrl');
Route::get('/lexregiones', [LexWebController::class, 'lexregiones'])->name('lexregiones');
Route::get('/lexcomunas/{region}', [LexWebController::class, 'lexcomunas'])->name('lexcomunas');
Route::get('/lexcategorias', [LexWebController::class, 'lexcategorias'])->name('lexcategorias');

/*INTRANET*/
Route::middleware('auth')->get('/home', [FirmarController::class, 'index'])->name('home');
Route::get('/getDocumentosPendientesPagadoPerPage',[FirmarController::class, 'getDocumentosPendientesPagadoPerPage'])->name('getDocumentosPendientesPagadoPerPage');
Route::middleware('auth')->get('/firmantesPendientes/{idRedaccion}', [FirmarController::class, 'firmantesPendientes'])->name('firmantesPendientes');

/* FIRMAS */

Route::get('/firmarDocumento/{token}', [FirmarController::class, 'firmarDocumento'])->name('firmarDocumento');
Route::post('/autorizaFirma', [FirmarController::class, 'autorizaFirma'])->name('autorizaFirma');
Route::post('/recibeDocumento', [FirmarController::class, 'recibeDocumento'])->name('recibeDocumento');
Route::get('/documento/descargar/{idRedaccion}', [LexWebController::class, 'buscarDocumento']);
Route::get('/enviarCorreo/{idRedaccion}', [FirmarController::class, 'enviarCorreo'])->name('enviarCorreo');

Route::get('/callback/{token}', [FirmarController::class, 'callback'])->name('callback');