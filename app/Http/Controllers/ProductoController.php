<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductoController extends Controller
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

        $response_pro = Http::get($this->base_url . 'producto/listado_producto.php?cod_empresa='.$empresa);
        $productos = $response_pro->json();
        //dd($productos);

        $response_med = Http::get($this->base_url . 'parametro/listado_uni_medida.php?cod_empresa='.$empresa);
        $u_medidas = $response_med->json();

        $response_cat = Http::get($this->base_url . 'parametro/listado_categoria.php?cod_empresa='.$empresa);
        $categorias = $response_cat->json();

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php');
        $sucursales = $response_suc->json();

        // Verificar la respuesta
        if ($productos['success']) {
            return view('producto.listado_producto', compact('productos','u_medidas','categorias','sucursales'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function store(Request $request)
    {
        $usuario = session('usuario_logueado');
        $empresa = $usuario['data']['cod_empresa'];

        $fechaHora = date('dmYHis');
        $img = $request->file('img');
        $img->move(public_path('img/productos'), $fechaHora . "_" . $img->getClientOriginalName());

        // Capturar el valor del checkbox, si no está clickeado será 0
        $cont_inventario = $request->has('cont_inventario') ? 1 : 0;

        //dd($request->all());
        $response = Http::post($this->base_url . 'producto/nuevo_producto.php', [
            'tipo'      => $request->tipo,
            'nombre'    => $request->nombre,
            'medida'    => $request->medida,
            'categoria' => $request->categoria,
            'precio'    => $request->precio,
            'stock_i'   => isset($request->stock_i) ? $request->stock_i : 0,
            'stock_m'   => $request->stock_m,
            'img'       => $fechaHora . "_" . $img->getClientOriginalName(),
            'cont_inv'  => $cont_inventario,
            'empresa'   => $empresa,
        ]);

        $producto = $response->json();

        if ($producto['success']) {
            return back()->with('success', 'Producto Registrado');
        } else {
            return back()->with('error', 'Error al guardar los datos');
        }
    }

    public function update($id, Request $request)
    {
        //dd($request->all());
        $img_prod = $request->img;

        if($img_prod != null){
            $fechaHora = date('dmYHis');
            $img = $request->file('img');
            $img->move(public_path('img/productos'), $fechaHora . "_" . $img->getClientOriginalName());

            $img_prod = $fechaHora . "_" . $img->getClientOriginalName();
        }

        // Capturar el valor del checkbox, si no está clickeado será 0
        $cont_inventario = $request->has('cont_inventario') ? 1 : 0;

        try {
            $response = Http::patch($this->base_url . 'producto/editar_producto.php', [
                'codigo'        => $id,
                'nombre'    => $request->nombre,
                'categoria' => $request->categoria,
                'precio'    => $request->precio,
                'img'       => $img_prod,
                'cont_inv'  => $cont_inventario,
            ]);

            $response->throw();

            return back()->with('success', 'Producto Editado');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'producto/eliminar_producto.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Producto Eliminado');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
