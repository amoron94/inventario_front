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
        $response_cat = Http::get($this->base_url . 'parametro/listado_categoria.php');
        $categorias = $response_cat->json();
        //dd($categorias);

        // Verificar la respuesta
        if ($categorias['success']) {
            return view('parametro.categoria.listado_categoria', compact('categorias'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'parametro/eliminar_categoria.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Unidad de Medida Eliminada');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }

}
