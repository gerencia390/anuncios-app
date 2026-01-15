<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMAT - Alerta Temprana</title>
	<style>
		.titulo-azul{
			background-color: #003366;			
			color:#fff;
			text-align: center;
		}
		table{
			width:100%;
			border:1px solid #003366;
		}
		.caja_naranja{
			background-color: #f70;
			color:#fff;
			height:200px;
			text-align: center;
			font-size: 3rem;
		}
		.caja_roja{
			background-color: #a00;
			color:#fff;
			height:200px;
			text-align: center;
			font-size: 3rem;
		}
		.aclarativo{
			font-size: 1rem;
		}
	</style>
</head>
<body>
											<table>
												<tr>
													<td colspan="3" class="titulo-azul" style="text-align: center; text-transform:uppercase;">
														<h3>SISTEMA DE MONITOREO Y ALERTA TEMPRANA - MUNICIPIO DE PALCA</h3>
														El sistema de alerta temprana indica:
													</td>
												</tr>
												<tr>
													@if($grado == 1)
													<td colspan="3" class="caja_naranja">
														ALERTA NARANJA
														<p class="aclarativo">
															Esta lloviendo y los niveles de agua estan aumentando. Camine con precaución
														</p>
													</td>
													@endif
													@if($grado == 2)
													<td colspan="3" class="caja_roja">
														ALERTA ROJA
														<p class="aclarativo">
															Los niveles de agua están aumentando peligrosamente. Hay riesgo de inundación.
														</p>
													</td>
													@endif
												</tr>
											</table>											
</body>
</html>