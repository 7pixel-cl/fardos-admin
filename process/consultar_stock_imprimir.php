<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


		echo "<table class='consultar_stock' id='consultar_stock_tabla'>
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
				//var_dump($row);
				// die();
				$id_wp_posts	 = $row['ID'];
				$nombre_producto = $row['post_title'];
				//var_dump($id_wp_posts);
				//die();
				$obj_fd_stock->Verificar_ID_WP_POST($id_wp_posts);
		
				
				//var_dump($id_wp_posts);
				//var_dump($obj_fd_stock->Verificar_ID_WP_POST($id_wp_posts));
				//die();
				if($obj_fd_stock->Verificar_ID_WP_POST($id_wp_posts))
				{
					//var_dump($id_wp_posts);
					//die();
					$obj_fd_stock->Insertar_Producto_Stock($id_wp_posts, 0, 0);
				}
				
				
				$res_stock = $obj_fd_stock->Extraer_Producto_Stock($id_wp_posts);
				$row_stock = $res_stock->fetch_assoc();
				
				$cantidad_fardos = $obj_fd_stock->Extraer_Cantidad_Producto($id_wp_posts);
				// $id_producto_empresa = $row_stock["ID_PRODUCTO_EMPRESA"];
				if (isset($row_stock["ID_PRODUCTO_EMPRESA"]) && $row_stock["ID_PRODUCTO_EMPRESA"] !== null) {
					$id_producto_empresa = $row_stock["ID_PRODUCTO_EMPRESA"];
				} else {
					// Handle the error or set a default value
					$id_producto_empresa = 0; // Default value
					// Or: throw new Exception("Invalid ID_PRODUCTO_EMPRESA value"); // Error message
				}
				// $precio_sin_iva = $obj_fd_stock->Extraer_Precio_Producto($id_wp_posts);
				$precio_sin_iva = $row['_regular_price'];
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

				echo "<tr>
						<td>"; echo $id_producto_empresa; echo "<textarea style='width:0; height:0;visibility:hidden;'>$id_producto_empresa</textarea></td>";
						echo "<td>";echo $nombre_producto; echo "<textarea style='width:0; height:0;visibility:hidden;'>$nombre_producto</textarea></td>";
						echo "<td>";echo $cantidad_fardos; echo "<textarea style='width:0; height:0;visibility:hidden;'>$cantidad_fardos</textarea></td>";
						echo "<td>";echo $precio_sin_iva; echo "<textarea style='width:0; height:0;visibility:hidden;'>$precio_sin_iva</textarea></td>";
						echo "<td>";echo $precio_con_iva; echo "<textarea style='width:0; height:0;visibility:hidden;'>$precio_con_iva</textarea></td>";
				echo "</tr>";
				
			}
			echo "</tbody>";
			echo "<tfoot></tfoot>";
			echo "</table>";
		
?>