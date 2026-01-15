<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Cliente;
use App\Models\Inventario;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    private $modulo = "ventas";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $ventas = Venta::all();      
        return view('ventas.lista_ventas', ['titulo'=>'Ventas',
                                                          'ventas' => $ventas,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //verificar si esta logueado el producto
        if(!Auth::check()){return redirect('/');}

        $titulo = 'NUEVA VENTA';
        $inventario = Inventario::all();

        return view('ventas.form_nueva_venta', ['titulo'=>$titulo, 
                                                    'modulo_activo' => $this->modulo,
                                                    'inventario'=>$inventario
                                                    ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function detalle_venta($ven_id)
    {
        //verificar si esta logueado el producto
        if(!Auth::check()){return redirect('/');}

        $titulo = 'DETALLE DE VENTA';
        $venta = Venta::where('ven_id', $ven_id)->first();
        $detalle = DetalleVenta::where('ven_id', $ven_id)->get();

        return view('ventas.detalle_venta', ['titulo'=>$titulo, 
                                                    'modulo_activo' => $this->modulo,
                                                    'venta'=>$venta,
                                                    'detalle'=>$detalle,
                                                    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //verificar si esta logueado el producto
        if(!Auth::check()){return redirect('/');}

        $nro_documento = $request->input('cli_nro_documento');
        $cliente = Cliente::where('cli_nro_documento', $nro_documento)->first();
        if($cliente == null){
            $cliente = new Cliente();
            $cliente->cli_nombre = $request->input('cli_nombre');
            $cliente->cli_nro_documento = $request->input('cli_nro_documento');
            $cliente->cli_telefono = $request->input('cli_telefono');
            $cliente->cli_email = $request->input('cli_email');
            $cliente->save();
        }

        $carrito = json_decode($request->carrito_json, true);

        $total_venta = 0;
        foreach ($carrito as $item) {
            //sumando el total de venta
            $total_venta = $total_venta + $item["subtotal"];
        }

        $venta = new Venta();
        $venta->cli_id = $cliente->cli_id;
        $venta->usu_id = Auth::user()->usu_id;//usuario que registra la venta
        $venta->ven_total = $total_venta;
        $venta->ven_metodo_pago = $request->input('ven_metodo_pago');
        $venta->ven_fecha_venta = $request->input('ven_fecha_venta');
        $venta->save();

        foreach ($carrito as $item) {
            $detalle_venta = new DetalleVenta();
            // producto_id
            $detalle_venta->pro_id = $item["producto_id"];
            // precio_unitario
            $detalle_venta->dve_precio_unitario = $item["precio_unitario"];
            // cantidad
            $detalle_venta->dve_cantidad = $item["cantidad"];
            //subtotal
            $detalle_venta->dve_subtotal = $item["subtotal"];
            $detalle_venta->ven_id = $venta->ven_id;
            $detalle_venta->save();

        }

        
        return redirect('ventas');
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
