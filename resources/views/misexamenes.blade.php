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
									<i class="fa fa-pie-chart fa-2x"> &nbsp; Exámenes realizados</i> 			
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
											<i class="fa fa-user fa-5x"></i>
										</div>
									</div>
									<div class="usuario_informacion">
										<!-- <h4 style="display: table-row;">00 / 00 / 0000</h4> -->
										
										<table style="display: table-row-group;">
											<tr >
												<td class="etiqueta"><h4>Alumno:</h4> </td>	
												<td>{{ $estudiante['nombre'] }} {{ $estudiante['apellidos'] }}</td>
											</tr>
											<tr>
												<td class="etiqueta"><h4>DNI:</h4> </td>
												<td>{{ $estudiante['dni'] }}</td>
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
										<i class="fa fa-bar-chart fa-2x">&nbsp; Resultados</i>
									</div>
								</div>
								<div class="pregunta_texto">
								@if($examenes)
									<div class="resultados">
										<table  style="font-size: 1.2em; margin-left: auto; margin-right: auto; width:100%; ">
											<tr style="text-align: center;">
												<th style="text-align: center;">Examen</th>
												<th></th>
												<th style="text-align: center;"><i class="fa fa-calendar"></i></th>
												<th style="text-align: center;"><i class="fa fa-clock-o"></i></th>
												<th style="text-align: center;"><i class="fa fa-check-circle"></i></th>
												<th style="text-align: center;"><i class="fa fa-times-circle"></i></th>
												<th style="text-align: center;"><i class="fa fa-exclamation-triangle"></i></th>
												<th style="text-align: center;">Nota</th>
												<th style="text-align: center;"><i class="fa fa-line-chart"></i></th>
												<th style="text-align: center;"><i class="fa fa-file-pdf-o"></i></th>
												<!-- <th style="text-align: center;"><i class="fa fa-file-pdf-o"></i></th>
												<th style="text-align: center;"><i class="fa fa-file-pdf-o"></i></th> -->
											</tr>
											@foreach($examenes as $key => $examen)
											<tr>
												<td style="border-right: none;"><span>{{ $key+1 }}</span>)&nbsp; {{ $examen['examen_codigo'] }}</td>
												<td>{{ $examen['examen_nombre'] }}</td>
												<td>{{ date('d-m-Y', strtotime($examen['examen_fecha'])) }}</td>
												<td>{{ date('H:i:s', strtotime($examen['examen_fecha'])) }}</td>
												<td>{{ $examen['examen_correctas'] }}</td>
												<td>{{ $examen['examen_incorrectas'] }}</td>
												<td>{{ $examen['examen_sin_responder'] }}</td>
												<td>{{ $examen['examen_nota'] }}</td>
												@if($examen['examen_nota'] >= 5)
												<td><i class="fa fa-check-circle verde"></i></td>
												@else
												<td><i class="fa fa-times-circle rojo"></i></td>
												@endif
												<td>
													<a href="https://examenemq.upo.es/certificado/documento.php?id_firma={{ $examen['examen_id_firma'] }}&token={{ csrf_token() }}"><i class="fa fa-lock"></i></a>
												<!-- </td>
												<td> -->&nbsp;
													<a href="http://services.viafirma.com/viafirma/v/{{ $examen['examen_id_firma'] }}?j=true"><i class="fa fa-barcode"></i></a>
												<!-- </td>
												<td> -->&nbsp;
													<a href="http://services.viafirma.com/viafirma/v/{{ $examen['examen_id_firma'] }}?o=true"><i class="fa fa-cloud-download"></i></a>
												</td>
												
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
										
										<tr>
											<td><i class="fa fa-lock"></i></td>
											<td>&nbsp;Documento firmado y custodiado</td>
										</tr>
										<tr>
											<td><i class="fa fa-barcode"></i></td>
											<td>&nbsp;Comprobante de firma</td>
										</tr>
										<tr>
											<td><i class="fa fa-cloud-download"></i></td>
											<td>&nbsp;Documento Original</td>
										</tr>
									</table>
								</div>
								@else
									<p>El alumno no ha realizado ningún examen</p>
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