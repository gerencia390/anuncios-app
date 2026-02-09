@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <div class="title-container">
        <div class="row">
            <div class="col-6">
            <h3 class="title-header" style="text-transform: uppercase;">
                <i class="fa fa-suitcase"></i>
                {{$titulo}}
            </h3>
            </div>        
            <div class="col-6">
                <a href="{{url('anuncios_propios/nuevo')}}" class="btn btn-sm btn-success float-right" style="margin-left:10px;"><i class="fa fa-plus"></i> NUEVO ANUNCIO PROPIO</a>
                <a data-toggle="modal" data-target="#modal-depurar-anuncios" href="#" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-refresh"></i> DEPURAR ANUNCIOS</a>
            </div>        
        </div>
    </div>
    <div class="row">
        <div class="col-12">              
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        @if($anuncios->count() == 0)
                        <div class="alert alert-info">
                            <div class="media">
                                <img src="{{secure_asset('img/alert-info.png')}}" class="align-self-center mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Nota.-</h5>
                                    <p>
                                        NO se tienen items registrados hasta el momento.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="table-responsive">
                        <table class="table table-bordered tabla-datos-anuncios table-hover table-sm">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>CODIGO</th>
                                <th>FECHAS</th>
                                <th>TIPO</th>
                                <th>CATEGORIA</th>
                                <th>CONCEPTO</th>
                                <th>ESTADO</th>
                                <th>OPCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($anuncios as $item)
                            <tr>
                                <td class="text-center">
                                    {{$item->anu_id}}
                                </td>
                                <td class="text-center">
                                    {{$item->anu_codigo_anuncio}}
                                </td>
                                <td class="text-center text-primary">
                                    {{$item->anu_fecha_inicio}}
                                    <br>
                                    <small class="text-danger">
                                    V: {{$item->anu_fecha_vencimiento}}
                                    </small>
                                </td>
                                <td class="text-center">
                                    @if ($item->tip_id == 3)
                                    <span class="badge badge-secondary" style="text-transform: uppercase">{{$item->tipo->tip_nombre}}</span>                                                                            
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{$item->cat_nombre}}
                                </td>
                                <td class="text-center">
                                    {{$item->anu_concepto}}
                                </td>
                                <td class="text-center">
                                    @if($item->anu_estado == 0)
                                        <span class="badge badge-info">GUADADO</span>
                                    @endif
                                    @if($item->anu_estado == 1)
                                        <span class="badge badge-success">PUBLICADO</span>
                                    @endif
                                    @if($item->anu_estado == 2)
                                        <span class="badge badge-primary">FINALIZADO</span>
                                    @endif
                                    @if($item->anu_estado == 3)
                                        <span class="badge badge-danger">VENCIDO</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                      <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        OPCION
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item btn-ver-detalle" 
                                                data-anuId="{{$item->anu_id}}" 
                                                data-tipo="{{$item->tip_nombre}}" 
                                                data-categoria="{{$item->cat_nombre}}" 
                                                data-publicador="{{$item->usu_nombre_completo}}" 
                                                data-codigo="{{$item->anu_codigo_anuncio}}" 
                                                data-concepto="{{$item->anu_concepto}}" 
                                                data-descripcion="{{$item->anu_descripcion}}" 
                                                data-inicio="{{$item->anu_fecha_inicio}}" 
                                                data-fin="{{$item->anu_fecha_vencimiento}}" 
                                                data-cliente="{{$item->anu_cliente}}" 
                                                data-nit="{{$item->anu_nit_ci}}" 
                                                data-telefonos="{{$item->anu_telefonos_contacto}}" 
                                                data-ubicacion="{{$item->anu_ubicacion}}" 
                                                data-precio="{{$item->anu_precio_sueldo}}" 
                                                data-monto="Bs.- {{$item->anu_monto_pago}}" 
                                                data-factura="{{$item->anu_nro_factura}}" 
                                                data-estado="{{$item->anu_estado}}" 
                                                data-imagen_url="{{$item->anu_imagen_url}}" 
                                                data-toggle="modal" 
                                                data-target="#modal-ver-detalle" 
                                                href="#">
                                                <i class="fa fa-eye"></i> 
                                                Ver detalle
                                        </a>
                                        <a class="dropdown-item btn-finalizar-anuncio" data-anuId="{{Crypt::encryptString($item->anu_id)}}" data-codAnuncio="{{$item->anu_codigo_anuncio}}" data-toggle="modal" data-target="#modal-finalizar-anuncio" href="#"><i class="fa fa-paper-plane"></i> Finalizar anuncio</a>
                                        <a class="dropdown-item" href="{{url('anuncios_propios/'.Crypt::encryptString($item->anu_id).'/editar')}}"><i class="fa fa-edit"></i> Editar anuncio</a>
                                        <a class="dropdown-item btn-eliminar-anuncio" data-anuId="{{Crypt::encryptString($item->anu_id)}}" data-codAnuncio="{{$item->anu_codigo_anuncio}}" data-toggle="modal" data-target="#modal-eliminar-anuncio" href="#"><i class="fa fa-trash"></i> Eliminar anuncio</a>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- fin card  -->

        </div>
    </div>
</div>

{{-- INICIO MODAL: DEPURAR ANUNCIOS --}}
<div class="modal fade" id="modal-depurar-anuncios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-refresh"></i>
              DEPURAR ANUNCIOS
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-warning">
                <div class="media">
                    <img src="{{secure_asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Advertencia.-</h5>
                        <p>
                        <h6>
                            Esta opción permite depurar anuncios expirados y los cambia a estado VENCIDO.
                        </h6>
                            ¿Está seguro que desea realizar esta operación?
                        </p>                        
                    </div>
                </div>
            </div>
            <div id="msg-depurar" class="mt-2"></div>
        </div>
        <div class="modal-footer">
        <form id="form-depurar">
            @csrf
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
            <button id="btn-depurar" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Si, depurar</button>
        </form>  
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: DEPURAR ANUNCIOS --}}

{{-- INICIO MODAL: VER DETALLE ANUNCIO --}}
<div class="modal fade" id="modal-ver-detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-file"></i>
              Detalle del anuncio
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <div class="col-12 box-detalle-modal text-center">
                        <img id="img-detalle" src="" style="width: 100%">
                    </div>
                </div>
                <div class="col-6">
                    <div class="box-data-xtra">
                        <div class="row">
                            <div class="col-12 box-detalle-modal">
                                <div class="text-success">CONCEPTO:</div>
                                <div id="txt-concepto"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 box-detalle-modal">
                                <div class="text-success">DESCRIPCION:</div>
                                <div id="txt-descripcion"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 box-detalle-modal">
                            <div class="text-success">FECHA INICIO:</div>
                            <div id="txt-inicio"></div>
                        </div>
                        <div class="col-6 box-detalle-modal">
                            <div class="text-success">FECHA VENCIMIENTO:</div>
                            <div id="txt-fin"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 box-detalle-modal">
                            <div class="text-success">TELEFONOS ASESOR:</div>
                            <div id="txt-telefonos"></div>
                        </div>
                        <div class="col-6 box-detalle-modal">
                            <div class="text-success">ESTADO:</div>
                            <div id="txt-estado"></div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: VER DETALLE ANUNCIO --}}

{{-- INICIO MODAL: ELIMINAR ANUNCIO --}}
<div class="modal fade" id="modal-finalizar-anuncio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-paper-plane"></i>
              Finalizar anuncio
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">CODIGO ANUNCIO: </span>
                    <span id="txt-cod-anuncio"></span><br>
                </h5>
            </div>
            <div class="alert alert-warning">
                <div class="media">
                    <img src="{{secure_asset('img/alert-warning.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            ¿Está seguro de cambiar el estado de este anuncio a FINALIZADO?
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <form id="form-finalizar-anuncio" action="{{secure_url('anuncios_propios')}}" data-simple-action="{{secure_url('anuncios_propios/finalizar')}}" method="post">
            @method('post')
            @csrf
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Si, finalizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: FINALIZAR --}}

{{-- INICIO MODAL: ELIMINAR ANUNCIO --}}
<div class="modal fade" id="modal-eliminar-anuncio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-trash"></i>
              Eliminar anuncio
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <h5>
                    <span class="text-success">CODIGO ANUNCIO: </span>
                    <span id="txt-del-cod-anuncio"></span><br>
                </h5>
            </div>
            <div class="alert alert-danger">
                <div class="media">
                    <img src="{{secure_asset('img/alert-danger.png')}}" class="align-self-center mr-3" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">Cuidado.-</h5>
                        <p>
                            ¿Está seguro que desea eliminar éste registro?
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <form id="form-eliminar-anuncio" action="{{secure_url('anuncios_propios')}}" data-simple-action="{{secure_url('anuncios_propios')}}" method="post">
            @method('delete')
            @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Si, eliminar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: ELIMINAR ESTADO --}}

<script type="text/javascript">
$(function(){
    /*
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos-anuncios').DataTable({"language":{url: '{{secure_asset('js/datatables-lang-es.json')}}'}, "order": [[ 0, "desc" ]]});

    //Conf popover
    $('[data-toggle="popover"]').popover()

    /*
    --------------------------------------------------------------
    Finalizar anuncio
    --------------------------------------------------------------
    */
    $('.btn-finalizar-anuncio').click(function(){
       let anu_id = $(this).attr('data-anuId');
       let anu_codigo = $(this).attr('data-codAnuncio');
       $('#txt-cod-anuncio').html(anu_codigo);
       //form data
       action = $('#form-finalizar-anuncio').attr('data-simple-action');
       action = action+'/'+anu_id;
       $('#form-finalizar-anuncio').attr('action',action);
   });

    /*
    --------------------------------------------------------------
    ELIMINAR anuncio
    --------------------------------------------------------------
    */
    $('.btn-eliminar-anuncio').click(function(){
       let anu_id = $(this).attr('data-anuId');
       let anu_codigo = $(this).attr('data-codAnuncio');
       $('#txt-del-cod-anuncio').html(anu_codigo);
       //form data
       action = $('#form-eliminar-anuncio').attr('data-simple-action');
       action = action+'/'+anu_id;
       $('#form-eliminar-anuncio').attr('action',action);
   });
    /*
    * Depuracion de anuncios vencidos
    */
    $('#form-depurar').on('submit', function (e) {

        e.preventDefault(); // evita submit normal

        let form = $(this);
        let btn = $('#btn-depurar');
        let msgBox = $('#msg-depurar');

        btn.prop('disabled', true);
        msgBox
            .removeClass()
            .addClass('alert alert-info')
            .text('Procesando...');

        $.ajax({
            url: '{{ url("api/anuncios/depurar") }}',
            type: 'POST',
            data: form.serialize(), // 
            success: function (response) {
                console.log("Respuesta status:"+response.status);
                if (response.status == '1') {
                    msgBox
                        .removeClass()
                        .addClass('alert alert-success')
                        .text(response.msg);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);                    
                } else {
                    msgBox
                        .removeClass()
                        .addClass('alert alert-warning')
                        .text(response.msg);
                }
            },
            error: function () {
                msgBox
                    .removeClass()
                    .addClass('alert alert-danger')
                    .text('Error inesperado al procesar la solicitud');
            },
            complete: function () {
                btn.prop('disabled', false);
            }
        });

    });

    /*
    mostrar detalle de anuncio
    */
    $('.btn-ver-detalle').click(function(){
        $('#txt-tipo').html($(this).attr('data-tipo'));
        $('#txt-categoria').html($(this).attr('data-categoria'));
        $('#txt-publicador').html($(this).attr('data-publicador'));
        $('#txt-codigo').html($(this).attr('data-codigo'));
        $('#txt-concepto').html($(this).attr('data-concepto'));
        $('#txt-descripcion').html($(this).attr('data-descripcion'));
        $('#txt-inicio').html($(this).attr('data-inicio'));
        $('#txt-fin').html($(this).attr('data-fin'));
        $('#txt-cliente').html($(this).attr('data-cliente'));
        $('#txt-nit').html($(this).attr('data-nit'));
        $('#txt-telefonos').html($(this).attr('data-telefonos'));
        $('#txt-ubicacion').html($(this).attr('data-ubicacion'));
        $('#txt-precio').html($(this).attr('data-precio'));
        $('#txt-monto').html($(this).attr('data-monto'));
        $('#txt-factura').html($(this).attr('data-factura'));
        $('#img-detalle').attr("src", $(this).attr('data-imagen_url'));
        var estado = $(this).attr('data-estado');
        if(estado == 0){ $('#txt-estado').html('<span class="badge badge-info">GUARDADO</span>'); }
        if(estado == 1){ $('#txt-estado').html('<span class="badge badge-success">PUBLICADO</span>'); }
        if(estado == 2){ $('#txt-estado').html('<span class="badge badge-primary">FINALIZADO</span>'); }
        if(estado == 3){ $('#txt-estado').html('<span class="badge badge-danger">VENCIDO</span>'); }
    });


});



</script>




@endsection
