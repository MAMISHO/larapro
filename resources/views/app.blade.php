<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>APP</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<script src="../../resources/assets/ae/enyo/enyo.js" charset="utf-8"></script>
	<script src="../../resources/assets/ae/source/package.js" charset="utf-8"></script>
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="onyx onyx-toolbar onyx-toolbar-inline onyx-light">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button> -->
				<a class="navbar-brand titulo" href="#">Exámenes</a>
			</div>

			<!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
				<!-- <ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>
 -->
				<ul class="nav navbar-nav navbar-right">
					@if (!Session::get('miSession'))
						<li><a href="{{ url('/') }}">Login</a></li>
						<!-- <li><a href="{{ url('/auth/register') }}">Register</a></li> -->
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Session::get('miSession', 'usuario') }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Salir</a></li>
							</ul>
						</li>
					@endif
				</ul>
			<!-- </div> -->
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
