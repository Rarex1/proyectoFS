<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>First Sight - Registro</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<nav>
		<ul>
			<li><a href="#">Iniciar sesion</a></li>
			<li><a href="registro.php">Registrarse</a></li>
			<input type="text" placeholder="Buscar">
		</ul>
	</nav>
	<div class="contRegistro">
		<div class="formRegistro">
			<form action="script/operaciones/validar.php" method="POST">
				<input type="text" name="usuario" placeholder="Usuario">
				<input type="password" name="password" placeholder="Clave">
				<input type="submit" value="Registrar">
			</form>
		</div>
	</div>
</body>
</html>