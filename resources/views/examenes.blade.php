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
									<i class="fa fa-pie-chart fa-2x"> &nbsp; Resultados de {{ $examenes[1]['examen_nombre'] }}</i> 			
								</div>
								
							</div>
							<div class="examen_header_colum">
								<div class="examen_cell_fecha">
									<h3>Fecha : {{ $puntaje['fecha']->format('d-m-Y') }}</h3>
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
											<i class="fa fa-user fa-5x"></i>
										</div>
									</div>
									<div class="usuario_informacion">
										<!-- <h4 style="display: table-row;">00 / 00 / 0000</h4> -->
										<div class="usurio_header_row">
											<div class="usuario_header_cell">
												<h4 style="color: #333;">{{ $puntaje['fecha']->format('d-m-Y') }}</h4>
											</div>
											<div class="usuario_header_cell">
												<div class="usurios_puntos">
													<h2>{{ $puntaje['puntos'] }}</h2>	
												</div>
												<h5>Puntos</h5>
											</div>
										</div>
										<table style="display: table-row-group;">
											<tr >
												<td class="etiqueta"><h4>Alumno:</h4> </td>	
												<td>{{ $examenes[1]['usuario_nombre'] }} {{ $examenes[1]['usuario_apellidos'] }}</td>
											</tr>
											<tr>
												<td class="etiqueta"><h4>DNI:</h4> </td>
												<td>{{ $examenes[1]['usuario_dni'] }}</td>
											</tr>
											<tr>
												<td class="etiqueta"><h4>Examen:</h4></td>
												<td>{{ $examenes[1]['examen_nombre'] }}</td>
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
										<i class="fa fa-bar-chart fa-2x">&nbsp; Calificación</i>
									</div>
								</div>
								<div class="pregunta_texto">
									<div class="resultados">
										<table>
											<tr>
												<th><h3>Pregunta</h4></th>
												<th>RU</th>
												<th>RC</th>
												<th>PT</th>
												<th><i class="fa fa-line-chart"></i></th>
											</tr>
											@foreach($resultados as $key => $resultado)
											<tr>
												<td><p class="resultados_pregunta"><span>{{ $key+1 }}</span>)&nbsp; {{ $resultado['pregunta'] }}</p></td>
												<td>
													@if( $resultado['respuesta'] == "--")
														<i class="fa fa-exclamation-triangle amarillo"></i>
													@endif
													@if( $resultado['respuesta'] == "resp_a")
														A
													@endif
													@if( $resultado['respuesta'] == "resp_b")
														B
													@endif
													@if( $resultado['respuesta'] == "resp_c")
														C
													@endif
													@if( $resultado['respuesta'] == "resp_d")
														D
													@endif
												</td>
												<td>
													@if( $resultado['correcta'] == "resp_a")
														A
													@endif
													@if( $resultado['correcta'] == "resp_b")
														B
													@endif
													@if( $resultado['correcta'] == "resp_c")
														C
													@endif
													@if( $resultado['correcta'] == "resp_d")
														D
													@endif
												</td>
												<td>{{ $resultado['puntos'] }}</td>
												<td><i class="{{ $resultado['icon'] }}"></i></td>
											</tr>
											@endforeach
										</table>
									</div>
									<table style="margin:20px;">
										<tr>
											<th>Leyenda</th>
										</tr>
										<tr>
											<td>RU</td>
											<td>Respuesta del usuario</td>
										</tr>
										<tr>
											<td>RC</td>
											<td>Respuesta Correcta</td>
										</tr>
										<tr>
											<td>PT</td>
											<td>Puntos</td>
										</tr>
									</table>
								</div>
								<br />
								<a style="color: white;" type="button" class="onyx-button onyx-blue" href="{{ url('/home') }}" value="Terminar">Finalizar</a>
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