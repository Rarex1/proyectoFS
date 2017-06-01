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
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>First Sight - Registro</title>
	<link rel="stylesheet" href="style/style.css">
	<script type="text/javascript">
		function showComunas(str) {
		    if (str == "") {
		        document.getElementById("comuna").innerHTML = "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
		                document.getElementById("comuna").innerHTML = this.responseText;
		            }
		        };
		        xmlhttp.open("GET","script/operaciones/consultarComuna.php?q="+str,true);
		        xmlhttp.send();
		    }
		}
	</script>
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
				<select name="rol" id="">
				<?php
					while ($linea = mysqli_fetch_array($resultado)) 
					{
						echo "<option value='".$linea['id_Rol']."'>".utf8_encode($linea['tipo'])."</option>";
					}
				?>
				</select>
				<input type="text" name="nombres" placeholder="Nombres">
				<input type="text" name="apellidoP" placeholder="Primer apellido">
				<input type="text" name="apellidoM" placeholder="Segundo apellido">
				<input type="text" name="nick" placeholder="Nick">
				<input type="email" name="correo" placeholder="Correo">
				<input type="password" name="clave" placeholder="Clave">
				<input type="password" name="verificacionClave" placeholder="Repite la clave">
				<select name="pais" id="">
					<?php 
						$sql = "select * from pais;";
						$resultado = $link->query($sql);
						while ($linea = mysqli_fetch_array($resultado)) 
						{
							echo "<option value='".$linea['id_pais']."'>".utf8_encode($linea['nombre_pais'])."</option>";
						}
					 ?>
				</select>
				<select name="region" id="" onchange="showComunas(this.value)">
					<?php 
						$sql = "select * from region;";
						$resultado = $link->query($sql);
						echo "<option value=''>Seleccione la region</option>";
						while ($linea = mysqli_fetch_array($resultado)) 
						{
							echo "<option value='".$linea['id_Region']."'>".utf8_encode($linea['nombre_region'])."</option>";
						}
					 ?>
				</select>
				<select name="comuna" id="comuna"></select>
				<input type="text" name="telefono" placeholder="Telefono">
				<input type="submit" value="Registrar">
			</form>
		</div>
	</div>
</body>
<?php 
	$conexion->desconectar($link);
 ?>
</html>