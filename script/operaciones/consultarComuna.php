<?php 

	$link = mysqli_connect("localhost","root","","mydb");

	$region = $_GET['q'];
	$sql="SELECT * FROM `comuna` WHERE id_Region = ".$region." order by nombre_comuna";
	$resultadoTres = $link->query($sql);
	while($linea = mysqli_fetch_array($resultadoTres))
	{	
		echo "<option value='".$linea['id_comuna']."'>".utf8_encode($linea['nombre_comuna'])."</option>";
	}
	mysqli_close($link);
 ?>