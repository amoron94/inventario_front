<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VentaController extends Controller
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

        $response_ven = Http::get($this->base_url . 'ingreso/listado_venta.php?cod_empresa='.$empresa);
        $ventas = $response_ven->json();
        //dd($ventas);

        // Verificar la respuesta
        if ($ventas['success']) {
            return view('ingreso.venta.listado_venta', compact('ventas'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function descargar_ven($id)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_ven = Http::get($this->base_url . 'ingreso/ver_venta.php?codigo='.$id);
        $ventas = $response_ven->json();

        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        // Genera el PDF
        $pdf = FacadePdf::loadView('ingreso.venta.descargar_ven', compact('ventas', 'empresas'));

        // Descarga el PDF
        //return $pdf->download('Orden_Venta.pdf');
        return $pdf->stream('Orden_Venta.pdf');
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'ingreso/eliminar_venta.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Venta Eliminada');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
