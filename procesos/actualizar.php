<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['nombreAct'],
		$_POST['anioAct'],
		$_POST['empresaAct'],
		$_POST['idjuego']
				);

	echo $obj->actualizar($datos);
	

 ?>