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
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_ser = Http::get($this->base_url . 'egreso/listado_servicio.php?cod_empresa='.$empresa);
        $servicios = $response_ser->json();

        return view('egreso.servicio.listado_servicio', compact('servicios'));
    }

    public function store(Request $request)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        //dd($request->all());
        $response = Http::post($this->base_url . 'egreso/nuevo_servicio.php', [
            'descripcion'       => $request->descripcion,
            'empresa'           => $empresa
        ]);

        $producto = $response->json();

        if ($producto['success']) {
            return back()->with('success', 'Servicio Registrado');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }

    public function update($id, Request $request)
    {
        //dd($request->all());

        try {
            $response = Http::patch($this->base_url . 'egreso/editar_servicio.php', [
                'codigo'        => $id,
                'descripcion'   => $request->descripcion
            ]);

            $response->throw();

            return back()->with('success', 'Servicio Editado');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'egreso/eliminar_servicio.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Servicio Eliminado');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
