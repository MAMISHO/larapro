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
									<i class="fa fa-list fa-2x"> &nbsp;Examen: {{ $examenes[1]['examen_nombre'] }}</i> 			
								</div>
								
							</div>
							<div class="examen_header_colum">
								<div class="examen_cell_fecha">
									<h3>Fecha : {{ $fecha->format('d-m-Y') }} </h3>
								</div>	
							</div>
						</div>
					</div>
					
				</div>

				<div class="panel-body">
					<div class="examen_contain">
						<div class="usuario_contain">
							<div class="usuario_row">
								<div class="usuario_datos">
									<div class="usuario_foto">
										<i class="fa fa-user fa-5x"></i>
									</div>
									<div class="usuario_informacion">
										<table>
											<tr>
												<td class="etiqueta"><h4>Alumno:</h4> </td>	
												<td>{{ $examenes[1]['usuario_nombre'] }} {{ $examenes[1]['usuario_apellidos'] }}</td>
											</tr>
											<tr>
												<td class="etiqueta"><h4>DNI:</h4> </td>
												<td>{{ $examenes[1]['usuario_dni'] }}</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="examen_preguntas">

						<form action="{{ url('/home/examen/calificar') }}" method="POST">
							@foreach($preguntas as $key => $pregunta)
							<div class="pregunta_contain">
								<div class="pregunta_header">
									<div class="pregunta_numero">
										<i class="fa fa-question-circle fa-2x">Pregunta {{$key+1}}</i>
									</div>
								</div>
								<div class="pregunta_texto">
									<p>{{$pregunta['pregunta']}}</p>
								<div class="pregunta_respuesta">
									<p>
										<label>
										   <input type="radio" name="respuesta_{{ $pregunta['pregunta_id'] }}" value="resp_a"/>
										   <span class="lbl padding-8">A) {{$pregunta['resp_a']}}</span>
										</label>
									</p>
									<p>
										<label>
									   		<input type="radio" name="respuesta_{{ $pregunta['pregunta_id'] }}" value="resp_b"/>
									   		<span class="lbl padding-8">B) {{$pregunta['resp_b']}}</span>
										</label>
									</p>
									<p>
										<label>
									   		<input type="radio" name="respuesta_{{ $pregunta['pregunta_id'] }}" value="resp_c"/>
									   		<span class="lbl padding-8">C) {{$pregunta['resp_c']}}</span>
										</label>
									</p>
									<p>
										<label>
									   		<input type="radio" name="respuesta_{{ $pregunta['pregunta_id'] }}" value="resp_d"/>
									   		<span class="lbl padding-8">D) {{$pregunta['resp_d']}}</span>
										</label>
									</p>
									<!-- Checkbox -->
									<!-- <label>
									   <input type="checkbox" />
									   <span class="lbl padding-8">Label Here</span>
									</label>
									<label>
									   <input type="checkbox" />
									   <span class="lbl padding-16">Label Here</span>
									</label> -->
									 
									<!-- Radio Button -->
									<!-- <label>
									   <input type="radio" />
									   <span class="lbl padding-8">Label Here</span>
									</label> -->
								</div>
								</div>
							</div>
							@endforeach
							<input style="color: white;" type="submit" class="onyx-button onyx-blue" value="Finalizar examen"></input>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection