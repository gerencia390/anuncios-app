@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <div class="title-container">
        <div class="row">
            <div class="col-6">
				<h3 class="title-header" style="text-transform: uppercase;">
					<i class="fa fa-cogs"></i>
					{{$titulo}}
				</h3>
			</div>
            <div class="col-6">
					<a href="{{url('dashboard')}}" title="Ir a panel general" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> IR A PANEL GENERAL</a>
					<a href="#" id="btn-editar-configuracion" title="Habilitar modificación de valores de configuración" data-placement="bottom" class="btn btn-sm btn-primary float-right" style="margin-left:10px;"><i class="fa fa-edit"></i> EDITAR VALORES</a>
			</div>
		</div>
	</div>		

		<div class="row">
			<div class="col-md-12">
				<!-- inicio card  -->
				<div class="card">
					<div class="row no-gutters">
						<div class="col-md-12">
							<div class="card-body">
								<form id="form-editar-configuracion" action="{{secure_url('configuracion/'.Crypt::encryptString(Str::random(10)))}}" method="POST">
									@method('PUT')
									@csrf
								  <section id="seccion-datos-cuenta-usuario">
									<div class="row">
										<div class="col-md-10 offset-md-1">
											<h4 class="card-title"><strong><span class="text-primary">
												<i class="fa fa-dollar"></i>
												Configuración de precios de anuncios
											</span></strong>
											</h4>
											<small class="text-muted">
												Estos valores le permiten establecer los precios que se cobrarán a los usuarios por publicar anuncios clasificados y destacados en el sistema.
											</small>											
											<hr>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Precios Anuncio Clasificado (en Bs):
																<span class="text-danger">*</span>
															</label>
														<input required type="number" min="0" readonly value="{{old('conf_precio_clasificado', $conf_precio_clasificado)}}" class="form-control @error('conf_precio_clasificado') is-invalid @enderror" name="conf_precio_clasificado" id="conf_precio_clasificado" placeholder="Precio anuncio clasificado">
														@error('conf_precio_clasificado')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
																Precio Anuncio Destacado (en Bs):
																<span class="text-danger">*</span>
															</label>
														<input required type="number" min="0" readonly value="{{old('conf_precio_destacado', $conf_precio_destacado)}}" placeholder="Precio anuncio destacado" class="form-control txt_pwd @error('conf_precio_destacado') is-invalid @enderror" name="conf_precio_destacado" id="conf_precio_destacado">
														@error('conf_precio_destacado')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
									<h4 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-at"></i>
										Configuración de cantidades de letras
									</span></strong></h4>
											<small class="text-muted">
												Estos valores le permiten establecer el máximo de letras permitidas para los títulos y descripciones de los anuncios publicados en el sistema.
											</small>											
									<hr>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Maximo de letras para el TITULO del anuncio:
															<span class="text-danger">*</span>
															</label>
														<input required type="number" min="10" readonly value="{{old('conf_max_letras_titulo', $conf_max_letras_titulo)}}" class="form-control @error('conf_max_letras_titulo') is-invalid @enderror" name="conf_max_letras_titulo" id="conf_max_letras_titulo" placeholder="Maximo de letras para el titulo del anuncio">
														@error('conf_max_letras_titulo')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Maximo de letras para la DESCRIPCION del anuncio:
															<span class="text-danger">*</span>
															</label>
														<input required type="number" min="10" readonly value="{{old('conf_max_letras_descripcion', $conf_max_letras_descripcion)}}" class="form-control @error('conf_max_letras_descripcion') is-invalid @enderror" name="conf_max_letras_descripcion" id="conf_max_letras_descripcion" placeholder="Maximo de letras para la descripcion del anuncio">
														@error('conf_max_letras_descripcion')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>
									<h5 class="card-title"><strong><span class="text-primary">
										<i class="fa fa-calendar"></i>
										Configuracion de Plazos
									</span></strong></h5>
											<small class="text-muted">
												Estos valores le permiten establecer los plazos en meses para los contratos de anuncios propios y para la publicación de anuncios clasificados y destacados.
											</small>											

									<hr>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Plazo de contratos para anuncios propios (en meses):
															<span class="text-danger">*</span>
															</label>
														<input required type="number" min="1" readonly value="{{old('conf_plazo_contratos_propios', $conf_plazo_contratos_propios)}}" class="form-control @error('conf_plazo_contratos_propios') is-invalid @enderror" name="conf_plazo_contratos_propios" id="conf_plazo_contratos_propios" placeholder="Plazo de contratos (en meses) para anuncios propios">
														@error('conf_plazo_contratos_propios')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
															<label class="label-blue label-block" for="">
															Plazo de publicación anuncios clasificados y destacados (en meses):
															<span class="text-danger">*</span>
															</label>
														<input required type="number" min="1" readonly value="{{old('conf_plazo_publicacion_clasificados', $conf_plazo_publicacion_clasificados)}}" class="form-control @error('conf_plazo_publicacion_clasificados') is-invalid @enderror" name="conf_plazo_publicacion_clasificados" id="conf_plazo_publicacion_clasificados" placeholder="Plazo de publicación anuncios clasificados y destacados (en meses)">
														@error('conf_plazo_publicacion_clasificados')
														<div class="invalid-feedback">
															{{$message}}
														</div>											
														@enderror
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<button type="submit" class="btn btn-primary" id="btn-guardar-cambios-configuracion">
															<i class="fa fa-save"></i>
															Guardar cambios
													</button>
												</div>
											</div>

										</div>
									</div>

								  </section>


								  
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- fin card  -->

			</div>
		</div>
	</div>

{{-- INICIO MODAL: EDITAR CONFIGURACION --}}
<div class="modal fade" id="modal-editar-configuracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-edit"></i>
              Editar configuración
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
                        <h5 class="mt-0">Atención.-</h5>
                        <p>
                            <b style="font-weight: bold">
								¿Está seguro que desea editar la configuración?
							</b>
							<br>
							Esta operación puede afectar el funcionamiento del software si no se realiza correctamente.
							<br>
							<small>
                            <b style="font-weight: bold">
								IMPORTANTE:								
								Tendrás 1 minuto para modificar los campos de configuración.
							</b></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
          <button type="button" id="btn-confirmar-editar" class="btn btn-success"><i class="fa fa-edit"></i> Si, necesito editar configuración</button>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: EDITAR CONFIGURACION --}}


<script>
$(function(){
	$('#btn-guardar-cambios-configuracion').hide();
	$('#btn-editar-configuracion').click(function(e){
		$('#modal-editar-configuracion').modal('show');		
	});

	$('#btn-confirmar-editar').click(function(e){
		$('#modal-editar-configuracion').modal('hide');		
		$('#form-editar-configuracion input').removeAttr('readonly');
		$('#btn-guardar-cambios-configuracion').show();
		setTimeout(function () {
			$('#form-editar-configuracion input').attr('readonly', true);
			$('#btn-guardar-cambios-configuracion').hide();
		}, 60000);

	});
});	


	</script>


    @endsection