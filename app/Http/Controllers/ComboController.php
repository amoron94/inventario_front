<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ComboController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {

        $response_com = Http::get($this->base_url . 'produccion/listado_combo.php');
        $combos = $response_com->json();

        return view('produccion.listado_combo', compact('combos'));
    }

    public function nuevo()
    {

        $response_prod = Http::get($this->base_url . 'produccion/listado_prod_combo.php');
        $productos = $response_prod->json();

        $response_p_term = Http::get($this->base_url . 'produccion/listado_p_terminado.php');
        $p_termins = $response_p_term->json();

        return view('produccion.nuevo_combo', compact('productos', 'p_termins'))->with('baseUrl', $this->base_url);
    }

    public function ver($id)
    {
        $response_com = Http::get($this->base_url . 'produccion/ver_combo.php?codigo='.$id);
        $combos = $response_com->json();

        $response_emp = Http::get($this->base_url . 'listado_empresa.php');
        $empresas = $response_emp->json();

        // Genera el PDF
        $pdf = FacadePdf::loadView('produccion.ver_combo', compact('combos', 'empresas'));

        // Descarga el PDF
        return $pdf->stream('Combo (Produccion).pdf');
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'produccion/eliminar_combo.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Combo Eliminado');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
