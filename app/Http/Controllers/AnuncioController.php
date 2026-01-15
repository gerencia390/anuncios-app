<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use App\Models\Settings;

class AnuncioController extends Controller
{
    private $modulo = "anuncios_clientes";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}
        //muestra los todos los anuncios
        $anuncios = Anuncio::all();
        $categorias = Categoria::all();
        $titulo = "Listado de Anuncios Clientes";
        return view('anuncios.lista_anuncios', [
                                                    'titulo'=>$titulo, 
                                                    'anuncios'=>$anuncios,
                                                    'categorias'=>$categorias,
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function letrero1()
    {
        $anunciosPropios = Anuncio::where('tip_id', '1')->get();
        $titulo = "Letrero Anuncios Propios";
        return view('anuncios.letrero1', [
                                                    'titulo'=>$titulo, 
                                                    'anunciosPropios'=>$anunciosPropios,
                                                    'modulo_activo' => $this->modulo
                                                    ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}
        //muestra los todos los anuncios
        $anuncios = Anuncio::all();
        $categorias = Categoria::all();
        $ajustes = Settings::all();
        $titulo = "Nuevo Anuncio";
        //si el anu_codigo es 1-2025 y quiero obtener el codigo maximo del año presente
        $max_codigo = Anuncio::whereYear('anu_', date('Y'))->max('anu_codigo_anuncio')+1;
        return view('anuncios.form_nuevo_anuncio', [
                                                    'titulo'=>$titulo, 
                                                    'anuncios'=>$anuncios,
                                                    'ajustes'=>$ajustes,
                                                    'codigo_siguiente'=>$max_codigo,
                                                    'categorias'=>$categorias,
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}
        $ajustes = Settings::all();
        //guardar el nuevo anuncio
        $anuncio = new Anuncio();
        $anuncio->usu_id = Auth::user()->usu_id;
        $anuncio->tip_id = $request->input('tip_id');
        $anuncio->cat_id = $request->input('cat_id');
        $anuncio->anu_codigo_anuncio = $request->input('anu_codigo_anuncio');
        $anuncio->anu_concepto = $request->input('anu_concepto');
        $anuncio->anu_descripcion = $request->input('anu_descripcion');
        $anuncio->anu_fecha_inicio = $request->input('anu_fecha_inicio');
        //fecha de vencimiento calculado por sistema mas la cantidad de meses de ajustes con key = mese_plazo 
        $meses_plazo = (int)$ajustes->where('key', 'meses_plazo')->first()->value;
        $anuncio->anu_fecha_vencimiento = date('Y-m-d', strtotime($request->input('anu_fecha_inicio')." + ".$meses_plazo." months"));
        $anuncio->anu_cliente = $request->input('anu_cliente');
        $anuncio->anu_nit_ci = $request->input('anu_nit_ci');
        $anuncio->anu_telefonos_contacto = $request->input('anu_telefonos_contacto');
        $anuncio->anu_ubicacion = $request->input('anu_ubicacion');
        $anuncio->anu_precio_sueldo = $request->input('anu_precio_sueldo');
        $anuncio->anu_monto_pago = $request->input('anu_monto_pago');
        $anuncio->anu_nro_factura = $request->input('anu_nro_factura');
        $anuncio->anu_estado = $request->input('anu_estado');
        $anuncio->save();
        return redirect('/anuncios')->with('success', 'Anuncio creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
