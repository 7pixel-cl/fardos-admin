<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');



	$id 	   = $_POST['id_modificar'];
	$nombres   = $_POST['nombre_modificar'];
	$apellidos = $_POST['apellido_modificar'];
	$telefono  = $_POST['telefono_modificar'];
	$email 	   = $_POST['email_modificar'];

	if($obj_fd_vendedores->Modificar_Vendedor($id, $nombres, $apellidos, $telefono, $email))
		echo 1;
	else
		echo 0;

	//echo $fecha." - ".$descripcion;
?>