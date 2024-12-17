<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_lo = Http::get($this->base_url . 'listado_lotes_vencer.php?cod_empresa='.$empresa);
        $lotes = $response_lo->json();
        //dd($lotes);

        $response_ven = Http::get($this->base_url . 'ventas.php?cod_empresa='.$empresa);
        $ventas = $response_ven->json();
        //dd($ventas);

        $response_comp = Http::get($this->base_url . 'compras.php?cod_empresa='.$empresa);
        $compras = $response_comp->json();
        //dd($compras);

        $response_prod = Http::get($this->base_url . 'productos_vendidos.php?cod_empresa='.$empresa);
        $productos = $response_prod->json();
        //dd($compras);

        $response_tpago = Http::get($this->base_url . 'tipo_pagos.php?cod_empresa='.$empresa);
        $tpagos = $response_tpago->json();
        //dd($compras);

        $response_meses = Http::get($this->base_url . 'ventas_meses.php?cod_empresa='.$empresa);
        $vmeses = $response_meses->json();
        //dd($compras);

        $response_cmeses = Http::get($this->base_url . 'compras_meses.php?cod_empresa='.$empresa);
        $cmeses = $response_cmeses->json();
        //dd($compras);

        // Verificar la respuesta
        if ($ventas['success']) {
            return view('grafdash', compact('lotes','ventas','compras','productos','tpagos','vmeses','cmeses'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }
}
