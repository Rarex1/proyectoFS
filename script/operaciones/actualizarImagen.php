<?php
  if(isset($_FILES["foto"]))
  {
    $archivo = $_FILES["foto"];
    $nombre = $archivo["name"];
    $nombrePro = $archivo["tmp_name"];
    $carpeta = "ftp://localhost/perfiles/";
    $src = $carpeta.$nombre;

    $conexion = ftp_connect("localhost");

    ftp_login($conexion, "Daniel", "123456");

    if (ftp_put($conexion,"perfiles/".$nombre,$nombrePro, FTP_BINARY)) {
      echo $src;
    }
    else {
      echo "No se puedo subir el archivo";
    }

    ftp_close($conexion);
  }
 ?>
