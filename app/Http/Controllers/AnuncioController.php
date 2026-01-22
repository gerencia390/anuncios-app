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
        // anuncios clasificados y destacados
        $anuncios = Anuncio::whereIn('tip_id', [1, 2])
            ->orderByDesc('anu_id')
            ->limit(10)
            ->get();

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
        $propios = Anuncio::where('tip_id', '3')->where('anu_estado', 1)->orderBy('anu_id', 'desc')->get();
        $clasificados = Anuncio::where('tip_id', '1')->where('anu_estado', 1)->orderBy('anu_id', 'desc')->get();
        $titulo = "Letrero Anuncios Propios";
        return view('anuncios.letrero1', [
                                                    'titulo'=>$titulo, 
                                                    'clasificados'=>$clasificados,
                                                    'propios'=>$propios,
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
        $anio = date('Y');

        $max = DB::table('anuncios')
            ->selectRaw("MAX(CAST(split_part(anu_codigo_anuncio, '-', 2) AS INTEGER)) as max_codigo")
            ->whereRaw("split_part(anu_codigo_anuncio, '-', 3) = ?", [$anio])
            ->where('tip_id', 1)
            ->orWhere('tip_id', 2)
            ->value('max_codigo');

        $siguiente = ($max ?? 0) + 1;
        $nuevoCodigo = "-{$siguiente}-{$anio}";
        return view('anuncios.form_nuevo_anuncio', [
                                                    'titulo'=>$titulo, 
                                                    'anuncios'=>$anuncios,
                                                    'ajustes'=>$ajustes,
                                                    'codigo_siguiente'=>$nuevoCodigo,
                                                    'categorias'=>$categorias,
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }

    //calcula la fecha de vencimiento
    public function calcularFechaVencimiento($fechaInicio, $lapso)
    {
        return Carbon::parse($fechaInicio)->addMonthsNoOverflow($lapso);
    }

    /*
    * Funcion para ajustar vencimientos
     */
    public function ajustar_vencimientos(Request $request){
        $anuncios = Anuncio::all();
        if(count($anuncios) == 0){
            return response()->json(array('status'=>'0', 'msg'=>'No hay anuncios registrados'));
        }else{
            foreach($anuncios as $item){
                $item->anu_fecha_vencimiento = self::calcularFechaVencimiento($item->anu_fecha_inicio, 2);
                $item->anu_estado = 1;//publicado
                $item->save();            
            }        
            return response()->json(array('status'=>'1', 'msg'=>'Vencimientos ajustado'));
        }
    }


    /*
    * Funcion para depurar anuncios expirados
     */
    public function depurar(){
        $anuncios = Anuncio::all();        
        $anuncios = self::depurarAnunciosVencidos();
        try {
            return response()->json(array('status'=>'1', 'msg'=>'Depuracion realizada'));
        } catch (\Throwable $th) {
            return response()->json(array('status'=>'0', 'msg'=>'Ocurrio un error al depurar'));
        }
    }

    //funcion interna consulta para depurar
    public function depurarAnunciosVencidos()
    {
        return Anuncio::where('anu_estado', 1)//publicado
            ->whereDate('anu_fecha_vencimiento', '<', Carbon::today())//
            ->update([
                'anu_estado' => 3 //vencido
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
        $anuncio->anu_precio_sueldo = $request->input('anu_precio');
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
    public function edit($id)
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $id = Crypt::decryptString($id);

        $anuncio = Anuncio::where('anu_id', $id)->first();
        $categorias = Categoria::all();
        $ajustes = Settings::all();
        $titulo = "Editar Anuncio";

        return view('anuncios.form_editar_anuncio', [
                                                    'titulo'=>$titulo, 
                                                    'anuncio'=>$anuncio,
                                                    'ajustes'=>$ajustes,
                                                    'categorias'=>$categorias,
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}
        $id = Crypt::decryptString($id);
        $ajustes = Settings::all();
        //guardar el nuevo anuncio
        $anuncio = Anuncio::where('anu_id', $id)->first();
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
        $anuncio->anu_precio_sueldo = $request->input('anu_precio');
        $anuncio->anu_monto_pago = $request->input('anu_monto_pago');
        $anuncio->anu_nro_factura = $request->input('anu_nro_factura');
        $anuncio->anu_estado = $request->input('anu_estado');
        $anuncio->save();
        return redirect('/anuncios')->with('success', 'Anuncio creado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $id = Crypt::decryptString($id);

        $anuncio = Anuncio::where('anu_id', $id)->first();
        $anuncio->delete();
        return redirect('anuncios');
    }

    //finalizar anuncio, es decir, cambiar estado
    public function finalizar($anu_id){
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}
        $anu_id = Crypt::decryptString($anu_id);

        $anuncio = Anuncio::where('anu_id', $anu_id)->first();
        $anuncio->anu_estado = 2; // finalizado
        $anuncio->save();        
        return redirect('anuncios');
    }
    
}
