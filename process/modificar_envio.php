<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');



	$id 		 = $_POST['id_modificar'];
	$fecha 		 = $_POST['fecha_modificar'];
	$descripcion = $_POST['descripcion_modificar'];
	$enviado 	 = $_POST['enviado_modificar'];
	$recibido 	 = $_POST['recibido_modificar'];

	if($recibido)
	{
		$res = $obj_fd_productos_envio->Extraer_Productos_Envio($id);

		while($row = $res->fetch_assoc())
		{
			$id_producto_empresa = $row["CODIGO_BARRA"];
			$cantidad_producto_envio = $row["CANTIDAD"];
			$id_wp = $obj_fd_stock->Extraer_ID_WP($id_producto_empresa);

			if($obj_fd_stock->Verificar_Producto_Stock_WP($id_wp))
			{
				$obj_fd_stock->Aumentar_Cantidad_Producto_WP($id_wp, $cantidad_producto_envio);
			}
			else
			{
				$obj_fd_stock->Insertar_Producto_Stock_WP($id_wp, $cantidad_producto_envio);
			}
		}
	}
	if($obj_fd_envios->Modificar_Envio($id, $fecha, $descripcion, $enviado, $recibido))
		echo 1;
	else
		echo 0;

	//echo $fecha." - ".$descripcion;
?>