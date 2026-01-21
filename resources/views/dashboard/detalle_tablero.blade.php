@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <div class="title-container">
        <div class="row">
            <div class="col-6">
				<h3 class="title-header" style="text-transform: uppercase;">
					<i class="fa fa-home"></i>
					{{$titulo}}
				</h3>
			</div>
            <div class="col-6">
			</div>
		</div>
	</div>		

    <div class="row">
        <div class="col-12">
                <!-- inicio card  -->
                <div class="card card-stat">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="title-dash col">
                                    INFORMACIÓN ANUNCIOS CLASIFICADOS
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box-result">
                                            <h1>{{$anuncios_dia->count()}}</h1>
                                            <small>ANUNCIOS DEL DIA</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box-result">
                                            <h1>{{$anuncios_mes->count()}}</h1>
                                            <small>ANUNCIOS DEL MES</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box-result">
                                            <h1>{{$anuncios_anio->count()}}</h1>
                                            <small>ANUNCIOS DEL AÑO</small>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="text-info">ESTADO DE ANUNCIOS CLASIFICADOS</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="box-result-numbers">
                                            <h1>{{$anuncios_guardados->count()}}</h1>
                                            <small>GUARDADOS</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box-result-numbers">
                                            <h1>{{$anuncios_publicados->count()}}</h1>
                                            <small>PUBLICADOS</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box-result-numbers">
                                            <h1>{{$anuncios_finalizados->count()}}</h1>
                                            <small>FINALIZADOS</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box-result-numbers">
                                            <h1>{{$anuncios_vencidos->count()}}</h1>
                                            <small>VENCIDOS</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h4 class="text-primary"><i class="fa fa-bar-chart"></i> Clasificados ultimos 6 meses</h4>
                                        <canvas id="chart_clasificados_mensual"></canvas>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="title-dash col">
                                    INFORMACIÓN ANUNCIOS PROPIOS
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box-result-green">
                                            <h1>{{$anuncios_dia_propio->count()}}</h1>
                                            <small>ANUNCIOS DEL DIA</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box-result-green">
                                            <h1>{{$anuncios_mes_propio->count()}}</h1>
                                            <small>ANUNCIOS DEL MES</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box-result-green">
                                            <h1>{{$anuncios_anio_propio->count()}}</h1>
                                            <small>ANUNCIOS DEL AÑO</small>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="text-success">ESTADO DE ANUNCIOS PROPIOS</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="box-result-numbers-green">
                                            <h1>{{$anuncios_guardados_propio->count()}}</h1>
                                            <small>GUARDADOS</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box-result-numbers-green">
                                            <h1>{{$anuncios_publicados_propio->count()}}</h1>
                                            <small>PUBLICADOS</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box-result-numbers-green">
                                            <h1>{{$anuncios_finalizados_propio->count()}}</h1>
                                            <small>FINALIZADOS</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box-result-numbers-green">
                                            <h1>{{$anuncios_vencidos_propio->count()}}</h1>
                                            <small>VENCIDOS</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h4 class="text-primary"><i class="fa fa-bar-chart"></i> Propios ultimos 6 meses</h4>
                                        <canvas id="chart_propios_mensual"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                            
                    </div>
                </div>
                <!-- fin card  -->

        </div>
    </div>
</div>




<script type="text/javascript">
$(function(){
    //inicializacion de elementos
    $('#alarma-estado-conectado').hide();
    /*
    -------------------------------------------------------------
    * CONFIGURACION DATA TABLES
    -------------------------------------------------------------
    */
    $('.tabla-datos').DataTable({"language":{url: '{{secure_asset('js/datatables-lang-es.json')}}'}, "order": [[ 5, "desc" ]]});

    //Conf popover
    $('[data-toggle="popover"]').popover()


});

/*CHART CONFIGURACION EXAMPLE*/
 const labels1 = [
    @foreach ($anuncios_ultimos_6_meses as $item)
        '{{ $item["mes"] }}',
    @endforeach
   ];
 const labels2 = [
    @foreach ($propios_ultimos_6_meses as $item)
        '{{ $item["mes"] }}',
    @endforeach
   ];
   const dataClasificados = {
     labels: labels2,
     datasets: [{
       label: 'anuncios por mes',
       backgroundColor: 'rgb(5, 99, 132)',
       borderColor: 'rgb(5, 99, 132)',
       data: [
    @foreach ($anuncios_ultimos_6_meses as $item)
        {{ $item["cantidad"] }},
    @endforeach
       ],
     }]
   };
   const dataPropios = {
     labels: labels2,
     datasets: [{
       label: 'Ingresos por mes',
       backgroundColor: 'rgb(255, 99, 132)',
       borderColor: 'rgb(255, 99, 132)',
       data: [
    @foreach ($propios_ultimos_6_meses as $item)
        {{ $item["cantidad"] }},
    @endforeach
       ],
     }]
   };

   const config_clasificados = {
     type: 'bar',
     data: dataClasificados,
     options: {}
   };

   const config_propios = {
     type: 'bar',
     data: dataPropios,
     options: {}
   };


    const grafico_clasificados_mensual = new Chart(
        document.getElementById('chart_clasificados_mensual'),
        config_clasificados
      );

    const grafico_inventario_mensual = new Chart(
        document.getElementById('chart_propios_mensual'),
        config_propios
      );


</script>




@endsection
