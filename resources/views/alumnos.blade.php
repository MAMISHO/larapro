@extends('app')

@section('content')
<div class="header">
	<script type="text/javascript">

	</script>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="examen_header_content">
					<div class="examen_header">
						<div class="examen_header_row">
							<div class="examen_header_colum">
								<div class="examen_cell_nombre">
									<i class="fa fa-pie-chart fa-2x"> &nbsp; Alumnos que han realizado el examen</i> 			
								</div>
								
							</div>
							<div class="examen_header_colum">
								<div class="examen_cell_fecha">
									<h3></h3>
								</div>	
							</div>
						</div>
					</div>
					
				</div>
				<!-- Panel body inicio-->
				<div class="panel-body">
					<div class="examen_contain">
						<!-- usuario container inicio -->
						<div class="usuario_contain">
							<div class="usuario_row">
								<div class="usuario_datos" style="color: #337ab7">
									<div class="usuario_foto">
										<div class="usurio_header_row">
										 &nbsp;
											<!-- <h4 style="display: table-row;">00 / 00 / 0000</h4> -->
										</div>
										<div class="usurio_header_row">
											<i class="fa fa-file-text fa-5x"></i>
										</div>
									</div>
									<div class="usuario_informacion">
										<!-- <h4 style="display: table-row;">00 / 00 / 0000</h4> -->
										
										<table style="display: table-row-group;">
											<tr >
												<td class="etiqueta"><h4>Código:</h4> </td>	
												<td>{{ $examen[0]['codigo'] }}</td>
											</tr>
											<tr>
												<td class="etiqueta"><h4>Nombre:</h4> </td>
												<td>{{ $examen[0]['nombre'] }}</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- usuario container fin -->
						<div class="examen_preguntas">
							<div class="pregunta_contain">
								<div class="pregunta_header">
									<div class="pregunta_numero">
										<i class="fa fa-users fa-2x">&nbsp; Alumnos</i>
									</div>
								</div>
								<div class="pregunta_texto">
								@if($alumnos)
									<div class="resultados">
										<table  style="font-size: 1.2em; margin-left: auto; margin-right: auto; width:100%; ">
											<tr style="text-align: center;">
												<th style="text-align: center;"><i class="fa fa-calendar"></i></th>
												<th style="text-align: center;"><i class="fa fa-credit-card">&nbsp; D.N.I.</i></th>
												<th style="text-align: center;"><i class="fa fa-user">&nbsp; Nombre</i></th>
												<th style="text-align: left;"></i></th>
												<th style="text-align: center;"><i class="fa fa-check-circle"></i></th>
												<th style="text-align: center;"><i class="fa fa-times-circle"></i></th>
												<th style="text-align: center;"><i class="fa fa-exclamation-triangle"></i></th>
												<th style="text-align: center;">Nota</th>
												<th style="text-align: center;"><i class="fa fa-line-chart"></i></th>
											</tr>
											@foreach($alumnos as $key => $alumno)
											<tr>
												<td><span>{{ $key+1 }}</span>)&nbsp; {{ date('d-m-Y', strtotime($alumno['examen_fecha'])) }}</td>
												<td>{{ $alumno['usuario_dni'] }}</td>
												<td style="border-right: none;">{{ $alumno['usuario_nombre'] }}</td>
												<td>{{ $alumno['usuario_apellidos'] }}</td>
												<td>{{ $alumno['examen_correctas'] }}</td>
												<td>{{ $alumno['examen_incorrectas'] }}</td>
												<td>{{ $alumno['examen_sin_responder'] }}</td>
												<td>{{ $alumno['examen_nota'] }}</td>
												@if($alumno['examen_nota'] >= 5)
												<td><i class="fa fa-check-circle verde"></i></td>
												@else
												<td><i class="fa fa-times-circle rojo"></i></td>
												@endif
												
											</tr>
											@endforeach
										</table>
									</div>
									<table style="margin-top:50px;margin-left: auto; margin-right: auto;">
										<tr>
											<th></th>
											<th>Leyenda</th>
										</tr>
										<tr>
											<td><i class="fa fa-calendar"></i></td>
											<td>&nbsp;Fecha en la que realizó el examen</td>
										</tr>
										<tr>
											<td><i class="fa fa-check-circle"></i></td>
											<td>&nbsp;Respuestas Correctas</td>
										</tr>
										<tr>
											<td><i class="fa fa-times-circle"></i></td>
											<td>&nbsp;Respuestas Incorrectas</td>
										</tr>
										<tr>
											<td><i class="fa fa-exclamation-triangle"></i></td>
											<td>&nbsp;Preguntas sin responder</td>
										</tr>
										<tr>
											<td><i class="fa fa-check-circle verde"></i></td>
											<td>&nbsp;Aprobado</td>
										</tr>
										<tr>
											<td><i class="fa fa-times-circle rojo"></i></td>
											<td>&nbsp;Suspenso</td>
										</tr>
									</table>
								</div>
								@else
									<p>Nadie ha realizado el examen</p>
								@endif
								<br />
								<a style="color: white;" type="button" class="onyx-button onyx-blue" href="{{ url('/home') }}" value="Terminar">Regresar</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Panel body fin -->
			</div>
		</div>
	</div>
</div>
@endsection