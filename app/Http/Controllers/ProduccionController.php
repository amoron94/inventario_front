<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProduccionController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {

        $response_pro = Http::get($this->base_url . 'produccion/listado_produccion.php');
        $producciones = $response_pro->json();

        return view('produccion.listado_receta', compact('producciones'));
    }

    public function nuevo()
    {

        $response_prod = Http::get($this->base_url . 'produccion/listado_prod_receta.php');
        $productos = $response_prod->json();

        $response_m_prima = Http::get($this->base_url . 'produccion/listado_prod_materia.php');
        $m_primas = $response_m_prima->json();

        return view('produccion.nueva_receta', compact('productos', 'm_primas'));
    }

    public function ver($id)
    {
        $response_gas = Http::get($this->base_url . 'egreso/ver_compra.php?codigo='.$id);
        $gastos = $response_gas->json();

        // Genera el PDF
        $pdf = FacadePdf::loadView('produccion.ver_receta', compact('gastos'));

        // Descarga el PDF
        return $pdf->stream('Receta (Produccion).pdf');
    }
}
