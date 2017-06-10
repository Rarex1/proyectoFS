<?php 
	class sesion
	{
		public static function iniciarSesion($nombre, $rol)
		{
			session_start();

			$_SESSION['nombre'] = $nombre;
			$_SESSION['rol'] = $rol;

			echo "Se inició sesion";
		}

		public static function cerrarSesion()
		{
			session_destroy();
		}
	}
 ?>