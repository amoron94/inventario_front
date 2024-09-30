<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PosController extends Controller
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
        //dd($cod_user);

        $response_emp = Http::get($this->base_url . 'listado_empresa.php');
        $empresas = $response_emp->json();

        $response_caja = Http::get($this->base_url . 'ingreso/listado_caja.php?codigo='.$cod_user);
        $cajas = $response_caja->json();

        $cod_sucursal = isset($cajas['data']['cod_sucursal']) ? $cajas['data']['cod_sucursal'] : "0";

        //----------------------------- POS -----------------------------------

        $response_cat = Http::get($this->base_url . 'ingreso/get_categorias.php?codigo='.$cod_sucursal);
        $categorias = $response_cat->json();

        $response_pro = Http::get($this->base_url . 'ingreso/get_productos.php?codigo='.$cod_sucursal);
        $productos = $response_pro->json();

        $response_cli = Http::get($this->base_url . 'ingreso/listado_cliente_pos.php');
        $clientes = $response_cli->json();

        //----------------------------- Sirve Apertura --------------------------------

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php');
        $sucursales = $response_suc->json();


        //----------------------------- Sirve Cierre --------------------------------

        $response_bi = Http::get($this->base_url . 'ingreso/listado_billete.php');
        $billetes = $response_bi->json();

        return view('ingreso.pos.apertura_caja', compact('empresas', 'cajas', 'sucursales', 'categorias', 'productos', 'billetes', 'clientes'))->with('baseUrl', $this->base_url);
    }

    public function crearCaja(Request $request)
    {
        $usuario = session('usuario_logueado');
        $cod_user = $usuario['data']['codigo'];

        //dd($request->all());
        $response = Http::post($this->base_url . 'ingreso/nueva_caja.php', [
            'cod_user'          => $cod_user,
            'sucursal'          => $request->sucursal,
            'monto'             => $request->monto
        ]);

        $cajas = $response->json();

        if ($cajas['success']) {
            return back()->with('success', 'Punto de Venta Abierto');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }
}
