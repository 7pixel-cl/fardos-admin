<?php 
	include('../../../plugins/fardos-admin/process/clases.php'); 

	$id_envio 		   = $_POST['id_envio'];
	$descripcion_envio = $_POST['descripcion_envio'];
?>

<div class="activo" id="mensaje_modificar">Modificar Cantidad de Productos al envío <?php echo $descripcion_envio; ?></div>

<input type="hidden" name="id_envio" id="id_envio" value="<?php echo $id_envio; ?>">
<input type="hidden" name="descripcion_envio" id="descripcion_envio" value="<?php echo $descripcion_envio; ?>">

<div id="imprimir_productos_modificados">
	<?php 
	$res = $obj_fd_productos_envio->Extraer_Productos_Envio($id_envio);
	if($res->num_rows)
	{
	?>
		<table id="tabla_productos_envios_registrados_modificar" class="activo">
			<thead>
				<tr class="encabezado">
					<td>CÓDIGO DE BARRAS</td>
					<td>NOMBRE</td>
					<td>CANTIDAD</td>
				</tr>
			</thead>
			<tbody>
			<?php 
				while($row = $res->fetch_assoc())
				{
			?>
				<tr>
					<td><?php echo $row["CODIGO_BARRA"]; ?></td>
					<td><?php echo $row["NOMBRE"]; ?></td>
					<td><input type="number" name="cantidad_<?php echo $row["ID"]; ?>" id="cantidad_<?php echo $row["ID"]; ?>" class="cantidad" value="<?php echo $row["CANTIDAD"]; ?>"></td>
				</tr>
			<?php 
				}
			?>
			</tbody>
		</table>
	<?php 
	}
	?>
	<input type="submit" class="activo" id="modificar_producto_submit" value="Modificar Producto(s)">
</div>