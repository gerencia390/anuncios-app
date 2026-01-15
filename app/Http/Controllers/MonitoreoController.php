<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\ModuloLectura;

class MonitoreoController extends Controller
{
    private $modulo = "monitoreo";
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
         return view('monitoreo.lista_mod_lectura', ['titulo'=>'Monitoreo de modulos de lectura',
                                                           'modulos' => $modulos,
                                                           'modulo_activo' => $this->modulo
                                                          ]);
     }
 
     public function mapa()
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $modulos = ModuloLectura::all();      
        return view('monitoreo.mapa_monitoreo', ['titulo'=>'Mapa de Monitoreo',
                                                          'modulos' => $modulos,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    public function monitoreo_modulo_lectura($id){
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $titulo = 'MODULO LECTURA - DATOS EN TIEMPO REAL';
        // $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $mod = ModuloLectura::where('mol_id', $id)->first();

        return view('monitoreo.detalle_modulo_lectura', ['titulo'=>$titulo, 
                                                    'modulo'=>$mod,
                                                    'modulo_activo' => $this->modulo
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
