<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


	$fecha = $_POST['fecha_registro'];
	$descripcion = $_POST['descripcion_registro'];

	if($fecha && $descripcion)
	{
		$obj_fd_envios->Registrar_Envio($fecha, $descripcion);
		echo 1;
	}else
	{
		echo 0;
	}

	//echo $fecha." - ".$descripcion;
?>