<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UnidadController extends Controller
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

        $response_med = Http::get($this->base_url . 'parametro/listado_uni_medida.php?cod_empresa='.$empresa);
        $u_medidas = $response_med->json();
        //dd($u_medidas);

        // Verificar la respuesta
        if ($u_medidas['success']) {
            return view('parametro.unidad_medida.listado_medida', compact('u_medidas'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function store(Request $request)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response = Http::post($this->base_url . 'parametro/nuevo_uni_medida.php', [
            'descripcion'   => $request->descripcion,
            'av'            => $request->av,
            'empresa'       => $empresa,
        ]);

        $u_medidas = $response->json();

        if ($u_medidas['success']) {
            return back()->with('success', 'Unidad de Medida Registrada');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }

    public function update($id, Request $request)
    {

        try {
            $response = Http::patch($this->base_url . 'parametro/editar_uni_medida.php', [
                'codigo'        => $id,
                'descripcion'   => $request->descripcion,
                'av'            => $request->av
            ]);

            $response->throw();

            return back()->with('success', 'Unidad de Medida Editada');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'parametro/eliminar_uni_medida.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Unidad de Medida Eliminada');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
