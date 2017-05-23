<?php 
	class conexion
	{
		public $conexion;
		public $server;
		public $usuario;
		public $clave;
		public $bd;

		public function __construct()
		{
			$this->server = "localhost";
			$this->usuario = "root";
			$this->clave = "";
			$this->bd = "mydb";
		}

		public function conectar()
		{
			$this->conexion = mysqli_connect($this->server,$this->usuario,$this->clave,$this->bd) or die('No se pudo conectar: '.mysql_error());
			return $this->conexion;
		}

		public function desconectar($link)
		{
			mysqli_close($link);
		}
	}
 ?>