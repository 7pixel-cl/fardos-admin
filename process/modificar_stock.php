<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');



	$id 	  			 = $_POST['id_modificar'];
	$id_wp_posts 		 = $_POST['id_wp_posts'];
	$id_producto_empresa = $_POST['id_producto_empresa'];
	$num_fardos  		 = $_POST['num_fardos'];
	$kilos 	   			 = 0;

	if($obj_fd_stock->Modificar_Productos_Stock($id, $id_producto_empresa, $num_fardos, $kilos) && $obj_fd_stock->Modificar_Cantidad_Producto($id_wp_posts, $num_fardos))
		echo 1;
	else
		echo 0;

	//echo $fecha." - ".$descripcion;
?>