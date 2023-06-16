<?php 
	include('../../../plugins/fardos-admin/process/clases.php'); 

	$id_envio 		   = $_POST['id_envio'];
	$codigo_barras 	   = $_POST['codigo_barras'];
	$cantidad		   = $_POST['cantidad'];
	var_dump($id_envio);
	var_dump($codigo_barras);
	var_dump($cantidad);
	if($codigo_barras)
	{
		$id_wp_posts = $obj_fd_stock->Extraer_ID_WP($codigo_barras);
		if($id_wp_posts)
		{
			$res = $obj_fd_stock->Extraer_Nombre_Producto($id_wp_posts);
			$res = $res->fetch_assoc();
			$nombre_producto = $res["post_title"];

			if($nombre_producto)
			{
				$res = $obj_fd_productos_envio->Verificar_Producto_En_Lista_Actual($codigo_barras, $id_envio);
				if($res->num_rows)
				{
					$row = $res->fetch_assoc();
					$cantidad = $row["CANTIDAD"] + $cantidad;
					$obj_fd_productos_envio->Modificar_Producto_Envio($row["ID"], $cantidad);
				}
				else
					$obj_fd_productos_envio->Anadir_Producto_Envio($id_envio, $codigo_barras, $cantidad, $nombre_producto);
			?>
			<table id="tabla_productos_envios_registrados" class="activo">
				<thead>
					<tr class="encabezado">
						<td>CÓDIGO DE BARRAS</td>
						<td>NOMBRE</td>
						<td>CANTIDAD</td>
					</tr>
				</thead>
				<tbody>
				<?php 
					$res = $obj_fd_productos_envio->Extraer_Productos_Envio($id_envio);
					while($row = $res->fetch_assoc())
					{
				?>
					<tr>
						<td><?php echo $row["CODIGO_BARRA"]; ?></td>
						<td><?php echo $row["NOMBRE"]; ?></td>
						<td><?php echo $row["CANTIDAD"]; ?></td>
					</tr>
				<?php 
					}
				?>
				</tbody>
			</table>
			<?php
			}
			else
				echo 1;
		}
		else
			echo 2;
	}
	else
	{
		echo 0;
	}
?>