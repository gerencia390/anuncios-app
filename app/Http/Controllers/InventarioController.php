<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\ProductoTagRFID;
use App\Models\Producto;
use App\Models\InventarioLog;
use Illuminate\Support\Facades\Log;

class InventarioController extends Controller
{
    private $modulo = "inventario";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        $inventario = Inventario::all();      
        $log_inventario = InventarioLog::all();
        return view('inventario.lista_inventario', ['titulo'=>'Inventario',
                                                          'log_inventario' => $log_inventario,
                                                          'inventario' => $inventario,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    public function lecturaQr()
    {
        //verificar si esta logueado el usuario
        // if(!Auth::check()){return redirect('/');}

        return view('inventario.qr-lector', ['titulo'=>'QR Lector',
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }


    public function lectura_almacen(Request $request){
        $uid = $request->input('uid');
        $evento = $request->input('evento');
        //obtenemos el tag con uid capturado
        $tag = ProductoTagRFID::where('ptr_uid', $request->uid)->first();
        //obtenemos el producto cuyo tag corresponde
        $producto = Producto::find($tag->pro_id);
        //registramos el movimiento en inventarioLog
        $movimiento = new InventarioLog();
        $movimiento->pro_id = $producto->pro_id;
        $movimiento->ilo_tipo_movimiento = $evento; // entrada/salida
        $movimiento->ilo_cantidad = 1; // Una máquina por tag
        $movimiento->ilo_fuente = 'iot';
        $movimiento->ilo_descripcion = "Movimiento automático por RFID";
        $movimiento->save();

        //Actualizamos inventario
        $inventario = Inventario::where('pro_id', $producto->pro_id)->first();
        if ($evento === 'entrada') {
            $inventario->inv_cantidad += 1;
        } else {
            $inventario->inv_cantidad -= 1;
        }
        $inventario->save();

        // return response()->json(array('status'=>'1', 'lecturas'=>'Saludo a esp32'));
        return response('----> LECTURA PROCESASA DESDE LARAVEL Uid:'.$uid.' Evento: '.$evento);
    }

    public function lectura_entrega(Request $request){
        $uid = $request->input('uid');
        $evento = $request->input('evento');

        //obtenemos el tag con uid capturado
        $tag = ProductoTagRFID::where('ptr_uid', $request->uid)->first();
        //obtenemos el producto cuyo tag corresponde
        $producto = Producto::find($tag->pro_id);
        //obtenemos el detalle de producto en venta cuyo despacho este pendiente
        $detalle = DetalleVenta::where('pro_id', $producto->pro_id)->where('dve_despachos', 0)->first();
        $detalle->dve_despachados = $detalle->dve_despachados + 1;
        $detalle->save();
        //revisamos todos los despachos para cambiar el estado del pedido a despachado
        $dets = DetalleVenta::where('pro_id', $producto->pro_id)->get();
        $nro_dets = count($dets);
        $nro_dets_despacho = 0;
        foreach($dets as $item){
            if($item->dve_cantidad == $item->dve_despachos){
                $nro_dets_despacho += 1;
            }
        }
        if($nro_dets == $nro_dets_despacho){
            $venta = Venta::where('ven_id', $detalle->ven_id);
        }

        

        return response()->json(array('status'=>'1', 'uid'=>$uid, 'tipo'=> $evento));
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
