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
        $response_med = Http::get($this->base_url . 'parametro/listado_uni_medida.php');
        $u_medidas = $response_med->json();
        //dd($u_medidas);

        // Verificar la respuesta
        if ($u_medidas['success']) {
            return view('parametro.categoria.listado_categoria', compact('u_medidas'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }
}
