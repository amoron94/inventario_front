<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoteController extends Controller
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

        $response_pro = Http::get($this->base_url . 'inventario/listado_producto_lote.php?cod_empresa='.$empresa);
        $productos = $response_pro->json();
        //dd($productos);

        $response_med = Http::get($this->base_url . 'parametro/listado_uni_medida.php?cod_empresa='.$empresa);
        $u_medidas = $response_med->json();

        $response_cat = Http::get($this->base_url . 'parametro/listado_categoria.php?cod_empresa='.$empresa);
        $categorias = $response_cat->json();

        $response_suc = Http::get($this->base_url . 'inventario/listado_sucursal.php?cod_empresa='.$empresa);
        $sucursales = $response_suc->json();

        // Verificar la respuesta
        if ($productos['success']) {
            return view('inventario.lote.listado_lote', compact('productos','u_medidas','categorias','sucursales'));
        }else{
            return back()->with('error', 'No se puede conectar con la BD');
        }
    }

    public function ver($id)
    {
        $response_lote = Http::get($this->base_url . 'inventario/listado_lote.php?codigo='.$id);
        $lotes = $response_lote->json();
        //dd($movimientos);
        // Pasar los datos a la vista de impresión
        return view('inventario.lote.ver_lote', compact('lotes'));
    }

    public function update($id, Request $request)
    {

        try {
            $response = Http::patch($this->base_url . 'inventario/editar_lote.php', [
                'codigo'        => $id,
                'fecha'         => $request->f_vencimiento
            ]);

            $response->throw();

            return back()->with('success', 'Lote Editado');

        } catch (\Illuminate\Http\Client\RequestException $exception) {

            return back()->with('error', 'Error al editar los datos');

        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete($this->base_url . 'inventario/eliminar_lote.php', [
                'codigo'        => $id,
            ]);

            $response->throw();

            return back()->with('success', 'Lote Eliminado');
        } catch (\Illuminate\Http\Client\RequestException $exception) {
            return back()->with('error', 'Error al eliminar el dato');
        }

    }
}
