<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SucursalController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {
        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php');
        $sucursales = $response_suc->json();
        //dd($u_medidas);

        $response_enc = Http::get($this->base_url . 'combo/listado_encargado.php');
        $encargados = $response_enc->json();

        // Verificar la respuesta
        if ($sucursales['success']) {
            return view('inventario.sucursal.listado_sucursal', compact('sucursales','encargados'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function store(Request $request)
    {
        //$usuario = session('usuario_logueado');

        $response = Http::post($this->base_url . 'inventario/nuevo_sucursal.php', [
            'nombre'        => $request->nombre,
            'encargado'     => $request->encargado,
            'telefono'      => $request->telefono,
            'direccion'     => $request->direccion,
            'ciudad'        => $request->ciudad
        ]);

        $sucursal = $response->json();

        if ($sucursal['success']) {
            return back()->with('success', 'Sucursal Registrada');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }

    public function update($id, Request $request)
    {

        try {
            $response = Http::patch($this->base_url . 'inventario/editar_sucursal.php', [
                'codigo'        => $id,
                'nombre'        => $request->nombre,
                'encargado'     => $request->encargado,
                'telefono'      => $request->telefono,
                'direccion'     => $request->direccion,
                'ciudad'        => $request->ciudad
            ]);

            $response->throw();

            return back()->with('success', 'Sucursal Editada');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'inventario/eliminar_sucursal.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Sucursal Eliminada');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
