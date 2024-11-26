<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoriaController extends Controller
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

        $response_cat = Http::get($this->base_url . 'parametro/listado_categoria.php?cod_empresa='.$empresa);
        $categorias = $response_cat->json();
        //dd($categorias);

        // Verificar la respuesta
        if ($categorias['success']) {
            return view('parametro.categoria.listado_categoria', compact('categorias'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function store(Request $request)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response = Http::post($this->base_url . 'parametro/nueva_categoria.php', [
            'descripcion'   => $request->descripcion,
            'empresa'       => $empresa,
        ]);

        $u_medidas = $response->json();

        if ($u_medidas['success']) {
            return back()->with('success', 'Categoria Registrada');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }

    public function update($id, Request $request)
    {

        try {
            $response = Http::patch($this->base_url . 'parametro/editar_categoria.php', [
                'codigo'        => $id,
                'descripcion'   => $request->descripcion
            ]);

            $response->throw();

            return back()->with('success', 'Categoria Editada');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'parametro/eliminar_categoria.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Categoria Eliminada');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }

}
