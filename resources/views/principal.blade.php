<html>
	<head>
		<title>Laravel</title>
		
		<!-- <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'> -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>page 2</title>
		<link rel="shortcut icon" href="../resources/assets/ae/resources/assets/favicon.ico"/>
		<!-- -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<!-- Less.js (for client-side rendering of less stylesheets; comment to use pre-compiled CSS) -->
		 <!-- <script src="../resources/assets/ae/enyo/tools/less.js"></script> -->
		<!-- enyo (debug) -->


		<!-- // <script src="../resources/assets/ae/enyo/enyo.js" charset="utf-8"></script> -->
		<!-- application (debug) -->
		<!-- // <script src="../resources/assets/ae/source/package.js" charset="utf-8"></script> -->

			<script src="{{ asset('../resources/assets/ae/enyo/enyo.js') }}" charset="utf-8"></script>
	<script src="{{ asset('../resources/assets/ae/source/package.js') }}" charset="utf-8"></script>
		

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #cacaca;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 24px;
				font-style: oblique;
				margin-bottom: 10px;
				margin-right: 80%;
				font-family: 'Lato';
				color: #35A8EE;
			}

			.quote {
				font-size: 14px;
			}
		</style>
	</head>
	<body class="nice-padding">
		<input type="hidden" name="token" value="{{ csrf_token() }}">
		<!-- <input type="hidden" name="position" value="{{ $position }}"> -->
		@if (count($errors) > 0)
		<input type="hidden" class="form-control" name="usuario_ant" value="{{ old('usuario_ant') }}">
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul id="errores">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
		@endif
		<script type="text/javascript">
				// enyo.ready(function () {
					new myapp.Application({name: "app"});
				// });
		</script>
		<input type="hidden" name="position" value="{{ $position }}">
		
		<!-- <div class="container">
			<div class="content">
				<div class="title">Principal</div>
				<div class="quote">{{ Inspiring::quote() }}</div>
			</div>
		</div> -->
			
	</body>
</html>