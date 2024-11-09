<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CobroController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {
        $response_cob = Http::get($this->base_url . 'ingreso/listado_cobros.php');
        $cobros = $response_cob->json();
        //dd($cobros);

        // Verificar la respuesta
        if ($cobros['success']) {
            return view('ingreso.cobro.listado_cobro', compact('cobros'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function pagar($id)
    {

        try {
            $response = Http::patch($this->base_url . 'ingreso/pagar_deuda.php', [
                'codigo'        => $id,
            ]);

            $response->throw();


            return back()->with('success', 'Deuda Pagada');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al pagar la deuda');

        }
    }
}
