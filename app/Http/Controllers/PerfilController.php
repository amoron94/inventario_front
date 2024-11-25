<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PerfilController extends Controller
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

        $cod_user = $usuario['data']['codigo'];

        $response_per = Http::get($this->base_url . 'perfil.php?codigo='.$cod_user);
        $perfil = $response_per->json();
        //dd($ventas);

        // Verificar la respuesta
        if ($perfil['success']) {
            return view('perfil', compact('perfil'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function update($id, Request $request)
    {
        // Capturar la imagen subida, si existe
        $img_perfil = $request->img;

        if ($img_perfil != null) {
            $fechaHora = date('dmYHis');
            $img = $request->file('img');
            $img->move(public_path('img/usuario'), $fechaHora . "_" . $img->getClientOriginalName());

            $img_perfil = $fechaHora . "_" . $img->getClientOriginalName();
        }

        try {
            // Realizar la solicitud PATCH al archivo PHP externo
            $response = Http::patch($this->base_url . 'editar_perfil.php', [
                'codigo'        => $id,
                'nombre'        => strtoupper($request->nombre),
                'apellido_p'    => strtoupper($request->apellido_p),
                'apellido_m'    => strtoupper($request->apellido_m),
                'email'         => $request->email,
                'telefono'      => $request->telefono,
                'direccion'     => strtoupper($request->direccion),
                'img'           => $img_perfil,
                'facebook'      => $request->facebook,
                'instagram'     => $request->instagram,
            ]);

            $response->throw();

            return back()->with('success', 'Perfil editado exitosamente');

        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al editar los datos');
        }
    }

    public function cambiar_pass($id, Request $request){
        try {
            // Realizar la solicitud PATCH al archivo PHP externo
            $response = Http::patch($this->base_url . 'cambiar_pass.php', [
                'codigo'        => $id,
                'pass1'         => $request->pass1,
                'pass2'         => $request->pass2,
                'pass3'         => $request->pass3
            ]);

            $response->throw();

            return back()->with('success', 'Perfil editado exitosamente');

        } catch (\Illuminate\Http\Client\RequestException $exception) {
            // Obtener el cuerpo de la respuesta del error
            $errorMessage = $exception->response->json('errors') ?? 'Error al editar los datos';

            return back()->with('error', $errorMessage);
        }
    }
}
