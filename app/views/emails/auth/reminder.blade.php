<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Restablecer contraseña</h2>

		<div> <a href=""></a>
			Para restablecer su contraseña, rellene este formulario: <a href=" {{ URL::to('password/reset', array($token)) }}">Restablecer contraseña</a><br/>
			Este enlace se vencerá en {{ Config::get('auth.reminder.expire', 60) }} minutos.
		</div>
	</body>
</html>
