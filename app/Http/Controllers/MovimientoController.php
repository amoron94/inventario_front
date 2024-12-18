<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
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
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_mov = Http::get($this->base_url . 'inventario/listado_movimiento.php?cod_empresa='.$empresa);
        $movimientos = $response_mov->json();

        return view('inventario.movimiento.listado_movimiento', compact('movimientos'));
    }

    public function nuevo()
    {

        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php?cod_empresa='.$empresa);
        $sucursales = $response_suc->json();

        $response_pro = Http::get($this->base_url . 'producto/listado_producto.php?cod_empresa='.$empresa);
        $productos = $response_pro->json();

        return view('inventario.movimiento.nuevo_movimiento', compact('sucursales','productos'))->with('baseUrl', $this->base_url);
    }

    public function ver($id)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_mov = Http::get($this->base_url . 'inventario/ver_movimiento.php?codigo='.$id . '&cod_empresa=' . $empresa);
        $movimientos = $response_mov->json();
        //dd($movimientos);
        // Pasar los datos a la vista de impresión
        return view('inventario.movimiento.ver_movimiento', compact('movimientos'));
    }

    public function descargar_mov($id)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_mov = Http::get($this->base_url . 'inventario/ver_movimiento.php?codigo='.$id);
        $movimientos = $response_mov->json();

        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        // Genera el PDF
        $pdf = FacadePdf::loadView('inventario.movimiento.descargar_mov', compact('movimientos', 'empresas'));

        // Descarga el PDF
        return $pdf->stream('movimientos_sucursales.pdf');
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'inventario/eliminar_movimiento.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Movimiento Eliminado');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
