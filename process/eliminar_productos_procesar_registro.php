<?php 
	include('../../../plugins/fardos-admin/process/clases.php'); 

	$id_eliminar = $_POST['id_eliminar'];
	$id_envio    = $_POST['id_envio'];
	$ids_tabla = "";

	if($obj_fd_productos_envio->Eliminar_Producto($id_eliminar))
	{
		?>
		<table id="tabla_productos_envios_registrados_eliminar" class="activo">
			<thead>
				<tr class="encabezado">
					<td>CÓDIGO DE BARRAS</td>
					<td>NOMBRE</td>
					<td>CANTIDAD</td>
					<td>ELIMINAR?</td>
				</tr>
			</thead>
			<tbody>
			<?php 
				$res = $obj_fd_productos_envio->Extraer_Productos_Envio($id_envio);
				while($row = $res->fetch_assoc())
				{
			?>
				<tr id="elim_tr_<?php echo $row["ID"]; ?>" class="elim_activo">
					<td><?php echo $row["CODIGO_BARRA"]; ?></td>
					<td><?php echo $row["NOMBRE"]; ?></td>
					<td><?php echo $row["CANTIDAD"]; ?></td>
					<td><input type='checkbox' id='elim_producto_<?php echo $row["ID"]; ?>' value='$id' /></td>
				</tr>
			<?php 
				$ids_tabla .= $row["ID"]."-";
				}
			?>
			</tbody>
		</table>
		<?php
	}
?>

<input type="hidden" name="ids_tabla" id="ids_tabla" value="<?php echo $ids_tabla; ?>">
<input type="hidden" name="id_envio" id="id_envio" value="<?php echo $id_envio; ?>">
<input type="submit" class="activo" id="eliminar_producto_submit" value="Eliminar Producto(s)">
