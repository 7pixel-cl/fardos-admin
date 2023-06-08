<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


	$id_eliminar = $_POST['envio_eliminar'];

	if($obj_fd_envios->Eliminar_Envio($id_eliminar))
	{
		$obj_fd_productos_envio->Eliminar_Productos_de_Envio($id_eliminar);
		echo 1;
	}
	else
		echo 0;
	//echo $fecha." - ".$descripcion;
?>