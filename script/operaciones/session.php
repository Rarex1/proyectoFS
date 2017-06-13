<?php 
	class sesion
	{
		public static function iniciarSesion($id)
		{
			session_start();

			$_SESSION['id'] = $id;
			echo $_SESSION['id'];
			echo "Se inició sesion";
			header("Location: /proyectoFS/");
		}

		public static function cerrarSesion()
		{
			session_start();
			session_destroy();
			header("Location: /proyectoFS/");
		}
	}
 ?>