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
					<i class="fa fa-book fa-2x"> &nbsp;Exámenes Disponibles</i> 
				</div>

				<div class="panel-body">
					@if (Session::get('miSession'))
						
						<div class="flexcontainer">
						@foreach ($examenes as $examen)
							<div>
								<div class="examen_titulo">
									<h2>{{ $examen['examen_codigo'] }}</h2>
								</div>
								<div class="examen_imagen">
									<i class="fa fa-list-alt fa-5x"></i>
								</div>
								<div class="examen_descripcion">
									<p>Examen de la asignatura de {{ $examen['examen_nombre'] }}</p>
								</div>
								<div class="examen_puntos">
									<p>Puntos posibles: </p>
								</div>
								<div class="examen_boton">
								<form action="{{ url('/home/examen') }}" method="POST">
									<input style="color: white;" type="submit" class="onyx-button onyx-blue" id="{{ $examen['examen_id'] }}" value="Realizar"></input>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
									
									<!-- <h3>Realizar</h3> -->
								</div>
							</div>
						@endforeach
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
