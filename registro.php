<?php 
	require_once('script/operaciones/conexion.php');
	$conexion = new conexion;
	$link = $conexion->conectar();

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
	<meta charset="UTF-8">
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
				<input type="text" placeholder="Nombres">
				<input type="text" placeholder="Primer apellido">
				<input type="text" placeholder="Segundo apellido">
				<input type="text" placeholder="Nick">
				<input type="email" placeholder="Correo">
				<input type="password" placeholder="Clave">
				<input type="password" placeholder="Repite la clave">
				<select name="" id="">
				<?php
					while ($linea = mysqli_fetch_array($resultado)) 
					{
						echo "<option value='".$linea['id_Rol']."'>".$linea['tipo']."</option>";
					}
				?>
				</select>
				<!-- rol -->
				<!-- Nacionalidad -->
				<!-- Comuna -->
				<input type="text" placeholder="Telefono">
			</form>
		</div>
	</div>
</body>
</html>