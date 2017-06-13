<?php 
	require_once('conexion.php');
	require_once('session.php');

	$buscador = $_POST['usuario'];
	$passIngresada = $_POST['password'];
	$id_usuario;
	$pass;

	$conexion = new conexion();
	$link = $conexion->conectar();

	$sql = "select usr.id_usuario, correo, pass from usuario usr, validacion vla where usr.id_usuario = vla.id_usuario and (usr.correo = '".$buscador."' or usr.nick = '".$buscador."');";
	$resultado = $link->query($sql);

	while ($linea = mysqli_fetch_array($resultado))
	{
		$correo = $linea['correo'];
		$pass = $linea['pass'];
		$id_usuario = $linea['id_usuario'];
	}

	if(hash_equals(('$5$rounds=4759$Diva2017$'.$pass), crypt($passIngresada, '$5$rounds=4759$Diva2017$')))
	{
		sesion::iniciarSesion($id_usuario);
	}
	else
	{
		echo "Clave o usuario incorrecto";
	}
 ?>