<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function logeo()
    {
        return view('login.login');
    }

    public function acceder(Request $request)
    {
        $url = $this->base_url . 'inicio_sesion/acceder.php';

        // Realiza una solicitud POST a la URL externa con los datos del formulario
        $response = Http::post($url, [
            'email' => $request->input('email'),
            'pass'  => $request->input('pass'),
        ]);

        $data = $response->json();
        //dd($data);

        // Verificar la respuesta
        if ($data['success']) {

            // Almacenar la información del usuario en la sesión
            session(['usuario_logueado' => $data]);

            // Establecer el tiempo de expiración de la sesión (por ejemplo, 24 horas)
            session(['session_expires_at' => now()->addHours(6)]);

            return redirect('/dashboard');
        } else {
            return back()->with('error', $data['errors']);
        }


    }

    public function logout()
    {
        // Terminar la sesión
        session()->flush();

        return redirect('/');
    }
}
