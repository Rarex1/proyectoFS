<?php
  if(isset($_FILES["foto"]))
  {
    session_start();

    require_once('conexion.php');
    $conexionSQL = new conexion();
    $link = $conexionSQL->conectar();


    $archivo = $_FILES["foto"];
    $nombre = $archivo["name"];
    $nombrePro = $archivo["tmp_name"];
    $carpeta = "ftp://localhost/perfiles/";
    $src = $carpeta.$nombre;

    $sql = "UPDATE `usuario` SET `perfil_img`= '".$src."' WHERE usuario.id_usuario = ".$_SESSION['id'].";";
    $link->query($sql);

    $conexion = ftp_connect("localhost");

    ftp_login($conexion, "Daniel", "123456");

    if (ftp_put($conexion,"perfiles/".$nombre,$nombrePro, FTP_BINARY)) {
      echo $src;
    }
    else {
      echo "No se puedo subir el archivo";
    }
    mysqli_close($link);
  }
 ?>
