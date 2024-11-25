<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmpresaController extends Controller
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

        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        return view('listado_empresa', compact('empresas'));
    }

    public function update($id, Request $request)
    {
        // Capturar la imagen subida, si existe
        $img_prod = $request->img;

        if ($img_prod != null) {
            $fechaHora = date('dmYHis');
            $img = $request->file('img');
            $img->move(public_path('img/empresa'), $fechaHora . "_" . $img->getClientOriginalName());

            $img_prod = $fechaHora . "_" . $img->getClientOriginalName();
        }

        try {
            // Realizar la solicitud PATCH al archivo PHP externo
            $response = Http::patch($this->base_url . 'editar_empresa.php', [
                'codigo'   => $id,
                'nombre'   => strtoupper($request->nombre),
                'direccion'=> strtoupper($request->direccion),
                'telefono' => $request->telefono,
                'slogan'   => strtoupper($request->slogan),
                'img'      => $img_prod
            ]);

            $response->throw();

            return back()->with('success', 'Empresa editada exitosamente');

        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al editar los datos');
        }
    }
}
