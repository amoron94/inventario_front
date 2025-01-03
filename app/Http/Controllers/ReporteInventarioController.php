<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReporteInventarioController extends Controller
{
    //

    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
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