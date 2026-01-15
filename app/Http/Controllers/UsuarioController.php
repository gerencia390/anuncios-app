<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    private $modulo = "usuarios";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $usuarios = Usuario::all();      
        return view('usuarios.lista_usuarios', ['titulo'=>'Usuarios',
                                                          'usuarios' => $usuarios,
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

        $titulo = 'NUEVO USUARIO';

        return view('usuarios.form_nuevo_usuario', ['titulo'=>$titulo, 
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

        //guardar usuario
        $usuario = new Usuario();
        $usuario->usu_nombre = $request->input('usu_nombre');
        $usuario->password = Hash::make($request->input('usu_password'));
        $usuario->usu_nombre_completo = $request->input('usu_nombre_completo');
        $usuario->usu_rol = $request->input('usu_rol');
        $usuario->usu_estado = 1; //activo
        $usuario->save();

        return redirect('usuarios');
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

        $titulo = 'EDITAR USUARIO';
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $usuario = Usuario::where('usu_id', $id)->first();

        return view('usuarios.form_editar_usuario', ['titulo'=>$titulo, 
                                                    'usuario'=>$usuario,
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

        //guardar usuario
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $usuario = Usuario::where('usu_id', $id)->first();
        $usuario->usu_nombre = $request->input('usu_nombre');
        $usuario->usu_nombre_completo = $request->input('usu_nombre_completo');
        $usuario->password = Hash::make($request->input('usu_password'));
        $usuario->usu_rol = $request->input('usu_rol');
        $usuario->save();

        return redirect('usuarios');
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

        $usuario = Usuario::where('usu_id', $id)->first();
        $usuario->delete();
        return redirect('usuarios');
    }
}
