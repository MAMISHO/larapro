@extends('app')

@section('content')
<!-- <script src="../resources/assets/ae/enyo/enyo.js" charset="utf-8"></script>
	<script src="../resources/assets/ae/source/package.js" charset="utf-8"></script>
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->
	
<div class="header">
	<script type="text/javascript">

	</script>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-th-large fa-2x"> &nbsp;Seleccione un elemento</i> 
				</div>

				<div class="panel-body">
					@if (Session::get('miSession'))
						
						<div class="flexcontainer" style="vertical-align: bottom;">
							<div class="home_admin">
								<div class="examen_titulo">
									<h2>Usuarios</h2>
								</div>
								<!-- <div class="examen_icon"> -->
									<div class="examen_imagen_custom">
										<span class="fa-stack fa-lg fa-3x" style="padding: 0;">
										  <i class="fa fa-square-o fa-stack-2x"></i>
										  <i class="fa fa-users fa-stack-1x"></i>
										</span>
									</div>
								<!-- </div> -->
								<div class="examen_descripcion">
									<p>Examen de la asignatura de comentario</p>
								</div>
								<div class="examen_puntos examen_icon">
									<table style="min-height: 300px;">
									<!-- <tr>
										<td>0</td>
										<td>Edwin Mauricio</td>
										<td>Quishpe Maldonado</td>
									</tr> -->
									@foreach($alumnos as $key => $alumno)
										<tr>
											<td><a href="{{ url('/alumno') }}?user={{ $alumno['id'] }}">{{ $key +1 }}</a></td>
											<td><a href="{{ url('/alumno') }}?user={{ $alumno['id'] }}" class="custom">{{ $alumno['nombre'] }}</a></td>
											<td><a href="{{ url('/alumno') }}?user={{ $alumno['id'] }}" class="custom">{{ $alumno['apellidos'] }}</a></td>
										</tr>
									@endforeach
									</table>
								</div>
								<div class="examen_boton_custom">
									<hr style="padding:0; margin: 0;"/>
								</div>
							</div>

							<div class="home_admin">
								<div class="examen_titulo">
									<h2>Exámenes</h2>
								</div>
								<!-- <div class="examen_icon"> -->
									<div class="examen_imagen_custom">
										<span class="fa-stack fa-lg fa-3x" style="padding: 0;">
									  		<i class="fa fa-list-alt fa-stack-2x"></i>
										</span>
									
									</div>
								<!-- </div> -->
								<div class="examen_descripcion">
									<p>Examen de la asignatura de comentario</p>
								</div>
								<div class="examen_puntos examen_icon">
									<table style="min-height: 300px;">
									@foreach($examenes as $key => $examen)
										<tr>
											<td><a href="{{ url('/examen') }}?test={{ $examen['id'] }}">{{ $key +1 }}</a></td>
											<td><a href="{{ url('/examen') }}?test={{ $examen['id'] }}" class="custom">{{ $examen['codigo'] }}</a></td>
											<td><a href="{{ url('/examen') }}?test={{ $examen['id'] }}" class="custom">{{ $examen['nombre'] }}</a></td>
										</tr>
									@endforeach
									</table>
								</div>
								<div class="examen_boton_custom">
									<hr style="padding:0; margin: 0;"/>
								</div>
							</div>
						</div>


					@else
						You are logged in!
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection