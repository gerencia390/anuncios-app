@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <div class="title-container">
        <div class="row">
            <div class="col-6">
				<h3 class="title-header" style="text-transform: uppercase;">
					<i class="fa fa-edit"></i>
					{{$titulo}}
				</h3>
			</div>
            <div class="col-6">
					<a href="{{url('anuncios')}}" title="Volver a lista de anuncios" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
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
								<form id="form-nuevo-producto" action="{{secure_url('anuncios/'.Crypt::encryptString($anuncio->anu_id))}}" method="POST">
								  @method("PUT")
								  @csrf
								  <section id="seccion-datos-anuncio">
									Los campos con <span class="text-danger">*</span> son obligatorios.
									<hr>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Código Anuncio:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer el codigo de anuncio. Este se genera automaticamente y de acuerdo a la categoria"></i>
												</label>
												<input required type="text" value="{{old('anu_codigo_anuncio', $anuncio->anu_codigo_anuncio)}}" class="form-control @error('anu_codigo_anuncio') is-invalid @enderror" name="anu_codigo_anuncio" id="anu_codigo_anuncio" placeholder="Código del anuncio" readonly>
												@error('anu_codigo_anuncio')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Tipo Anuncio:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer el tipo de Anuncio. Clasificados: Van en sección general de la pantalla, Destacados: Van en sección destacada de la pantalla, Propios: Lo que publique la empresa, en su propia sección "></i>
												</label>
												<select autofocus required class="form-control @error('tip_id') is-invalid @enderror" name="tip_id" id="tip_id">
													<option value="">Seleccione una opción</option>
													<option data-precio="{{$ajustes->where('key', 'precio_clasificados')->first()->value}}" value="1" {{ old('tip_id', $anuncio->tip_id) == 1 ? 'selected' : '' }}>Clasificados</option>
													<option data-precio="{{$ajustes->where('key', 'precio_destacados')->first()->value}}" value="2" {{ old('tip_id', $anuncio->tip_id) == 2 ? 'selected' : '' }}>Destacados</option>
												</select>
												@error('tip_id')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Categoria Anuncio:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece la categoria a la que pertenece el anuncio"></i>
												</label>
												<select required class="form-control @error('cat_id') is-invalid @enderror" name="cat_id" id="cat_id">
													<option value="">Seleccione una opción</option>
													@foreach($categorias as $categoria)
													<option data-catletra="{{ $categoria->cat_letra_codigo }}" style="text-transform: capitalize" value="{{ $categoria->cat_id }}" {{ old('cat_id', $categoria->cat_id) == $anuncio->cat_id ? 'selected' : '' }}>{{ $categoria->cat_nombre }}</option>
													@endforeach
												</select>
												@error('cat_id')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Fecha Publicación:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece la fecha de publicación del anuncio. Es editable."></i>
												</label>
												<input required type="date" value="{{old('anu_fecha_inicio', $anuncio->anu_fecha_inicio)}}" class="form-control @error('anu_fecha_inicio') is-invalid @enderror" name="anu_fecha_inicio" id="anu_fecha_inicio" placeholder="Fecha de publicación">
												@error('anu_fecha_inicio')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										
									</div>

									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Nombre Cliente:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece el nombre del cliente"></i>
												</label>
												<input required type="text" value="{{old('anu_cliente', $anuncio->anu_cliente)}}" class="form-control @error('anu_cliente') is-invalid @enderror" name="anu_cliente" id="anu_cliente" placeholder="Nombre del cliente">
												@error('anu_cliente')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													NIT/CI Cliente:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer el NIT o CI del cliente"></i>
												</label>
												<input required type="text" value="{{old('anu_nit_ci', $anuncio->anu_nit_ci)}}" class="form-control @error('anu_nit_ci') is-invalid @enderror" name="anu_nit_ci" id="anu_nit_ci" placeholder="NIT/CI del cliente">
												@error('anu_nit_ci')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Concepto Titulo Anuncio:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece el concepto del anuncio"></i>
												</label>
												<input required type="text" value="{{old('anu_concepto', $anuncio->anu_concepto)}}" class="form-control @error('anu_concepto') is-invalid @enderror" name="anu_concepto" id="anu_concepto" placeholder="Concepto del anuncio">
												@error('anu_concepto')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Descripcion Anuncio:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece la descripción del anuncio"></i>
												</label>
												<textarea required type="text" value="" class="form-control @error('anu_descripcion') is-invalid @enderror" name="anu_descripcion" id="anu_descripcion" placeholder="Descripción del anuncio">{{old('anu_descripcion', $anuncio->anu_descripcion)}}													
												</textarea>
												@error('anu_descripcion')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Ubicación:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer la ubicación donde referencia el anuncio"></i>
												</label>
												<input required type="text" value="{{old('anu_ubicacion', $anuncio->anu_ubicacion)}}" class="form-control @error('anu_ubicacion') is-invalid @enderror" name="anu_ubicacion" id="anu_ubicacion" placeholder="Ubicación del anuncio">
												@error('anu_ubicacion')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Precio/Sueldo:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece el precio o sueldo del anuncio"></i>
												</label>
												<input required type="text" value="{{old('anu_precio', $anuncio->anu_precio_sueldo)}}" class="form-control @error('anu_precio') is-invalid @enderror" name="anu_precio" id="anu_precio" placeholder="Precio/Sueldo">
												@error('anu_precio')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Teléfonos de Contacto:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece los teléfonos de contacto del cliente"></i>
												</label>
												<input required type="text" value="{{old('anu_telefonos_contacto', $anuncio->anu_telefonos_contacto)}}" class="form-control @error('anu_telefonos_contacto') is-invalid @enderror" name="anu_telefonos_contacto" id="anu_telefonos_contacto" placeholder="Teléfonos de contacto">
												@error('anu_telefonos_contacto')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>

									</div>

									<div class="row" style="background-color: #ddd">
										<div class="col-md-3 offset-2">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Estado Anuncio:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer el tipo de Anuncio. Clasificados: Van en sección general de la pantalla, Destacados: Van en sección destacada de la pantalla, Propios: Lo que publique la empresa, en su propia sección "></i>
												</label>
												<select autofocus required class="form-control @error('anu_estado') is-invalid @enderror" name="anu_estado" id="anu_estado">
													<option value="">Seleccione una opción</option>
													<option value="0" {{ old('anu_estado') == '0' ? 'selected' : '' }}>Guardado</option>
													<option value="1" {{ old('anu_estado') == '1' ? 'selected' : '' }} selected>Publicado</option>
													<option value="2" {{ old('anu_estado') == '2' ? 'selected' : '' }}>Finalizado</option>
												</select>
												@error('anu_estado')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Monto total	a pagar (en Bs):
													<i class="fa fa-question-circle float-right" title="Establece el monto total a pagar por el anuncio. Este campo se llena automáticamente al seleccionar el tipo de anuncio"></i>
												</label>
												<input required type="text" value="{{old('anu_monto_pago', $anuncio->anu_monto_pago)}}" class="form-control @error('anu_monto_pago') is-invalid @enderror" readonly name="anu_monto_pago" id="anu_monto_pago" placeholder="Monto total a pagar">
												@error('anu_monto_pago')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Nro. Factura:
													<i class="fa fa-question-circle float-right" title="Establece el número de factura. Este campo no es obligatorio"></i>
												</label>
												<input type="text" value="{{old('anu_nro_factura', $anuncio->anu_nro_factura)}}" class="form-control @error('anu_nro_factura') is-invalid @enderror" name="anu_nro_factura" id="anu_nro_factura" placeholder="Nro. Factura">
												@error('anu_nro_factura')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
										</div>
									</div>

									<hr>											
									<div class="row">
										<div class="col-md-6 offset-md-3 text-center">
											<button type="submit" class="btn btn-success">
													<i class="fa fa-save"></i>
													Guardar Anuncio
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



<script>
$(function(){

	$(document).on('change', '#tip_id', function () {
		//obtener el precio del tipo de anuncio seleccionado
		let precio = $(this).find('option:selected').data('precio');
		$('#anu_monto_pago').val(precio);	
	});

	$('#cat_id').on('change', function () {

		let letra = $(this).find(':selected').data('catletra');

		if (!letra) return;

		let input = $('#anu_codigo_anuncio');
		let codigo = input.val(); // ej: AL-12-2025 o -12-2025

		let partes = codigo.split('-');

		/*
		Casos:
		["", "12", "2025"]        -> sin prefijo
		["AL", "12", "2025"]      -> con prefijo
		*/

		partes[0] = letra;

		let nuevoCodigo = partes.join('-');

		input.val(nuevoCodigo);
	});



});	


	</script>


    @endsection