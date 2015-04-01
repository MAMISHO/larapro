@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3><i class="fa fa-file-text-o"></i> &nbsp; Registrar nuevo Examen</h3></div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Atención!</strong> Hay problemas con los datos.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/crear/nuevo/examen') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Código</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="onyx-button onyx-blue">
									Registrar
								</button>
								<a style="color: white;" type="button" class="onyx-button onyx-blue" href="{{ url('/home') }}" value="Terminar">Atrás</a>
							</div>
						</div>
						<!-- <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a style="color: white;" type="button" class="onyx-button onyx-blue" href="http://localhost/certificado/dir/index.html" value="Terminar">firmar</a>
							</div>
						</div> -->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection