<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    //
    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function index(Request $request)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        // Obtener los parámetros de filtrado desde la solicitud
        $sucursal_codigo = $request->input('suc');
        $tipo_producto = $request->input('tipo_p');
        //dd($tipo_producto);
        // Construir la URL de la API con los parámetros de filtro si están presentes
        $url_stock = $this->base_url . 'inventario/listado_stock.php?sucursal=' . $sucursal_codigo . '&tipo=' . $tipo_producto . '&cod_empresa=' . $empresa;

        $response_stock = Http::get($url_stock);
        //dd($url_stock);
        $stocks = $response_stock->json();


        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php?cod_empresa=' . $empresa);
        $sucursales = $response_suc->json();

        return view('inventario.stock.listado_stock', compact('stocks','sucursales'))->with('baseUrl', $this->base_url);
    }
}
