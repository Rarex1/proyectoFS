<?php
	session_start();

	$nick = "";
	$pais;
	$nombrePais;
	$iconoBandera;
	$imagenPerfil;
	if(isset($_SESSION['id']))
	{
		require_once('script/operaciones/conexion.php');
		$conexion = new conexion();
		$link = $conexion->conectar();
		$sql = "SELECT usu.*, pai.bandera, pai.nombre_pais FROM usuario usu, pais pai WHERE usu.id_usuario = ".$_SESSION['id'].";";
		$resultado = $link->query($sql);
		while ($linea = mysqli_fetch_array($resultado))
		{
			$nick = $linea['nick'];
			$pais = $linea['id_nacionalidad'];
			$nombrePais = $linea['nombre_pais'];
			$iconoBandera = $linea['bandera'];
			$imagenPerfil = $linea['perfil_img'];
		}
	}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>First Sight</title>
	<link rel="stylesheet" href="style/style.css">
	<script type="text/javascript" src="script/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
	$(function(){
	  $("input[name='foto']").on("change", function(){
	    datosFormulario = new FormData($("#formulario")[0]);
	    ruta = "script/operaciones/actualizarImagen.php";
	    $.ajax({
	      url: ruta,
	      type: "POST",
	      data: datosFormulario,
	      contentType: false,
	      processData: false,
	      success: function(datos)
	      {
	        $("#imgTagPerfil").attr("src", datos);
	      }
	    });
	  });
	});

	</script>
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
		<p>Nacionalidad: <?php echo $nombrePais; ?></p><img src="<?php echo 'ftp://localhost/'.$iconoBandera; ?>" alt="Imagen de bandera">
		<div class="imgPerfil">
			<form method="post" id="formulario" enctype="multipart/form-data" style="height: 100%; width:100%; position: relative;">
				<input type="file" name="foto" style="height: 100%; width:100%; opacity: 0; z-index: 2; position: absolute;">
				<img src="<?php echo $imagenPerfil; ?>" id="imgTagPerfil" alt="">
			</form>
		</div>
	</div>
</body>
</html>
