<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');

	//var_dump($_POST);
	//die();
	if($_POST['modificar_band'] == 1)
	{
		echo "<table class='modificar_stock' id='modificar_stock_tabla'>
			<thead>
			<tr class='encabezado'>
					<td>ID PRODUCTO</td>
					<td>NOMBRE</td>
					<td>NUM FARDOS</td>
					<td>PRECIO S/IVA</td>
					<td>PRECIO C/IVA</td>
			</tr>
			</thead>";

			$id_producto_empresa = "";
			$num_fardos = "";
			$kilos = "";

			$res = $obj_fd_stock->Extraer_Productos_Stock_WP();

			echo "<tbody>";
			while($row = $res->fetch_assoc())
			{
				$id 			 = $row["ID"];
				$nombre_producto = $row['post_title'];
				$id_wp_posts 		 = $id;
				$id_producto_empresa = $obj_fd_stock->Extraer_ID_EMPRESA($id_wp_posts);
				$cantidad_fardos = $obj_fd_stock->Extraer_Cantidad_Producto($id_wp_posts);
				$precio_sin_iva = $obj_fd_stock->Extraer_Precio_Producto($id_wp_posts);
				//$precio_sin_iva = $row['_regular_price'];
				if (isset($precio_sin_iva) && is_numeric($precio_sin_iva)) {
					$precio_sin_iva = floor($precio_sin_iva);
				} else {
					$precio_sin_iva = 0; // Default value
				}
				
				$precio_con_iva = $precio_sin_iva + $precio_sin_iva*0.19;
				if (isset($precio_con_iva) && is_numeric($precio_con_iva)) {
					$precio_con_iva = floor($precio_con_iva);
				} else {
					$precio_con_iva = 0; // Default value
				}
				
				echo "<tr class='modif_activo' id='modif_id_$id'>
						<td>
							<input class='ancho_stock' type='text' id='id_producto_empresa_$id' value='$id_producto_empresa' />
							<input type='hidden' name='id_wp_posts_$id' id='id_wp_posts_$id' value='$id_wp_posts'>
							<textarea style='width:0; height:0;visibility:hidden;padding:0; border:0; margin:0; display:block;'>$id_producto_empresa</textarea>
						</td>
						<td>";
							echo $nombre_producto;
						echo "<textarea style='width:0; height:0;visibility:hidden;padding:0; border:0; margin:0; display:block;'>$nombre_producto</textarea>
						</td>
						<td>";
							/*if($cantidad_fardos == 0)
								echo $cantidad_fardos;
							else*/
						echo "<input class='ancho_stock' type='number' id='num_fardos_$id' value='$cantidad_fardos' />";
						echo "<textarea style='width:0; height:0;visibility:hidden;padding:0; border:0; margin:0; display:block;'>$cantidad_fardos</textarea>
						</td>
						<td>
							$precio_sin_iva
							<textarea style='width:0; height:0;visibility:hidden;padding:0; border:0; margin:0; display:block;'>$precio_sin_iva</textarea>
						</td>
						<td>
							$precio_con_iva
							<textarea style='width:0; height:0;visibility:hidden;padding:0; border:0; margin:0; display:block;'>$precio_con_iva</textarea>
						</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "<tfoot></tfoot>";
			echo "</table>";
			echo "<input type='submit' class='modificar_stock' id='modificar_stock_submit' value='Modificar Stock'>";
	}
	else
	{
		$res = $obj_fd_stock->Extraer_Productos_Stock_WP();
		while($row = $res->fetch_assoc())
		{
			echo $row["ID"]."-";
		}
		//unset($_POST['eliminar_band']);
		//echo "<input type='hidden' name='eliminar_band' value='1' />";
	}

?>