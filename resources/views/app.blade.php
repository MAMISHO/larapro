<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>APP</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- scripts -->
	<script src="{{ asset('../resources/assets/ae/enyo/enyo.js') }}" charset="utf-8"></script>
	<script src="{{ asset('../resources/assets/ae/source/package.js') }}" charset="utf-8"></script>
	<!-- Fonts -->
	<!-- // <script src="../../resources/assets/ae/enyo/enyo.js" charset="utf-8"></script> -->
	<!-- // <script src="../../resources/assets/ae/source/package.js" charset="utf-8"></script> -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<nav class="onyx onyx-toolbar onyx-light topper">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand titulo" style="text-decoration: underline;" href="{{ url('/home') }}">Exámenes</a>
			</div>
				<ul class="nav navbar-nav navbar-right" id="nav_principal">
					@if (!Session::get('miSession'))
						<li><a href="{{ url('/') }}">Login</a></li>
					@else
				            @if (Session::get('tipo_usuario')=="administrador")
				            	<li id="op1"><a href="{{ url('/crear/examen') }}" class="homeIcon"><i class="fa fa-plus-circle"></i> Crear examen</a></li>
				            @else
				                <li id="op1"><a href="{{ url('/home') }}" class="homeIcon"><i class="fa fa-list-alt"></i> Nuevo examen</a></li>
				            @endif
				                <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-key"></i>Trajeta de claves <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ url('/tablaClaves/ver') }}"><i class="fa fa-file-pdf-o"></i> &nbsp;Ver</a></li>
										<li><a href="{{ url('/tablaClaves/descargar') }}"><i class="fa fa-file-pdf-o"></i> &nbsp;Descargar</a></li>
									</ul>
								</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="bienvenida"><i class="fa fa-user"></i> Bienvenido/a</span> {{ Session::get('nombre') }}&nbsp;{{ Session::get('apellidos') }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}"><i class="fa fa-power-off"></i> &nbsp;Salir</a></li>
							</ul>
						</li>
					@endif
				</ul>
				<ul id="nav_mobile">
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="bienvenida"><i class="fa fa-user"></i> Bienvenido/a</span> {{ Session::get('nombre') }}<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}"><i class="fa fa-power-off"></i> &nbsp;Salir</a></li>
								@if (!Session::get('miSession'))
									<li><a href="{{ url('/') }}">Login</a></li>
								@else
							            @if (Session::get('tipo_usuario')=="administrador")
							            	<li id="op1"><a href="{{ url('/crear/examen') }}" class="homeIcon"><i class="fa fa-plus-circle"></i> Crear examen</a></li>
							            @else
							                <li id="op1"><a href="{{ url('/home') }}" class="homeIcon"><i class="fa fa-list-alt"></i> Nuevo examen</a></li>
							            @endif
							                <!-- <li class="dropdown"> -->
												<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-key"></i>Trajeta de claves <span class="caret"></span></a> -->
												<!-- <ul class="dropdown-menu" role="menu"> -->
													<li><a href="{{ url('/tablaClaves/ver') }}"><i class="fa fa-file-pdf-o"></i> &nbsp;Ver</a></li>
													<li><a href="{{ url('/tablaClaves/descargar') }}"><i class="fa fa-file-pdf-o"></i> &nbsp;Descargar</a></li>
												<!-- </ul> -->
											<!-- </li> -->
								@endif
							</ul>
						</li>
				</ul>
			<!-- </div> -->
		</div>
	</nav>
	<br />
	<br />

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
