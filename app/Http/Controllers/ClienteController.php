<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClienteController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {

        $response_cli = Http::get($this->base_url . 'ingreso/listado_cliente.php');
        $clientes = $response_cli->json();

        return view('ingreso.cliente.listado_cliente', compact('clientes'));
    }

    public function store(Request $request)
    {
        //$usuario = session('usuario_logueado');

        $response = Http::post($this->base_url . 'ingreso/nuevo_cliente.php', [
            'nombre'        => $request->nombre,
            'telefono'      => $request->telefono,
            'email'         => $request->email,
            'sexo'          => $request->sexo,
            'fecha'         => $request->fecha,
        ]);

        $clientes = $response->json();

        if ($clientes['success']) {
            return back()->with('success', 'Cliente Registrado');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }

    public function update($id, Request $request)
    {

        try {
            $response = Http::patch($this->base_url . 'ingreso/editar_cliente.php', [
                'codigo'        => $id,
                'nombre'        => $request->nombre,
                'telefono'      => $request->telefono,
                'email'         => $request->email,
                'sexo'          => $request->sexo,
                'fecha'         => $request->fecha
            ]);

            $response->throw();

            return back()->with('success', 'Cliente Editado');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'ingreso/eliminar_cliente.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Cliente Eliminado');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
