<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CondominioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UnidadController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('custom.auth');


Route::get('/', [LoginController::class, 'logeo'])->name('login_page');
Route::post('/ingresar', [LoginController::class, 'acceder'])->name('acceder');
Route::get('cerrar-sesion', [LoginController::class, 'logout']);




Route::get('u_medida', [UnidadController::class, 'index'])->middleware('custom.auth');
Route::post('/guardar-medida', [UnidadController::class, 'store'])->name('guardar_medida');
Route::patch('/editar-medida/{id}', [UnidadController::class, 'update'])->name('editar_medida');
Route::delete('/eliminar-medida/{id}', [UnidadController::class, 'destroy'])->name('eliminar_medida');



Route::get('categoria', [CategoriaController::class, 'index'])->middleware('custom.auth');
Route::delete('/eliminar-categoria/{id}', [CategoriaController::class, 'destroy'])->name('eliminar_categoria');



Route::get('sucursal', [SucursalController::class, 'index'])->middleware('custom.auth');
Route::post('/guardar-sucursal', [SucursalController::class, 'store'])->name('guardar_sucursal');
Route::patch('/editar-sucursal/{id}', [SucursalController::class, 'update'])->name('editar_sucursal');
Route::delete('/eliminar-sucursal/{id}', [SucursalController::class, 'destroy'])->name('eliminar_sucursal');



Route::get('producto', [ProductoController::class, 'index'])->middleware('custom.auth');
Route::post('/guardar-producto', [ProductoController::class, 'store'])->name('guardar_producto');
Route::patch('/editar-producto/{id}', [ProductoController::class, 'update'])->name('editar_producto');
Route::delete('/eliminar-producto/{id}', [ProductoController::class, 'destroy'])->name('eliminar_producto');



Route::get('stock', [StockController::class, 'index'])->middleware('custom.auth');



Route::get('movimiento_stock', [MovimientoController::class, 'index'])->middleware('custom.auth');
Route::get('/nuevo_movimiento', [MovimientoController::class, 'nuevo'])->middleware('custom.auth')->name('nuevo_movimiento');
