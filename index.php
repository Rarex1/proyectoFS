<?php	
	session_start();

	$nick = "";
	if(isset($_SESSION['id']))
	{
		require_once('script/operaciones/conexion.php');
		$conexion = new conexion();
		$link = $conexion->conectar();
		$sql = "select * from usuario where id_usuario = ".$_SESSION['id'].";";
		$resultado = $link->query($sql);
		while ($linea = mysqli_fetch_array($resultado))
		{
			$nick = $linea['nick'];
		}
	}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>First Sight</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<nav>
		<ul>
			<li><?php echo $nick; ?></li>
			<li><a href="login.php">Iniciar sesion</a></li>
			<li><a href="script/operaciones/cerrarSesion.php">Cerrar sesion</a></li>
			<li><a href="registro.php">Registrarse</a></li>
			<input type="text" placeholder="Buscar">
		</ul>
	</nav>
	<section class="dashboard">
		<div class="foto"></div>
		<div class="foto"></div>
		<div class="foto"></div>
		<div class="foto"></div>
		<div class="foto"></div>
	</section>
</body>
<script type="text/javascript" src="script/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="script/script.js"></script>
</html>