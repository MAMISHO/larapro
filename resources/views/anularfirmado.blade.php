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
				<div class="panel-heading">
					<i class="fa fa-book fa-2x"> &nbsp;Examen enviado</i> 
				</div>

				<div class="panel-body">
				@if($id_firmas != "")
					
					<h2 style="text-align: center;">Examen firmado correctamente</h2>
					<br />
					<h4>Con el siguinete identificador puede acceder al examen</h4>
					<br />
					@foreach($id_firmas as $key => $firma)
					<i class="fa fa-key fa-2x" style="color:white; text-align: center; border: 2px solid #333; padding: 10px; background-color: #337ab7;border-radius: 20px; "> {{ $firma }} </i>
					<br />
					@endforeach
				@else
					<h2>Error al firmar el examen</h2>
				@endif
				<br />
				<br />
				
				</div>
				<a style="color: white;" type="button" class="onyx-button onyx-blue" href="{{ url('/home') }}" value="Terminar">Finalizar</a>
			</div>
		</div>
	</div>
</div>
@endsection