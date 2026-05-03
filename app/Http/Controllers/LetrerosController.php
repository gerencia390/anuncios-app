<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class LetrerosController extends Controller
{
    private $modulo = "letreros";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }


    /**
     * Display a listing of the resource.
     */
    public function letrero1()
    {
        //anuncios
        $propios = Anuncio::where('tip_id', '3')->where('anu_estado', 1)->get();
        $clasificados = Anuncio::where('tip_id', 1)
            ->where('anu_estado', 1)
            ->whereIn('cat_id', [1, 2, 3])
            ->get();
        // $destacados = Anuncio::where('tip_id', '1')->where('anu_estado', 1)->orderBy('anu_id', 'desc')->get();

        //ajustes
        $conf_tiempo_slide = Settings::where('key', 'tiempo_slide')->first()->value;
        $conf_velocidad_marquee_horizontal = Settings::where('key', 'velocidad_marquee_horizontal')->first()->value;
        $conf_velocidad_marquee_vertical = Settings::where('key', 'velocidad_marquee_vertical')->first()->value;
        $conf_tiempo_entre_fotos = Settings::where('key', 'tiempo_entre_fotos')->first()->value;
        $conf_tiempo_refresco_pagina = Settings::where('key', 'tiempo_refresco_pagina')->first()->value;

        $titulo = "Letrero Anuncios Propios";
        return view('anuncios.letrero1', [
                                                    'titulo'=>$titulo, 
                                                    'clasificados'=>$clasificados,
                                                    'propios'=>$propios,
                                                    'tiempo_slide'=>$conf_tiempo_slide,
                                                    'velocidad_marquee_horizontal'=>$conf_velocidad_marquee_horizontal,
                                                    'velocidad_marquee_vertical'=>$conf_velocidad_marquee_vertical,
                                                    'tiempo_entre_fotos'=>$conf_tiempo_entre_fotos,
                                                    'tiempo_refresco_pagina'=>$conf_tiempo_refresco_pagina,
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }

    public function letrero2()
    {
        //anuncios
        $propios = Anuncio::where('tip_id', '3')->where('anu_estado', 1)->orderBy('anu_id', 'desc')->get();
        $clasificados = Anuncio::where('tip_id', 1)
            ->where('anu_estado', 1)
            ->whereIn('cat_id', [4, 5])
            ->get();
        $destacados = Anuncio::whereIn('tip_id', [1, 2])
            ->where('anu_estado', 1)
            ->orderBy('tip_id', 'desc')   // Primero tip_id = 2, luego 1
            ->orderBy('anu_id', 'desc')   // Dentro de cada grupo, descendente
            ->get();

        //ajustes
        $conf_tiempo_slide = Settings::where('key', 'tiempo_slide')->first()->value;
        $conf_velocidad_marquee_horizontal = Settings::where('key', 'velocidad_marquee_horizontal')->first()->value;
        $conf_velocidad_marquee_vertical = Settings::where('key', 'velocidad_marquee_vertical')->first()->value;
        $conf_tiempo_entre_fotos = Settings::where('key', 'tiempo_entre_fotos')->first()->value;
        $conf_tiempo_refresco_pagina = Settings::where('key', 'tiempo_refresco_pagina')->first()->value;

        $titulo = "Letrero Anuncios Propios";
        return view('anuncios.letrero2', [
                                                    'titulo'=>$titulo, 
                                                    'clasificados'=>$clasificados,
                                                    'propios'=>$propios,
                                                    'tiempo_slide'=>$conf_tiempo_slide,
                                                    'velocidad_marquee_horizontal'=>$conf_velocidad_marquee_horizontal,
                                                    'velocidad_marquee_vertical'=>$conf_velocidad_marquee_vertical,
                                                    'destacados'=>$destacados,
                                                    'tiempo_refresco_pagina'=>$conf_tiempo_refresco_pagina,
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
    
}
