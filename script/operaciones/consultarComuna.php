<?php 

	$link = mysqli_connect("localhost","root","","mydb");

	$region = $_GET['q'];
	$sql="select * from comuna where id_region = ". $region;
	$resultadoTres = $link->query($sql);
	while($linea = mysqli_fetch_array($resultadoTres))
	{
		echo "<option value='".$linea['id_comuna']."'>".utf8_encode($linea['nombre_comuna'])."</option>";
	}
	mysqli_close($link);
 ?>