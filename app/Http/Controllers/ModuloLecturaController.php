<?php

namespace App\Http\Controllers;

use App\Models\ModuloLectura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class ModuloLecturaController extends Controller
{
    private $modulo = "modsLectura";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $modulos = ModuloLectura::all();      
        return view('mods_lectura.lista_mod_lectura', ['titulo'=>'Modulos de lectura',
                                                          'modulos' => $modulos,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $titulo = 'NUEVO MODULO DE LECTURA';

        return view('mods_lectura.form_nuevo_mod_lectura', ['titulo'=>$titulo, 
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        //guardar datos
        $mod = new ModuloLectura();
        $mod->mol_descripcion = $request->input('mol_descripcion');
        $mod->mol_lat = $request->input('mol_lat');
        $mod->mol_lon = $request->input('mol_lon');
        $mod->save();

        return redirect('modulos-lectura');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $titulo = 'EDITAR MODULO DE LECTURA';
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $mod = ModuloLectura::where('mol_id', $id)->first();

        return view('mods_lectura.form_editar_mod_lectura', ['titulo'=>$titulo, 
                                                    'modulo'=>$mod,
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        //guardar datos
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $mod = ModuloLectura::where('mol_id', $id)->first();
        $mod->mol_descripcion = $request->input('mol_descripcion');
        $mod->mol_lat = $request->input('mol_lat');
        $mod->mol_lon = $request->input('mol_lon');
        $mod->save();

        return redirect('modulos-lectura');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $id = Crypt::decryptString($id);

        $mod = ModuloLectura::where('mol_id', $id)->first();
        $mod->delete();
        return redirect('modulos-lectura');
    }
}
