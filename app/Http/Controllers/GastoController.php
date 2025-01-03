<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GastoController extends Controller
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

        $response_gas = Http::get($this->base_url . 'egreso/listado_gasto.php?cod_empresa='.$empresa);
        $gastos = $response_gas->json();

        $response_ser = Http::get($this->base_url . 'egreso/listado_servicio.php?cod_empresa='.$empresa);
        $servicios = $response_ser->json();

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php?cod_empresa=' . $empresa);
        $sucursales = $response_suc->json();

        return view('egreso.gasto.listado_gasto', compact('gastos', 'servicios', 'sucursales'));
    }

    public function store(Request $request)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        //dd($request->all());
        $response = Http::post($this->base_url . 'egreso/nuevo_gasto.php', [
            'servicio'      => $request->servicio,
            'sucursal'      => $request->sucursal,
            'monto'         => $request->monto,
            'fecha'         => $request->fecha,
            'descripcion'   => $request->descripcion,
            'empresa'       => $empresa,
        ]);

        $gastos = $response->json();

        if ($gastos['success']) {
            return back()->with('success', 'Gasto Registrado');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }

    public function update($id, Request $request)
    {
        //dd($request->all());

        try {
            $response = Http::patch($this->base_url . 'egreso/editar_gasto.php', [
                'codigo'        => $id,
                'servicio'      => $request->servicio,
                'sucursal'      => $request->sucursal,
                'monto'         => $request->monto,
                'fecha'         => $request->fecha,
                'descripcion'   => $request->descripcion
            ]);

            $response->throw();

            return back()->with('success', 'Gasto Editado');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'egreso/eliminar_gasto.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Gasto Eliminado');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
