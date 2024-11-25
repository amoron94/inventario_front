<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsuarioController extends Controller
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

        $response_usu = Http::get($this->base_url . 'listado_usuario.php?cod_empresa='.$empresa);
        $usuarios = $response_usu->json();

        return view('listado_usuario', compact('usuarios'));
    }

    public function store(Request $request)
    {
        //$usuario = session('usuario_logueado');

        $fechaHora = date('dmYHis');
        $img = $request->file('img');
        $img->move(public_path('img/usuario'), $fechaHora . "_" . $img->getClientOriginalName());

        //dd($request->all());
        $response = Http::post($this->base_url . 'nuevo_usuario.php', [
            'nombre'            => $request->nombre,
            'apellido_p'        => $request->apellido_p,
            'apellido_m'        => $request->apellido_m,
            'direccion'         => $request->direccion,
            'correo'            => $request->correo,
            'telefono'          => $request->telefono,
            'tipo'              => $request->tipo,
            'pass'              => $request->contra,
            'img'               => $fechaHora . "_" . $img->getClientOriginalName()
        ]);

        $usuario = $response->json();

        if ($usuario['success']) {
            return back()->with('success', 'Usuario Registrado');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }

    public function update($id, Request $request)
    {
        //dd($request->all());

        $img_usu = $request->img;

        if($img_usu != null){
            $fechaHora = date('dmYHis');
            $img = $request->file('img');
            $img->move(public_path('img/usuario'), $fechaHora . "_" . $img->getClientOriginalName());

            $img_usu = $fechaHora . "_" . $img->getClientOriginalName();
        }

        try {
            $response = Http::patch($this->base_url . 'editar_usuario.php', [
                'codigo'            => $id,
                'nombre'            => $request->nombre,
                'apellido_p'        => $request->apellido_p,
                'apellido_m'        => $request->apellido_m,
                'direccion'         => $request->direccion,
                'correo'            => $request->correo,
                'telefono'          => $request->telefono,
                'tipo'              => $request->tipo,
                'img'               => $img_usu

            ]);

            $response->throw();

            return back()->with('success', 'Usuario Editado');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'eliminar_usuario.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Usuario Eliminado');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
