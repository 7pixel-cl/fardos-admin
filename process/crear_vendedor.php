<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


	$nombre_vendedor = $_POST['nombre_vendedor'];
	$apellido_vendedor = $_POST['apellido_vendedor'];
	$telefono_vendedor = $_POST['telefono_vendedor'];
	$email_vendedor = $_POST['email_vendedor'];

	if($nombre_vendedor && $apellido_vendedor && $email_vendedor && filter_var($email_vendedor, FILTER_VALIDATE_EMAIL))
	{
		$obj_fd_vendedores->Registrar_Vendedor($nombre_vendedor, $apellido_vendedor, $telefono_vendedor, $email_vendedor);
		echo 1;
	}
	else
	{
		echo 0;
	}

	//echo $fecha." - ".$descripcion;
?>