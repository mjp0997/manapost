<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>ManaPost</title>

	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
	<section>
		<div class="Login">
			<div class="Login__Front">
				<div class="Login__LogoContain">
					<img class="Login__Logo" src="{{ asset('media/Logo ManaPost 2.png') }}">
				</div>
			</div>

			<form class="Login__Form" method="POST" action="{{ url('/login') }}">
				@csrf

				<h2 class="Login__Title">Inicio de Sesión</h2>

				@if (session('error'))
					<p style="color: red">{{session('error')}}</p>
				@endif

				<input name="usuario" class="Login__Textfield" type="text" placeholder="Usuario" value="{{ old('usuario') }}" required autocomplete="off" autofocus>

				<input name="clave" class="Login__Textfield" type="password" placeholder="Contraseña" required>

				<label class="Login__Label"><!-- Contraseña Incorrecta --></label>

				<button
					type="submit"
					class="Login__Button"
				>Ingresar</button>
			</form>
		</div>
	</section>
</body>
</html>