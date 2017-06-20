<?php 
	session_start();

	$nick = "";
	$pais;
	$nombrePais;
	$iconoBanderaDec;
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
			$pais = $linea['id_nacionalidad'];
		}
		$sqlPais = "select * from pais where id_pais = ".$pais.";";
		$resultado = $link->query($sqlPais);
		while ($linea = mysqli_fetch_array($resultado))
		{
			$nombrePais = $linea['nombre_pais'];
			$iconoBanderaDec = $linea['bandera'];
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
			<?php 
				if(!isset($_SESSION['id']))
				{
					echo "<li><a href='login.php'>Iniciar sesion</a></li>";
					echo "<li><a href='registro.php'>Registrarse</a></li>";
				}
				if(isset($_SESSION['id']))
				{
					echo "<li><a href='script/operaciones/cerrarSesion.php'>Cerrar sesion</a></li>";
				}
			 ?>
			 <a href="perfil.php">
			 	<li><?php echo ucfirst($nick); ?></li>
			 </a>
			<input type="text" placeholder="Buscar">
		</ul>
	</nav>
	<div class="cont">
		<p>Nacionalidad: <?php echo $nombrePais; ?></p><?php echo '<img class="banderaIco" src="data:image/jpeg;base64,'.base64_encode( $iconoBanderaDec ).'"/>'; ?>
		<div class="imgPerfil">
			<img src="" alt="">
		</div>
	</div>
	
</body>
<script type="text/javascript" src="script/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="script/script.js"></script>
</html>