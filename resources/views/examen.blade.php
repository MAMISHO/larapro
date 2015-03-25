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
									<h3>Fecha : 0000 / 00 / 00 </h3>
								</div>	
							</div>
						</div>
					</div>
					
				</div>

				<div class="panel-body">
						Examen!
				</div>

			</div>
		</div>
	</div>
</div>
@endsection