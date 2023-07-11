<?php 
	include('../../../plugins/fardos-admin/process/clases.php'); 

	$vendedor 		   = $_POST['vendedor_id'];
	$codigo_barras 	   = $_POST['codigo_barras'];
	$cantidad_fardos   = $_POST['cantidad'];


	$band_crear = 0;
	if(isset($_POST["band_crear"]))
	{
		$band_crear = $_POST["band_crear"];
	}

	if($band_crear == 1)
	{
?>
		<table id="tabla_productos_registrados" class="activo">
			<thead>
				<tr class="encabezado">
					<td style="width: 100px;">ID PRODUCTO</td>
					<td style="width: 400px;">PRODUCTO</td>
					<td style="width: 100px;">CANTIDAD</td>
					<td style="width: 200px;">PRECIO</td>
					<td style="width: 200px;">IVA</td>
					<td style="width: 200px;">TOTAL</td>
				</tr>
			</thead>
			<tbody>
		<?php 
			$id_venta = $_POST["id_venta"];
			$total_precio_cobrado = 0;
			$total_iva_cobrado = 0;
			$res = $obj_fd_linea_ventas->Extraer_Productos_Linea_Venta($id_venta);
			while($row = $res->fetch_assoc())
			{
				$id = $row["ID"];

				if($_POST['fila_elim_'.$id] == 1)
					$obj_fd_linea_ventas->Eliminar_Linea_Venta($id);
				else
				{
					$obj_fd_linea_ventas->Modificar_Linea_Venta($id, $_POST["cantidad_linea_venta".$id], $_POST["precio_cobrado".$id], $_POST["iva_cobrado_hide".$id]);
					$res_modif = $obj_fd_linea_ventas->Extraer_Productos_Linea_Venta_Modificados($id);

					$id_producto_empresa = $_POST["id_producto_empresa_".$id];
					$id_wp = $obj_fd_stock->Extraer_ID_WP($id_producto_empresa);

					$obj_fd_stock->Restar_Cantidad_Producto_WP($id_wp, $_POST["cantidad_linea_venta".$id]);

					$row_modif = $res_modif->fetch_assoc();
		?>
			<tr>
				<td style="width: 100px;">
					<?php echo $row_modif["ID_PRODUCTO"]; ?>
				</td>
				<td style="width: 500px;">
					<?php echo $row_modif["PRODUCTO"]; ?>
				</td>
				<td style="width: 100px;">
					<?php echo $row_modif["CANTIDAD"]; ?>
				</td>
				<td style="width: 200px;">
					<?php echo $row_modif["PRECIO_COBRADO"]; $total_precio_cobrado += $row_modif["PRECIO_COBRADO"]; ?>
				</td>
				<td style="width: 200px;">
					<?php echo $row_modif["IVA_COBRADO"]; $total_iva_cobrado += $row_modif["IVA_COBRADO"]; ?>
				</td>
				<td style="width: 200px;">
					<?php echo ($row_modif["PRECIO_COBRADO"]+$row_modif["IVA_COBRADO"]); ?>
				</td>
			</tr>
		<?php 
					$fecha_cierre = $obj_fd_ventas->Extraer_Fecha_Actual();
					$obj_fd_ventas->Cerrar_Venta($id_venta, $fecha_cierre);
				}
			}
				?>
				</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td><strong>TOTAL</strong></td>
					<td><strong><?php echo $total_precio_cobrado; ?></strong></td>
					<td><strong><?php echo $total_iva_cobrado; ?></strong></td>
					<td><strong><?php echo ($total_precio_cobrado+$total_iva_cobrado); ?></strong></td>
				</tr>
			</tfoot>
			</table>
<?php
	}
	else if($vendedor != 0)
	{
		if($codigo_barras)
		{
			$id_wp = $obj_fd_stock->Extraer_ID_WP($codigo_barras);
			$res = $obj_fd_stock->Extraer_Nombre_Producto($id_wp);
			$res = $res->fetch_assoc();
			$nombre_producto = $res["post_title"];

			if($nombre_producto)
			{
				$id_venta = "";
				if(isset($_POST["id_venta"]))
				{
					$id_venta = $_POST["id_venta"];
				}
				else
				{
					$resultado_id = $obj_fd_ventas->Registrar_Venta_2($vendedor);
					$id_venta = $resultado_id;
				}

				$id_producto = $codigo_barras;
				$producto = $nombre_producto;
				$cantidad = $cantidad_fardos;

				$precio_cobrado = $obj_fd_linea_ventas->Extraer_Precio_Producto($id_wp)*1.19;
				$iva_cobrado = $precio_cobrado*0.19;

				$cantidad_stock = $obj_fd_stock->Extraer_Cantidad_Producto($id_wp);

				if( $cantidad > 0)
				{

					if($obj_fd_linea_ventas->Verificar_Producto_En_Linea_De_Venta($id_producto, $id_venta))
					{
						$obj_fd_linea_ventas->Registrar_Linea_de_Venta($id_venta, $id_producto, $producto, $cantidad, $precio_cobrado, $iva_cobrado);
				?>
				<table id="tabla_productos_registrados" class="activo">
					<thead>
						<tr class="encabezado">
							<td style="width: 100px;">ID PRODUCTO</td>
							<td style="width: 400px;">PRODUCTO</td>
							<td style="width: 100px;">CANTIDAD</td>
							<td style="width: 200px;">PRECIO</td>
							<td style="width: 200px;">IVA</td>
							<td style="width: 200px;">TOTAL</td>
							<td>ELIMINAR?</td>
						</tr>
					</thead>
					<tbody>
				<?php 
					$res = $obj_fd_linea_ventas->Extraer_Productos_Linea_Venta($id_venta);
					while($row = $res->fetch_assoc())
					{
						$id = $row["ID"];
						$id_producto = $row["ID_PRODUCTO"];
						$id_wp = $obj_fd_stock->Extraer_ID_WP($id_producto);
						$cantidad_stock = $obj_fd_stock->Extraer_Cantidad_Producto($id_wp);
				?>
					<tr id="fila<?php echo $id; ?>">
						<td style="width: 100px;">
							<?php echo $row["ID_PRODUCTO"]; ?>
							<input type="hidden" name="id_producto_empresa_<?php echo $id; ?>" id="id_producto_empresa_<?php echo $id; ?>" value="<?php echo $row["ID_PRODUCTO"]; ?>">
						</td>
						<td style="width: 500px;">
							<?php echo $row["PRODUCTO"]; ?>
						</td>
						<td style="width: 100px;">
							<input type="number" class="cantidad_linea_venta" data-id="<?php echo $id; ?>" style="width: 100px;" name="cantidad_linea_venta<?php echo $id; ?>" id="cantidad_linea_venta<?php echo $id; ?>" value="<?php echo $row["CANTIDAD"]; ?>" min="1" max="<?php echo $cantidad_stock; ?>">
							<input type="hidden" name="cantidad_stock<?php echo $id; ?>" id="cantidad_stock<?php echo $id; ?>" value="<?php echo $cantidad_stock; ?>">
						</td>
						<td style="width: 200px;">
							<input type="number" class="precio_cobrado" size="15px" dir="rtl" name="precio_cobrado<?php echo $id; ?>" data-id="<?php echo $id; ?>" id="precio_cobrado<?php echo $id; ?>" value="<?php echo round($row["PRECIO_COBRADO"]*$row["CANTIDAD"], 0, PHP_ROUND_HALF_DOWN); ?>">
							<input type="hidden" name="precio_cobrado_unidad" id="precio_cobrado_unidad<?php echo $id; ?>" value="<?php echo round($row["PRECIO_COBRADO"], 0, PHP_ROUND_HALF_DOWN); ?>">
						</td>
						<td style="width: 200px;">
							<input type="text" readonly class="iva_cobrado" size="15px" dir="rtl" name="iva_cobrado<?php echo $id; ?>" id="iva_cobrado<?php echo $id; ?>" value="<?php echo round($row["IVA_COBRADO"]*$row["CANTIDAD"], 0, PHP_ROUND_HALF_DOWN); ?>">
							<input type="hidden" readonly class="iva_cobrado_hide" name="iva_cobrado_hide<?php echo $id; ?>" id="iva_cobrado_hide<?php echo $id; ?>" value="<?php echo $row["IVA_COBRADO"]*$row["CANTIDAD"]; ?>">
							<input type="hidden" name="iva_cobrado_unidad<?php echo $id; ?>" id="iva_cobrado_unidad<?php echo $id; ?>" value="<?php echo $row["IVA_COBRADO"]; ?>">
							<input type='checkbox' class="sin_iva" data-id='<?php echo $id; ?>' id='sin_iva<?php echo $id; ?>' title="Quitar IVA" />
						</td>
						<td style="width: 200px;" id="total<?php echo $id; ?>">
							<span><?php echo round(($row["PRECIO_COBRADO"]+$row["IVA_COBRADO"])*$row["CANTIDAD"], 0, PHP_ROUND_HALF_DOWN); ?></span>
							<input type="hidden" readonly name="total_hide<?php echo $id; ?>" id="total_hide<?php echo $id; ?>" value="<?php echo (($row["PRECIO_COBRADO"]+$row["IVA_COBRADO"])*$row["CANTIDAD"]); ?>">
							<input type="hidden" name="total_unidad<?php echo $id; ?>" id="total_unidad<?php echo $id; ?>" value="<?php echo ($row["PRECIO_COBRADO"]+$row["IVA_COBRADO"]); ?>">
						</td>
						<td>
							<input type='checkbox' class="elim_producto_venta" data-id='<?php echo $id; ?>' id='elim_producto_venta_<?php echo $id; ?>' value='$id' />
							<input type="hidden" name="fila_elim_<?php echo $id; ?>" id="fila_elim_<?php echo $id; ?>" value="0">
						</td>
					</tr>
				<?php 
					}
						?>
						</tbody>
					</table>
					<input type="hidden" name="id_venta" id="id_venta" value="<?php echo $id_venta; ?>">
					<input type="hidden" name="vendedor_id" id="vendedor_id" value="<?php echo $vendedor; ?>">

					<input type="button" class="activo" name="crear_venta_submit" id="boton_crear_venta" value="Crear Venta">
			<?php
					}
					else
						echo 4;
				}
				else
				{
					if($cantidad <= 0)
						echo 5;
					else
						echo 3;
				}
			}
			else
				echo 1;
		}
		else
		{
			echo 0;
		}
	}
	else
		echo 2;
?>
