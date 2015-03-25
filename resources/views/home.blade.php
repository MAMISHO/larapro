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
					<i class="fa fa-book fa-3x"> &nbsp;Examenes Disponibles</i> 
				</div>

				<div class="panel-body">
					@if (Session::get('miSession'))
						<li class="examen_lista"> {{ $examenes[0]['usuario_id'] }} </li>
						<div class="flexcontainer">
							<div>
								<div class="examen_titulo"></div>
								<div class="examen_imagen"></div>
								<div class="examen_puntos"></div>
								<div class="examen_disponible"></div>
								<div class="examen_boton"></div>
							</div>
							<div>hola</div>
							<div>hola</div>
							<div>hola</div>
							<div>hola</div>
							<div>hola</div>
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
