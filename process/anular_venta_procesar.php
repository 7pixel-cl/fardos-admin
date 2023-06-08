<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');

	$id_venta = $_POST['id_venta'];

	if($obj_fd_ventas->Eliminar_Venta($id_venta))
	{
		$res = $obj_fd_linea_ventas->Extraer_Productos_Linea_Venta($id_venta);

		while($row = $res->fetch_assoc())
		{
			$id_wp = $obj_fd_stock->Extraer_ID_WP($row["ID_PRODUCTO"]);
			$obj_fd_stock->Aumentar_Cantidad_Producto_WP($id_wp, $row["CANTIDAD"]);
		}

		echo 1;
	}
	else
		echo 0;
?>