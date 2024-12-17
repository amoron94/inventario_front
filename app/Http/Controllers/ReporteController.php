<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReporteController extends Controller
{
    //

    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function venta()
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php?cod_empresa=' . $empresa);
        $sucursales = $response_suc->json();

        $response_cli = Http::get($this->base_url . 'ingreso/listado_cliente.php?cod_empresa='.$empresa);
        $clientes = $response_cli->json();

        $response_pro = Http::get($this->base_url . 'reporte/listado_productos.php?cod_empresa='.$empresa);
        $productos = $response_pro->json();

        // Verificar la respuesta
        if ($empresa) {
            return view('reporte.ingreso.venta', compact('clientes','sucursales','productos'))->with('baseUrl', $this->base_url);
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function compra()
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php?cod_empresa=' . $empresa);
        $sucursales = $response_suc->json();

        $response_cli = Http::get($this->base_url . 'ingreso/listado_cliente.php?cod_empresa='.$empresa);
        $clientes = $response_cli->json();

        $response_pro = Http::get($this->base_url . 'reporte/listado_productos.php?cod_empresa='.$empresa);
        $productos = $response_pro->json();

        // Verificar la respuesta
        if ($empresa) {
            return view('reporte.egreso.compra', compact('clientes','sucursales','productos'))->with('baseUrl', $this->base_url);
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function inventario()
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php?cod_empresa=' . $empresa);
        $sucursales = $response_suc->json();

        $response_pro = Http::get($this->base_url . 'producto/listado_producto.php?cod_empresa='.$empresa);
        $productos = $response_pro->json();

        // Verificar la respuesta
        if ($empresa) {
            return view('reporte.stock.inventario', compact('sucursales','productos'))->with('baseUrl', $this->base_url);
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }
}
