<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProveedorController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index()
    {

        $response_prov = Http::get($this->base_url . 'egreso/listado_proveedor.php');
        $proveedores = $response_prov->json();

        return view('egreso.proveedor.listado_proveedor', compact('proveedores'));
    }

    public function store(Request $request)
    {
        //$usuario = session('usuario_logueado');

        //dd($request->all());
        $response = Http::post($this->base_url . 'egreso/nuevo_proveedor.php', [
            'empresa'           => $request->empresa,
            'email'             => $request->email,
            'telefono'          => $request->telefono,
            'direccion'         => $request->direccion,
            'nit'               => $request->nit,
            'tipo'              => $request->tipo,
            'comentario'        => $request->comentario,

            'contacto'          => $request->contacto,
            'telfcont'          => $request->telfcont,
            'cargo'             => $request->cargo
        ]);

        $proveedores = $response->json();

        if ($proveedores['success']) {
            return back()->with('success', 'Proveedor Registrado');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }

    public function update($id, Request $request)
    {
        //dd($request->all());

        try {
            $response = Http::patch($this->base_url . 'egreso/editar_proveedor.php', [
                'codigo'            => $id,
                'empresa'           => $request->empresa,
                'email'             => $request->email,
                'telefono'          => $request->telefono,
                'direccion'         => $request->direccion,
                'nit'               => $request->nit,
                'tipo'              => $request->tipo,
                'comentario'        => $request->comentario,

                'contacto'          => $request->contacto,
                'telfcont'          => $request->telfcont,
                'cargo'             => $request->cargo
            ]);

            $response->throw();

            return back()->with('success', 'Proveedor Editado');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'egreso/eliminar_proveedor.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Proveedor Eliminado');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
