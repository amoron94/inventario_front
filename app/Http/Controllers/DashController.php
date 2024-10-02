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
        $response_ven = Http::get($this->base_url . 'ventas.php');
        $ventas = $response_ven->json();
        //dd($ventas);

        $response_comp = Http::get($this->base_url . 'compras.php');
        $compras = $response_comp->json();
        //dd($compras);

        $response_meses = Http::get($this->base_url . 'ventas_meses.php');
        $vmeses = $response_meses->json();
        //dd($compras);

        // Verificar la respuesta
        if ($ventas['success']) {
            return view('grafdash', compact('ventas','compras','vmeses'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }
}
