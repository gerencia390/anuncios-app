<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings as Configuracion;

class ConfiguracionController extends Controller
{
    private $modulo = "ajustes";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $conf_precio_clasificado = Configuracion::where('key', 'precio_clasificados')->first()->value;
        $conf_precio_destacado = Configuracion::where('key', 'precio_destacados')->first()->value;
        $conf_max_letras_titulo = Configuracion::where('key', 'max_letras_concepto')->first()->value;
        $conf_max_letras_descripcion = Configuracion::where('key', 'max_letras_descripcion')->first()->value;
        $conf_plazo_contratos_propios = Configuracion::where('key', 'meses_contrato')->first()->value;
        $conf_plazo_publicacion_clasificados = Configuracion::where('key', 'meses_plazo')->first()->value;
        $titulo = "Configuración del sistema";
        return view('configuracion.form_editar_configuracion', [
                                                    'titulo'=>$titulo, 
                                                    'conf_precio_clasificado'=>$conf_precio_clasificado,
                                                    'conf_precio_destacado'=>$conf_precio_destacado,
                                                    'conf_max_letras_titulo'=>$conf_max_letras_titulo,
                                                    'conf_max_letras_descripcion'=>$conf_max_letras_descripcion,
                                                    'conf_plazo_contratos_propios'=>$conf_plazo_contratos_propios,
                                                    'conf_plazo_publicacion_clasificados'=>$conf_plazo_publicacion_clasificados,
                                                    'modulo_activo' => $this->modulo,

                                                    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}
        $conf_max_letras_descripcion = $request->input('conf_max_letras_descripcion');
        $conf_max_letras_titulo = $request->input('conf_max_letras_titulo');
        $conf_plazo_contratos_propios = $request->input('conf_plazo_contratos_propios');
        $conf_plazo_publicacion_clasificados = $request->input('conf_plazo_publicacion_clasificados');
        $conf_precio_clasificado = $request->input('conf_precio_clasificado');
        $conf_precio_destacado = $request->input('conf_precio_destacado');
        Configuracion::where('key', 'precio_clasificados')->update(['value' => $conf_precio_clasificado]);
        Configuracion::where('key', 'precio_destacados')->update(['value' => $conf_precio_destacado]);
        Configuracion::where('key', 'max_letras_concepto')->update(['value' => $conf_max_letras_titulo]);
        Configuracion::where('key', 'max_letras_descripcion')->update(['value' => $conf_max_letras_descripcion]);
        Configuracion::where('key', 'meses_contrato')->update(['value' => $conf_plazo_contratos_propios]);
        Configuracion::where('key', 'meses_plazo')->update(['value' => $conf_plazo_publicacion_clasificados]);
        return redirect('configuracion')->with('success', 'Configuración actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
