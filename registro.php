<?php 
	require_once('script/operaciones/conexion.php');
	$conexion = new conexion;
	$link = mysqli_connect("localhost","root","","mydb");
	$sql = "SELECT * FROM `rol` WHERE id_Rol <> 1 AND id_Rol <> 4;";
	$resultado = $link->query($sql);

	if($resultado === FALSE) 
	{ 
    	die(mysql_error()); 
	}

	$conexion->desconectar($link);
 ?>
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
			<form action="script/operaciones/registrar.php" method="POST">
				<select name="" id="">
				<?php
					while ($linea = mysqli_fetch_array($resultado)) 
					{
						echo "<option value='".$linea['id_Rol']."'>".utf8_encode($linea['tipo'])."</option>";
					}
				?>
				</select>
				<input type="text" placeholder="Nombres">
				<input type="text" placeholder="Primer apellido">
				<input type="text" placeholder="Segundo apellido">
				<input type="text" placeholder="Nick">
				<input type="email" placeholder="Correo">
				<input type="password" placeholder="Clave">
				<input type="password" placeholder="Repite la clave">
				<!-- rol -->
				<!-- Nacionalidad -->
				<!-- Comuna -->
				<input type="text" placeholder="Telefono">
			</form>
		</div>
	</div>
</body>
</html>