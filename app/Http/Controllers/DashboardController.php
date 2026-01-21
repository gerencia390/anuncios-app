<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private $modulo = "dashboard";

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $usuario = Auth::user();
        $anuncios_propios = Anuncio::where('tip_id', 3)->orderBy('anu_id', 'desc')->get();
        $anuncios = Anuncio::where('tip_id', 1)->orWhere('tip_id', 2)->orderBy('anu_id', 'desc')->get();// clasificados y destacados
        $usuarios = Usuario::all();
        $titulo = "Panel General";
        $fecha_hoy = date('Y-m-d');
        $mes = date('m');
        $anio = date('Y');
        /**
         * CLASIFICADOS
         */
        //anuncios del dia, mes y año
        $anuncios_anio= Anuncio::whereYear('anu_fecha_inicio', $anio)->where('tip_id', 1)->orWhere('tip_id', 2)->get();
        $anuncios_mes = Anuncio::whereMonth('anu_fecha_inicio', $mes)->where('tip_id', 1)->orWhere('tip_id', 2)->get();
        $anuncios_dia = Anuncio::whereDate('anu_fecha_inicio', $fecha_hoy)->where('tip_id', 1)->orWhere('tip_id', 2)->get();
        //anuncios por estado
        $anuncios_guardado= Anuncio::where('anu_estado', 0)->where('tip_id', 1)->orWhere('tip_id', 2)->get();
        $anuncios_publicado= Anuncio::where('anu_estado', 1)->where('tip_id', 1)->orWhere('tip_id', 2)->get();
        $anuncios_finalizado = Anuncio::where('anu_estado', 2)->where('tip_id', 1)->orWhere('tip_id', 2)->get();
        $anuncios_vencido = Anuncio::where('anu_estado', 3)->where('tip_id', 1)->orWhere('tip_id', 2)->get();
        //para grafico registrados ultimos meses
        $anuncios_ultimos_6_meses = collect();

        for ($i = 5; $i >= 0; $i--) {

            $inicio = Carbon::now()->subMonths($i)->startOfMonth();
            $fin    = Carbon::now()->subMonths($i)->endOfMonth();

            $total = Anuncio::whereBetween('anu_fecha_inicio', [$inicio, $fin])->where('tip_id', 1)->orWhere('tip_id',2)
                ->count();

            $anuncios_ultimos_6_meses->push([
                'anio'     => $inicio->year,
                'mes_num'  => $inicio->month,
                'mes'      => $inicio->locale('es')->monthName,
                'cantidad' => $total
            ]);
        }


        /**
         * PROPIOS
         */
        //anuncios del dia, mes y año
        $anuncios_anio_propio= Anuncio::whereYear('anu_fecha_inicio', $anio)->where('tip_id', 3)->get();
        $anuncios_mes_propio = Anuncio::whereMonth('anu_fecha_inicio', $mes)->where('tip_id', 3)->get();
        $anuncios_dia_propio = Anuncio::whereDate('anu_fecha_inicio', $fecha_hoy)->where('tip_id', 3)->get();
        //anuncios por estado
        $anuncios_guardado_propio = Anuncio::where('anu_estado', 0)->where('tip_id', 3)->get();
        $anuncios_publicado_propio = Anuncio::where('anu_estado', 1)->where('tip_id', 3)->get();
        $anuncios_finalizado_propio = Anuncio::where('anu_estado', 2)->where('tip_id', 3)->get();
        $anuncios_vencido_propio = Anuncio::where('anu_estado', 3)->where('tip_id', 3)->get();
        //propios ultimos 6 meses
        $propios_ultimos_6_meses = collect();

        for ($i = 5; $i >= 0; $i--) {

            $inicio = Carbon::now()->subMonths($i)->startOfMonth();
            $fin    = Carbon::now()->subMonths($i)->endOfMonth();

            $total = Anuncio::whereBetween('anu_fecha_inicio', [$inicio, $fin])->where('tip_id', 3)
                ->count();

            $propios_ultimos_6_meses->push([
                'anio'     => $inicio->year,
                'mes_num'  => $inicio->month,
                'mes'      => $inicio->locale('es')->monthName,
                'cantidad' => $total
            ]);
        }

        return view('dashboard.detalle_tablero', [
                                                    'usuario'=>$usuario, 
                                                    'titulo'=>$titulo, 
                                                    'anuncios'=>$anuncios,
                                                    'anuncios_propios'=>$anuncios_propios,
                                                    //clasificados
                                                    'anuncios_dia'=>$anuncios_dia,
                                                    'anuncios_mes'=>$anuncios_mes,
                                                    'anuncios_anio'=>$anuncios_anio,
                                                    'anuncios_guardados'=>$anuncios_guardado,
                                                    'anuncios_publicados'=>$anuncios_publicado,
                                                    'anuncios_finalizados'=>$anuncios_finalizado,
                                                    'anuncios_vencidos'=>$anuncios_vencido,
                                                    'anuncios_ultimos_6_meses'=>$anuncios_ultimos_6_meses,
                                                    //propios
                                                    'anuncios_dia_propio'=>$anuncios_dia_propio,
                                                    'anuncios_mes_propio'=>$anuncios_mes_propio,
                                                    'anuncios_anio_propio'=>$anuncios_anio_propio,
                                                    'anuncios_guardados_propio'=>$anuncios_guardado_propio,
                                                    'anuncios_publicados_propio'=>$anuncios_publicado_propio,
                                                    'anuncios_finalizados_propio'=>$anuncios_finalizado_propio,
                                                    'anuncios_vencidos_propio'=>$anuncios_vencido_propio,
                                                    'propios_ultimos_6_meses'=>$propios_ultimos_6_meses,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
