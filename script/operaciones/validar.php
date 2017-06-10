<?php 
	require_once('conexion.php');
	require_once('session.php');

	$nombre;
	$rol;
	$buscador = $_POST['usuario'];
	$pass;
	$passIngresada = $_POST['password'];

	$conexion = new conexion();
	$link = $conexion->conectar();

	$sql = "select nick, correo, pass, rol from usuario usr, validacion vla where usr.id_usuario = vla.id_usuario and (usr.correo = '".$buscador."' or usr.nick = '".$buscador."');";
	$resultado = $link->query($sql);

	while ($linea = mysqli_fetch_array($resultado))
	{
		$correo = $linea['correo'];
		$pass = $linea['pass'];
		$rol = $linea['rol'];
		$nick = $linea['nick'];
	}

	if($passIngresada == $pass)
	{
		sesion::iniciarSesion($nick, $rol);
	}
	else
	{
		echo "No se a podido iniciar sesion";
	}
 ?>