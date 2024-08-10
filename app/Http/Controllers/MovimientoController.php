<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovimientoController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {

        return view('inventario.movimiento.listado_movimiento');
    }

    public function nuevo()
    {

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php');
        $sucursales = $response_suc->json();

        $response_pro = Http::get($this->base_url . 'producto/listado_producto.php');
        $productos = $response_pro->json();

        return view('inventario.movimiento.nuevo_movimiento', compact('sucursales','productos'));
    }

}
