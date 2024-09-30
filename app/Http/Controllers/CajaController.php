<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CajaController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {

        $response_caja = Http::get($this->base_url . 'ingreso/listado_arqueo_caja.php');
        $cajas = $response_caja->json();

        return view('ingreso.caja.listado_caja', compact('cajas'));
    }

    public function descargar_caja($id)
    {
        $response_caj = Http::get($this->base_url . 'ingreso/listado_arqueo_caja_cerrada.php?codigo='.$id);
        $cajas = $response_caj->json();

        // Genera el PDF
        $pdf = FacadePdf::loadView('ingreso.caja.descargar_caja', compact('cajas'));

        // Descarga el PDF
        return $pdf->stream('Cierre-Caja.pdf');
    }
}
