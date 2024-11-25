<?php

use App\Http\Controllers\CajaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CobroController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/reactivar', function () {
    return view('suscripcion');
});

Route::get('/dashboard', [DashController::class, 'index'])->middleware('custom.auth');


Route::get('/', [LoginController::class, 'logeo'])->name('login_page');
Route::post('/ingresar', [LoginController::class, 'acceder'])->name('acceder');
Route::get('cerrar-sesion', [LoginController::class, 'logout']);




Route::get('u_medida', [UnidadController::class, 'index'])->middleware('custom.auth');
Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::post('/guardar-medida', [UnidadController::class, 'store'])->name('guardar_medida');
    Route::patch('/editar-medida/{id}', [UnidadController::class, 'update'])->name('editar_medida');
    Route::delete('/eliminar-medida/{id}', [UnidadController::class, 'destroy'])->name('eliminar_medida');
});



Route::get('categoria', [CategoriaController::class, 'index'])->middleware('custom.auth');
Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::post('/guardar-categoria', [CategoriaController::class, 'store'])->name('guardar_categoria');
    Route::patch('/editar-categoria/{id}', [CategoriaController::class, 'update'])->name('editar_categoria');
    Route::delete('/eliminar-categoria/{id}', [CategoriaController::class, 'destroy'])->name('eliminar_categoria');
});

Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('sucursal', [SucursalController::class, 'index'])->middleware('custom.auth');
    Route::post('/guardar-sucursal', [SucursalController::class, 'store'])->name('guardar_sucursal');
    Route::patch('/editar-sucursal/{id}', [SucursalController::class, 'update'])->name('editar_sucursal');
    Route::delete('/eliminar-sucursal/{id}', [SucursalController::class, 'destroy'])->name('eliminar_sucursal');
});


Route::get('producto', [ProductoController::class, 'index'])->middleware('custom.auth');
Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::post('/guardar-producto', [ProductoController::class, 'store'])->name('guardar_producto');
    Route::patch('/editar-producto/{id}', [ProductoController::class, 'update'])->name('editar_producto');
    Route::delete('/eliminar-producto/{id}', [ProductoController::class, 'destroy'])->name('eliminar_producto');
});


Route::get('stock', [StockController::class, 'index'])->middleware('custom.auth');


Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('movimiento_stock', [MovimientoController::class, 'index'])->middleware('custom.auth');
    Route::get('/nuevo_movimiento', [MovimientoController::class, 'nuevo'])->middleware('custom.auth')->name('nuevo_movimiento');
    Route::get('/ver_movimiento/{id}', [MovimientoController::class, 'ver'])->middleware('custom.auth')->name('ver_movimiento');
    Route::get('/descargar_mov/{id}', [MovimientoController::class, 'descargar_mov'])->middleware('custom.auth')->name('descargar_mov');
    Route::delete('/eliminar-movimiento/{id}', [MovimientoController::class, 'destroy'])->name('eliminar_movimiento');
});

Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('servicios', [ServicioController::class, 'index'])->middleware('custom.auth');
    Route::post('/guardar-servicio', [ServicioController::class, 'store'])->name('guardar_servicio');
    Route::patch('/editar-servicio/{id}', [ServicioController::class, 'update'])->name('editar_servicio');
    Route::delete('/eliminar-servicio/{id}', [ServicioController::class, 'destroy'])->name('eliminar_servicio');
});

Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('gastos', [GastoController::class, 'index'])->middleware('custom.auth');
    Route::post('/guardar-gasto', [GastoController::class, 'store'])->name('guardar_gasto');
    Route::patch('/editar-gasto/{id}', [GastoController::class, 'update'])->name('editar_gasto');
    Route::delete('/eliminar-gasto/{id}', [GastoController::class, 'destroy'])->name('eliminar_gasto');
});

Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('proveedor', [ProveedorController::class, 'index'])->middleware('custom.auth');
    Route::post('/guardar-proveedor', [ProveedorController::class, 'store'])->name('guardar_proveedor');
    Route::patch('/editar-proveedor/{id}', [ProveedorController::class, 'update'])->name('editar_proveedor');
    Route::delete('/eliminar-proveedor/{id}', [ProveedorController::class, 'destroy'])->name('eliminar_proveedor');
});

Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('compras', [CompraController::class, 'index'])->middleware('custom.auth');
    Route::get('/nueva_compra', [CompraController::class, 'nuevo'])->middleware('custom.auth')->name('nueva_compra');
    Route::get('/ver_compra/{id}', [CompraController::class, 'ver'])->middleware('custom.auth')->name('ver_compra');
    Route::get('/descargar_comp/{id}', [CompraController::class, 'descargar_comp'])->middleware('custom.auth')->name('descargar_comp');
    Route::delete('/eliminar-compra/{id}', [CompraController::class, 'destroy'])->name('eliminar_compra');
});


Route::get('pos', [PosController::class, 'index'])->middleware('custom.auth');
Route::post('/guardar-caja', [PosController::class, 'crearCaja'])->middleware('custom.auth')->name('guardar_caja');


Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('empresa', [EmpresaController::class, 'index'])->middleware('custom.auth');
    Route::patch('/editar-empresa/{id}', [EmpresaController::class, 'update'])->middleware('custom.auth')->name('editar_empresa');
});

Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('usuario', [UsuarioController::class, 'index'])->middleware('custom.auth');
    Route::post('/guardar-usuario', [UsuarioController::class, 'store'])->name('guardar_usuario');
    Route::patch('/editar-usuario/{id}', [UsuarioController::class, 'update'])->name('editar_usuario');
    Route::delete('/eliminar-usuario/{id}', [UsuarioController::class, 'destroy'])->name('eliminar_usuario');
});

Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('produccion', [ProduccionController::class, 'index'])->middleware('custom.auth');
    Route::get('/nueva_produccion', [ProduccionController::class, 'nuevo'])->middleware('custom.auth')->name('nueva_receta');
    Route::get('/ver_receta/{id}', [ProduccionController::class, 'ver'])->middleware('custom.auth')->name('ver_receta');
    Route::delete('/eliminar-receta/{id}', [ProduccionController::class, 'destroy'])->name('eliminar_receta');
});


Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::get('combo', [ComboController::class, 'index'])->middleware('custom.auth');
    Route::get('/nuevo_combo', [ComboController::class, 'nuevo'])->middleware('custom.auth')->name('nuevo_combo');
    Route::get('/ver_combo/{id}', [ComboController::class, 'ver'])->middleware('custom.auth')->name('ver_combo');
    Route::delete('/eliminar-combo/{id}', [ComboController::class, 'destroy'])->name('eliminar_combo');
});


Route::get('caja', [CajaController::class, 'index'])->middleware('custom.auth');
Route::get('/descargar_caja/{id}', [CajaController::class, 'descargar_caja'])->middleware('custom.auth')->name('descargar_caja');



Route::get('cliente', [ClienteController::class, 'index'])->middleware('custom.auth');
Route::post('/guardar-cliente', [ClienteController::class, 'store'])->name('guardar_cliente');
Route::patch('/editar-cliente/{id}', [ClienteController::class, 'update'])->name('editar_cliente');
Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::delete('/eliminar-cliente/{id}', [ClienteController::class, 'destroy'])->name('eliminar_cliente');
});


Route::get('venta', [VentaController::class, 'index'])->middleware('custom.auth');
Route::get('/descargar_venta/{id}', [VentaController::class, 'descargar_ven'])->middleware('custom.auth')->name('descargar_ven');
Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::delete('/eliminar-venta/{id}', [VentaController::class, 'destroy'])->name('eliminar_venta');
});


Route::get('perfil', [PerfilController::class, 'index'])->middleware('custom.auth');
Route::patch('/editar-perfil/{id}', [PerfilController::class, 'update'])->middleware('custom.auth')->name('editar_perfil');
Route::patch('/editar-pass/{id}', [PerfilController::class, 'cambiar_pass'])->middleware('custom.auth')->name('cambiar_pass');



Route::get('lote', [LoteController::class, 'index'])->middleware('custom.auth');
Route::get('/ver_lote/{id}/{nombre}', [LoteController::class, 'ver'])->middleware('custom.auth')->name('ver_lote');
Route::middleware(['verifyRole.auth:CAJERO'])->group(function () {
    Route::patch('/editar-lote/{id}', [LoteController::class, 'update'])->name('editar_lote');
    Route::delete('/eliminar-lote/{id}', [LoteController::class, 'destroy'])->name('eliminar_lote');
});


Route::get('cobro', [CobroController::class, 'index'])->middleware('custom.auth');
Route::patch('/pagar-cobro/{id}', [CobroController::class, 'pagar'])->name('pagar_cobro');
