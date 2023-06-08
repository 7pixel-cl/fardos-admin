<?php 
	include('../../../plugins/fardos-admin/process/clases.php'); 

	$id_venta 		   = $_POST['id_venta'];
	$descripcion_venta = $_POST['descripcion_venta'];
?>

<div class="activo anular_venta" id="mensaje_anular_venta">Anular Venta de: <?php echo $descripcion_venta; ?></div>

<input type="hidden" name="id_venta" id="id_venta" value="<?php echo $id_venta; ?>">
<input type="hidden" name="descripcion_venta" id="descripcion_venta" value="<?php echo $descripcion_venta; ?>">

<div id="imprimir_productos_anulados">
	<?php 
	$ids_tabla = "";
	$total_precio_cobrado = 0;
	$total_iva_cobrado = 0;
	$res = $obj_fd_linea_ventas->Extraer_Productos_Linea_Venta($id_venta);
	if($res->num_rows)
	{
	?>
		<table id="tabla_ventas_registradas_anular" class="activo">
			<thead>
				<tr class="encabezado">
					<td>ID PRODUCTO</td>
					<td>PRODUCTO</td>
					<td>CANTIDAD</td>
					<td>PRECIO COBRADO</td>
					<td>IVA COBRADO</td>
				</tr>
			</thead>
			<tbody>
			<?php 
				while($row = $res->fetch_assoc())
				{
			?>
				<tr>
					<td><?php echo $row["ID_PRODUCTO"]; ?></td>
					<td><?php echo $row["PRODUCTO"]; ?></td>
					<td><?php echo $row["CANTIDAD"]; ?></td>
					<td><?php echo $row["PRECIO_COBRADO"]; $total_precio_cobrado += $row["PRECIO_COBRADO"]; ?></td>
					<td><?php echo $row["IVA_COBRADO"]; $total_iva_cobrado += $row["IVA_COBRADO"]; ?></td>
				</tr>
			<?php 
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
				</tr>
			</tfoot>
		</table>
	<?php 
	}
	?>
	<input type="submit" class="activo" name="anular_venta_submit" id="anular_venta_submit" value="Anular Venta">
	<input type="hidden" name="ids_tabla" id="ids_tabla" value="<?php echo $ids_tabla; ?>">
</div>