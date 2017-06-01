<?php 
	$rol = $_POST['rol'];
	$nombres = utf8_decode($_POST['nombres']);
	$apellidoP = utf8_decode($_POST['apellidoP']);
	$apellidoM = utf8_decode($_POST['apellidoM']);
	$nick = utf8_decode($_POST['nick']);
	$correo = $_POST['correo'];
	$clave = utf8_decode($_POST['clave']);
	$verificacionClave = utf8_decode($_POST['verificacionClave']);
	$pais = utf8_decode($_POST['pais']);
	$region = utf8_decode($_POST['region']);
	$comuna = utf8_decode($_POST['comuna']);
	$telefono = $_POST['telefono'];

	// echo $rol,$nombres,$apellidoP,$apellidoM,$nick,$correo,$clave,$verificacionClave,$pais,$region,$comuna,$telefono;

	require_once('conexion.php');
	$conexion = new conexion();
	$link = $conexion->conectar();
	$sql = "insert into usuario (nombres,ape_paterno,ape_materno,nick,correo,rol,id_nacionalidad,id_region,comuna,telefono) values('".$nombres."','".$apellidoP."','".$apellidoM."','".$nick."','".$correo."',".$rol.",".$pais.",".$region.",".$comuna.",".$telefono.")";
	if($link->query($sql) === TRUE)
	{
		echo "Se ingresaron correctamente los datos";
	}
	else
	{
		echo "Error.";
	}

	
	$conexion->desconectar($link);
 ?>