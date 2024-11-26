<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompraController extends Controller
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

        $response_comp = Http::get($this->base_url . 'egreso/listado_compra.php?cod_empresa='.$empresa);
        $compras = $response_comp->json();

        return view('egreso.compra.listado_compra', compact('compras'));
    }

    public function nuevo()
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_prov = Http::get($this->base_url . 'egreso/listado_proveedor.php?cod_empresa='.$empresa);
        $proveedores = $response_prov->json();

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php?cod_empresa='.$empresa);
        $sucursales = $response_suc->json();

        $response_pro = Http::get($this->base_url . 'producto/listado_producto.php?cod_empresa='.$empresa);
        $productos = $response_pro->json();

        return view('egreso.compra.nueva_compra', compact('proveedores','sucursales','productos'))->with('baseUrl', $this->base_url);
    }

    public function ver($id)
    {
        $response_gas = Http::get($this->base_url . 'egreso/ver_compra.php?codigo='.$id);
        $gastos = $response_gas->json();
        //dd($movimientos);
        // Pasar los datos a la vista de impresión
        return view('egreso.compra.ver_compra', compact('gastos'));
    }

    public function descargar_comp($id)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_gas = Http::get($this->base_url . 'egreso/ver_compra.php?codigo='.$id);
        $gastos = $response_gas->json();

        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        // Genera el PDF
        $pdf = FacadePdf::loadView('egreso.compra.descargar_comp', compact('gastos', 'empresas'));

        // Descarga el PDF
        //return $pdf->download('Orden_Compra.pdf');
        return $pdf->stream('Orden_Compra.pdf');
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'egreso/eliminar_compra.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Compra Eliminada');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
