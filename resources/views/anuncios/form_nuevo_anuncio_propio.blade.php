@extends('layouts.autenticado')
@section('titulo', $titulo)

@section('contenido')

<div class="col-md-10 content-pane">
    <div class="title-container">
        <div class="row">
            <div class="col-6">
				<h3 class="title-header" style="text-transform: uppercase;">
					<i class="fa fa-plus"></i>
					{{$titulo}}
				</h3>
			</div>
            <div class="col-6">
					<a href="{{url('anuncios_propios')}}" title="Volver a lista de anuncios propios" data-placement="bottom" class="btn btn-sm btn-secondary float-right" style="margin-left:10px;"><i class="fa fa-angle-double-left"></i> ATRÁS</a>
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
								<form id="form-nuevo-anuncio" action="{{secure_url('anuncios_propios')}}" method="POST" enctype="multipart/form-data">
								  @csrf
								  <section id="seccion-datos-anuncio">
									Los campos con <span class="text-danger">*</span> son obligatorios.
									<hr>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Concepto/Titulo Anuncio:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece el concepto del anuncio"></i>
												</label>
												<input autofocus required type="text" value="" class="form-control @error('anu_concepto') is-invalid @enderror" name="anu_concepto" id="anu_concepto" placeholder="Concepto del anuncio">
												@error('anu_concepto')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Descripcion Anuncio:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece la descripción del anuncio"></i>
												</label>
												<textarea class="form-control @error('anu_descripcion') is-invalid @enderror" name="anu_descripcion" id="anu_descripcion" placeholder="Copiar de la ficha técnica resumida">
<div><strong>SUPERFICIE: </strong>Ejemplo:200,00 m2</div>
<div><strong>ZONA:</strong>Ejemplo URB. Las Marias</div>
<div><strong>PRECIO: </strong>Ejemplo USD 145.000,00</div>
<div><strong>TIPO VENTA: </strong>Ejemplo CONTADO</div>
<div><strong>UBICACION:</strong> Ejemplo A UNA CUADRA Y MEDIA DE LA AVENIDA SANTA FE</div>
<div><strong>SERVICIOS:</strong> Ejemplo LUZ, AGUA ALCANTARILLADO, GAS DOMICILIARIO</div>													
												</textarea>
												@error('anu_descripcion')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>

										</div>
										<div class="col-md-6">
											<div id="preview-box" class="preview-box d-none">
												<img id="preview-img" src="" alt="Preview">
											</div>											
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Imagen del anuncio (max 5MB):
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer la imagen del anuncio en formato JPG"></i>
												</label>
												<input type="file"
													name="anu_imagen_url"
													id="anu_imagen_url"
													class="form-control"
													accept="image/png, image/jpeg"
													required>
											</div>

											<div class="form-group">
												<label class="label-blue label-block" for="">
													Código Propiedad:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer el codigo de anuncio. Este se genera automaticamente y de acuerdo a la categoria"></i>
												</label>
												<input required type="text" value="" class="form-control @error('anu_codigo_anuncio') is-invalid @enderror" name="anu_codigo_anuncio" id="anu_codigo_anuncio" placeholder="Código SUPERCASAS (Ej.: RS-F-123)">
												<div id="msg-codigo" class="mt-2"></div>
												@error('anu_codigo_anuncio')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Fecha Contrato:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece la fecha de publicación del anuncio. Es editable."></i>
												</label>
												<input required type="date" value="{{ date('Y-m-d') }}" class="form-control @error('anu_fecha_inicio') is-invalid @enderror" name="anu_fecha_inicio" id="anu_fecha_inicio" placeholder="Fecha de contrato">
												@error('anu_fecha_inicio')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Teléfonos de Contacto:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establece los teléfonos de contacto"></i>
												</label>
												<input required type="text" value="" class="form-control @error('anu_telefonos_contacto') is-invalid @enderror" name="anu_telefonos_contacto" id="anu_telefonos_contacto" placeholder="Teléfonos de contacto del asesor de captación.">
												@error('anu_telefonos_contacto')
												<div class="invalid-feedback">
													{{$message}}
												</div>											
												@enderror
											</div>
											<div class="form-group">
												<label class="label-blue label-block" for="">
													Estado Anuncio:
													<span class="text-danger">*</span>
													<i class="fa fa-question-circle float-right" title="Establecer el tipo de Anuncio. Clasificados: Van en sección general de la pantalla, Destacados: Van en sección destacada de la pantalla, Propios: Lo que publique la empresa, en su propia sección "></i>
												</label>
												<select required class="form-control @error('anu_estado') is-invalid @enderror" name="anu_estado" id="anu_estado">
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
									</div>

									<hr>											
									<div class="row">
										<div class="col-md-6 offset-md-3 text-center">
											<div id="msg-cargando" class="mt-2 text-info d-none">
												<span class="spinner-border spinner-border-sm"></span>
												Procesando, por favor espere...
											</div>										

											<button type="submit" id="enviar-formulario" class="btn btn-success">
													<i class="fa fa-save"></i>
													Guardar Anuncio
											</button>
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

<script src="https://cdn.tiny.cloud/1/ziiv44kk26lbm2jgy674fy87jawsf6ph9uvbo3hpb3n59h82/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

<script>

/*Editor Wysiwyg*/
tinymce.init({
  selector: '#anu_descripcion',
  height: 300,
  menubar: false,
  plugins: 'lists link image table code',
  toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link | code',
  branding: false
});

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

	//control contador letras concepto anuncio
	$('#anu_concepto').on('input', function () {
		let max = this.maxLength;
		let actual = this.value.length;

		$('#contador-concepto').text(actual);
	});

	//control contador letras descripcion anuncio
	$('#anu_descripcion').on('input', function () {
		let max = this.maxLength;
		let actual = this.value.length;

		$('#contador').text(actual);
	});

	//imagen para el server
	$('#anu_imagen_url').on('change', function () {
		const file = this.files[0];

		if (!file) return;

		if (!file.type.startsWith('image/')) {
			alert('Seleccione una imagen válida');
			this.value = '';
			return;
		}
		//revisa el tamaño del archivo
        if (!file) return;
        const maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
            alert('El archivo no debe superar los 5 MB');
            this.value = ''; // limpia el input
        }


		const reader = new FileReader();

		reader.onload = function (e) {
			$('#preview-img').attr('src', e.target.result);
			$('#preview-box').removeClass('d-none');
		};

		reader.readAsDataURL(file);
	});


	//preloader cargado imagen
	$('#form-nuevo-anuncio').on('submit', function () {

		// Deshabilitar botón
		$('#enviar-formulario')
			.prop('disabled', true)
			.text('Procesando...');

		// Mostrar mensaje
		$('#msg-cargando').removeClass('d-none');

		// Permitir que el submit continúe
		return true;
	});	


    $('#anu_codigo_anuncio').on('focusout', function () {

        let codigo = $(this).val().trim();

        if (codigo === '') {
            $('#msg-codigo').html('');
            return;
        }

        $.ajax({
            url: '/api/anuncios/existe_codigo',
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                anu_codigo: codigo
            },
            beforeSend: function () {
                $('#msg-codigo').html('<small class="text-info">Verificando código...</small>');
            },
            success: function (response) {
                if (response.status == 1) {
                    $('#msg-codigo').html('<small class="text-danger">⚠️ El código ya existe</small>');
                    setTimeout(function () {
                        $('#anu_codigo_anuncio').val('');
                    }, 2000); 					
                } else {
                    $('#msg-codigo').html('<small class="text-success">✔ Código disponible</small>');
                }
            },
            error: function () {
                $('#msg-codigo').html('<small class="text-danger">Error al verificar</small>');
            }
        });

    });




});	



	</script>


    @endsection