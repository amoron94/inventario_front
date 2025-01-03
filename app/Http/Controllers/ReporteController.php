<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReporteController extends Controller
{
    //

    protected $base_url;

    public function __construct()
    {
        $this->base_url = config('app.base_url');
    }

    public function venta()
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php?cod_empresa=' . $empresa);
        $sucursales = $response_suc->json();

        $response_cli = Http::get($this->base_url . 'ingreso/listado_cliente.php?cod_empresa='.$empresa);
        $clientes = $response_cli->json();

        $response_pro = Http::get($this->base_url . 'reporte/listado_productos.php?cod_empresa='.$empresa);
        $productos = $response_pro->json();

        $response_cat = Http::get($this->base_url . 'parametro/listado_categoria.php?cod_empresa='.$empresa);
        $categorias = $response_cat->json();

        $response_usu = Http::get($this->base_url . 'listado_usuario.php?cod_empresa='.$empresa);
        $usuarios = $response_usu->json();

        // Verificar la respuesta
        if ($empresa) {
            return view('reporte.ingreso.venta', compact('clientes','sucursales','productos','categorias','usuarios'))->with('baseUrl', $this->base_url);
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function det_venta_pdf(Request $request){

        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        //dd($request->input('inicio'));
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');
        $sucursal = $request->input('sucursal');
        $cliente = $request->input('cliente');
        $tipo_pago = $request->input('tipo_pago');
        $empresa = $request->input('empresa');
        $activo = $request->input('activo');

        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        $response_ven = Http::post($this->base_url . 'reporte/ventas.php', [
            'inicio'    => $inicio,
            'fin'       => $fin,
            'empresa'   => $empresa,
            'sucursal'  => $sucursal,
            'cliente'   => $cliente,
            'tipo_pago' => $tipo_pago,
            'activo'    => $activo,
        ]);
        $ventas = $response_ven->json();
        //dd($ventas);
        //Genera el PDF
        $pdf = FacadePdf::loadView('reporte.ingreso.det_venta_pdf', compact('empresas','inicio','fin','activo','ventas'));

        // Descarga el PDF
        return $pdf->stream('Detalle de Ventas.pdf');
    }

    public function prod_vendido_pdf(Request $request){
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        //dd($request->input('inicio'));
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');
        $sucursal = $request->input('sucursal');
        $empresa = $request->input('empresa');
        $producto = $request->input('producto');

        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        $response_ven = Http::post($this->base_url . 'reporte/producto_mas_vendido.php', [
            'inicio'    => $inicio,
            'fin'       => $fin,
            'empresa'   => $empresa,
            'sucursal'  => $sucursal,
            'producto'  => $producto,
        ]);
        $ventas = $response_ven->json();
        //dd($ventas);
        //Genera el PDF
        $pdf = FacadePdf::loadView('reporte.ingreso.prod_vendido_pdf', compact('empresas','inicio','fin','ventas'));

        // Descarga el PDF
        return $pdf->stream('Productos mas Vendidos.pdf');
    }

    public function venta_sucursal_pdf(Request $request){
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        //dd($request->input('inicio'));
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');
        $empresa = $request->input('empresa');


        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        $response_ven = Http::post($this->base_url . 'reporte/ventas_sucursal.php', [
            'inicio'    => $inicio,
            'fin'       => $fin,
            'empresa'   => $empresa,
        ]);
        $ventas = $response_ven->json();
        //dd($ventas);
        //Genera el PDF
        $pdf = FacadePdf::loadView('reporte.ingreso.venta_sucursal_pdf', compact('empresas','inicio','fin','ventas'));

        // Descarga el PDF
        return $pdf->stream('Ventas por Sucursal.pdf');
    }

    public function caja_pdf(Request $request){
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        //dd($request->input('inicio'));
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');
        $empresa = $request->input('empresa');
        $sucursal = $request->input('sucursal');

        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        $response_ven = Http::post($this->base_url . 'reporte/cierre_arqueo.php', [
            'inicio'    => $inicio,
            'fin'       => $fin,
            'empresa'   => $empresa,
            'sucursal'  => $sucursal,
        ]);
        $ventas = $response_ven->json();
        //dd($ventas);
        //Genera el PDF
        $pdf = FacadePdf::loadView('reporte.ingreso.caja_pdf', compact('empresas','inicio','fin','ventas'));

        // Descarga el PDF
        return $pdf->stream('Cierre de Caja.pdf');
    }

    public function categoria_pdf(Request $request){
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        //dd($request->input('inicio'));
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');
        $empresa = $request->input('empresa');
        $sucursal = $request->input('sucursal');
        $categoria = $request->input('categoria');

        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        $response_ven = Http::post($this->base_url . 'reporte/categoria_ventas.php', [
            'inicio'    => $inicio,
            'fin'       => $fin,
            'empresa'   => $empresa,
            'sucursal'  => $sucursal,
            'categoria' => $categoria,
        ]);
        $ventas = $response_ven->json();
        //dd($ventas);
        //Genera el PDF
        $pdf = FacadePdf::loadView('reporte.ingreso.categoria_pdf', compact('empresas','inicio','fin','ventas'));

        // Descarga el PDF
        return $pdf->stream('Ventas por Categoria.pdf');
    }

    public function cliente_pdf(Request $request){
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        //dd($request->input('inicio'));
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');
        $empresa = $request->input('empresa');

        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        $response_ven = Http::post($this->base_url . 'reporte/cliente_eliminado.php', [
            'inicio'    => $inicio,
            'fin'       => $fin,
            'empresa'   => $empresa,
        ]);
        $ventas = $response_ven->json();
        //dd($ventas);
        //Genera el PDF
        $pdf = FacadePdf::loadView('reporte.ingreso.cliente_pdf', compact('empresas','inicio','fin','ventas'));

        // Descarga el PDF
        return $pdf->stream('Clientes Eliminados.pdf');
    }

    public function usuario_pdf(Request $request){
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        //dd($request->input('inicio'));
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');
        $empresa = $request->input('empresa');
        $sucursal = $request->input('sucursal');
        $usuario = $request->input('usuario');


        $response_emp = Http::get($this->base_url . 'listado_empresa.php?cod_empresa='.$empresa);
        $empresas = $response_emp->json();

        $response_ven = Http::post($this->base_url . 'reporte/ventas_usuario.php', [
            'inicio'    => $inicio,
            'fin'       => $fin,
            'empresa'   => $empresa,
            'sucursal'  => $sucursal,
            'usuario'   => $usuario,
        ]);
        $ventas = $response_ven->json();
        //dd($ventas);
        //Genera el PDF
        $pdf = FacadePdf::loadView('reporte.ingreso.usuario_pdf', compact('empresas','inicio','fin','ventas'));

        // Descarga el PDF
        return $pdf->stream('Ventas por Usuario.pdf');
    }


}
