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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AnuncioPropioController extends Controller
{
    private $modulo = "anuncios_propios";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}
        //muestra los todos los anuncios
        $anuncios = Anuncio::
        select(
                'anuncios.anu_id',
                'tipos.tip_id',
                'categorias.cat_id',
                'tipos.tip_nombre',
                'categorias.cat_nombre',
                'usuarios.usu_nombre_completo',
                'anuncios.anu_codigo_anuncio',
                'anuncios.anu_concepto',
                'anuncios.anu_descripcion',
                'anuncios.anu_fecha_inicio',
                'anuncios.anu_fecha_vencimiento',
                'anuncios.anu_telefonos_contacto',
                'anuncios.anu_estado',
                'anuncios.anu_imagen_url'
            )
            ->join('tipos', 'tipos.tip_id', '=', 'anuncios.tip_id')
            ->join('categorias', 'categorias.cat_id', '=', 'anuncios.cat_id')
            ->join('usuarios', 'usuarios.usu_id', '=', 'anuncios.usu_id')
            ->where('anuncios.tip_id', 3)->orderBy('anu_id', 'desc')->get();
        $categorias = Categoria::all();
        $titulo = "Listado de Anuncios Propios";
        return view('anuncios.lista_anuncios_propios', [
                                                    'titulo'=>$titulo, 
                                                    'anuncios'=>$anuncios,
                                                    'categorias'=>$categorias,
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
        $ajustes = Settings::all();
        $titulo = "Nuevo Anuncio Propio";

        return view('anuncios.form_nuevo_anuncio_propio', [
                                                    'titulo'=>$titulo, 
                                                    'ajustes'=>$ajustes,
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }

    public function existe_codigo(Request $request)
    {
        $existe = Anuncio::where('anu_codigo_anuncio', $request->anu_codigo)->exists();

        return response()->json([
            'status' => $existe ? 1 : 0
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        // verificar si esta logueado el usuario
        if(!Auth::check()){
            return redirect('/');
        }

        // VALIDACIÓN PARA MÚLTIPLES IMÁGENES
        $request->validate([
            'anu_imagen_url.*' => 'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $rutas = [];

        // SUBIR MÚLTIPLES ARCHIVOS
        if ($request->hasFile('anu_imagen_url')) {

            foreach ($request->file('anu_imagen_url') as $archivo) {

                $nombre = Str::uuid() . '.' . $archivo->getClientOriginalExtension();

                $ruta = Storage::disk('supabase')
                    ->putFileAs('propios', $archivo, $nombre, 'public');

                $img_url = 'https://' . env('SUPABASE_PROJECT_ID') . '.supabase.co/storage/v1/object/public/archivos-anuncios/' . $ruta;

                $rutas[] = $img_url;
            }
        }

        // CONVERTIR ARRAY A STRING CON |
        $img_urls_string = implode('|', $rutas);

        $ajustes = Settings::all();

        // guardar el nuevo anuncio
        $anuncio = new Anuncio();
        $anuncio->usu_id = Auth::user()->usu_id;
        $anuncio->tip_id = 3; // propios
        $anuncio->cat_id = 1; // venta propiedades
        $anuncio->anu_codigo_anuncio = $request->input('anu_codigo_anuncio');
        $anuncio->anu_concepto = $request->input('anu_concepto');
        $anuncio->anu_descripcion = $request->input('anu_descripcion');
        $anuncio->anu_fecha_inicio = $request->input('anu_fecha_inicio');

        // fecha de vencimiento
        $meses_plazo = (int)$ajustes->where('key', 'meses_contrato')->first()->value;

        $anuncio->anu_fecha_vencimiento = date(
            'Y-m-d',
            strtotime($request->input('anu_fecha_inicio') . " + " . $meses_plazo . " months")
        );

        $anuncio->anu_cliente = "SUPERCASAS";
        $anuncio->anu_nit_ci = "";
        $anuncio->anu_telefonos_contacto = $request->input('anu_telefonos_contacto');
        $anuncio->anu_ubicacion = "";

        // AQUÍ GUARDAS TODAS LAS IMÁGENES
        $anuncio->anu_imagen_url = $img_urls_string;

        $anuncio->anu_estado = $request->input('anu_estado');
        $anuncio->save();

        return redirect('/anuncios_propios')->with('success', 'Anuncio creado correctamente');
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
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}

        $id = Crypt::decryptString($id);

        $anuncio = Anuncio::where('anu_id', $id)->first();
        $categorias = Categoria::all();
        $ajustes = Settings::all();
        $titulo = "Editar Anuncio Propio";

        return view('anuncios.form_editar_anuncio_propio', [
                                                    'titulo'=>$titulo, 
                                                    'anuncio'=>$anuncio,
                                                    'ajustes'=>$ajustes,
                                                    'categorias'=>$categorias,
                                                    'modulo_activo' => $this->modulo
                                                    ]);
    }

    /**
     * Update
     */
    public function update(Request $request, string $id)
    {
        if(!Auth::check()){
            return redirect('/');
        }

        // ✅ validación múltiple
        $validator = Validator::make($request->all(), [
            'anu_imagen_url.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $ajustes = Settings::all();

        $id = Crypt::decryptString($id);
        $anuncio = Anuncio::where('anu_id', $id)->first();

        // 🔥 SOLO SI SUBE NUEVAS IMÁGENES
        if ($request->hasFile('anu_imagen_url')) {

            // =============================
            // 🧹 1. ELIMINAR IMÁGENES ANTIGUAS
            // =============================
            if ($anuncio->anu_imagen_url) {

                $imagenesAntiguas = explode('|', $anuncio->anu_imagen_url);

                foreach ($imagenesAntiguas as $img) {

                    if (trim($img) === '') continue;

                    // extraer ruta relativa desde la URL
                    $ruta = str_replace(
                        'https://' . env('SUPABASE_PROJECT_ID') . '.supabase.co/storage/v1/object/public/archivos-anuncios/',
                        '',
                        $img
                    );

                    Storage::disk('supabase')->delete($ruta);
                }
            }

            // =============================
            // 📤 2. SUBIR NUEVAS IMÁGENES
            // =============================
            $nuevasImagenes = [];

            foreach ($request->file('anu_imagen_url') as $archivo) {

                $nombre = Str::uuid() . '.' . $archivo->getClientOriginalExtension();

                $ruta = Storage::disk('supabase')
                    ->putFileAs('propios', $archivo, $nombre, 'public');

                $img_url = 'https://' . env('SUPABASE_PROJECT_ID') . '.supabase.co/storage/v1/object/public/archivos-anuncios/' . $ruta;

                $nuevasImagenes[] = $img_url;
            }

            // 🔥 REEMPLAZAR completamente
            $anuncio->anu_imagen_url = implode('|', $nuevasImagenes);
        }

        // =============================
        // 🧾 RESTO DE CAMPOS
        // =============================
        $anuncio->usu_id = Auth::user()->usu_id;
        $anuncio->tip_id = 3;
        $anuncio->cat_id = 1;
        $anuncio->anu_codigo_anuncio = $request->input('anu_codigo_anuncio');
        $anuncio->anu_concepto = $request->input('anu_concepto');
        $anuncio->anu_descripcion = $request->input('anu_descripcion');
        $anuncio->anu_fecha_inicio = $request->input('anu_fecha_inicio');

        $meses_plazo = (int)$ajustes->where('key', 'meses_contrato')->first()->value;

        $anuncio->anu_fecha_vencimiento = date(
            'Y-m-d',
            strtotime($request->input('anu_fecha_inicio') . " + " . $meses_plazo . " months")
        );

        $anuncio->anu_cliente = "SUPERCASAS";
        $anuncio->anu_nit_ci = "";
        $anuncio->anu_telefonos_contacto = $request->input('anu_telefonos_contacto');
        $anuncio->anu_ubicacion = "";
        $anuncio->anu_estado = $request->input('anu_estado');

        $anuncio->save();

        return redirect('/anuncios_propios')->with('success', 'Anuncio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // verificar si esta logueado el usuario
            if(!Auth::check()){
                return redirect('/');
            }

            $id = Crypt::decryptString($id);

            $anuncio = Anuncio::where('anu_id', $id)->first();

            // 🔥 VALIDAR QUE EXISTA
            if (!$anuncio) {
                return abort(404);
            }

            // =============================
            // 🧹 ELIMINAR TODAS LAS IMÁGENES
            // =============================
            if ($anuncio->anu_imagen_url) {

                $imagenes = explode('|', $anuncio->anu_imagen_url);

                foreach ($imagenes as $img) {

                    if (trim($img) === '') continue;

                    // 🔹 forma robusta de obtener la ruta
                    $parts = explode('/archivos-anuncios/', $img);

                    if (isset($parts[1])) {
                        $ruta = $parts[1];
                        Storage::disk('supabase')->delete($ruta);
                    }
                }
            }

            // =============================
            // 🗑️ ELIMINAR REGISTRO
            // =============================
            $anuncio->delete();

            return redirect('anuncios_propios');

        } catch (\Throwable $th) {
            return abort(404);
        }
    }    

    //finalizar anuncio, es decir, cambiar estado
    public function finalizar($anu_id){
        //verificar si esta logueado el usuario
        if(!Auth::check()){return redirect('/');}
        $anu_id = Crypt::decryptString($anu_id);

        $anuncio = Anuncio::where('anu_id', $anu_id)->first();
        $anuncio->anu_estado = 2; // finalizado
        $anuncio->save();        
        return redirect('anuncios_propios');
    }
}
