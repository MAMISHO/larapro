@extends('app')

@section('content')
<div class="header">
	<script type="text/javascript">

		// var t=setTimeout(finExamen,360*1000); // finExamen se ejecutara cuando se acabe 
		// //el tiempo y 3600*1000 es para una hora 
		// function finExamen(){ 
		// 	document.formulario.submit();
		// }
		horas = 00;
		minutos = 0;
		segundos = 10;

		function muestraReloj() {
		    if (segundos === 0){
		    	if(minutos>0){
		    		segundos=59; 
		    		minutos--;	
		    	}else{
		    		alert("Tiempo finalizado, el examen será enviado");
		    		document.formulario.submit();
		    	}
		    }
		    // if (minutos === 0){
		    // 	minutos=59; horas--;
		    // }
		    
		    var string = "";
		    string += horas +':'+ minutos + ':'+ segundos;
		    document.getElementById("reloj").innerHTML = string;
		    
		    segundos --;
		}
		 
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
								<div class="examen_cell_fecha">
									<h4>Tiempo para finalizar <span id="reloj" style="color:#337ab7"></span></h4>
									<!-- <div id="reloj"></div> -->
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

						<form action="{{ url('/home/examen/calificar') }}" method="POST" name="formulario">
							@foreach($preguntas as $key => $pregunta)
								@if(!$pregunta == null)
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

											</div>
										</div>
									</div>
								@else
									<div class="pregunta_contain">
										<div class="pregunta_header">
											<div class="pregunta_numero">
												<i class="fa fa-question-circle fa-2x">No hay preguntas</i>
											</div>
										</div>
										<div class="pregunta_texto">
										<p>EL examen no tiene preguntas asignadas</p>
										</div>
									</div>
								@endif
							@endforeach
							<br />
							@if($preguntas[0]==null)
								<a style="color: white;" type="button" class="onyx-button onyx-blue" href="{{ url('/home') }}" value="Regresar">Regresar</a>
							@else
							<script type="text/javascript">
								window.onload = function() {
								  setInterval(muestraReloj, 1000);
								}
							</script>
								<input style="color: white;" type="submit" class="onyx-button onyx-blue" value="Finalizar examen"></input>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							@endif
							
						</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection