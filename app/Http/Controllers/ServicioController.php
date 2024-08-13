<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ServicioController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {
        $response_ser = Http::get($this->base_url . 'inventario/listado_movimiento.php');
        $servicios = $response_ser->json();

        return view('egreso.servicio.listado_servicio', compact('servicios'));
    }
}
