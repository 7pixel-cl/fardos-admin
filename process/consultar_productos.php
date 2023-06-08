<?php 
	include('../../../plugins/fardos-admin/process/clases.php'); 

	$id_envio 		   = $_POST['id_envio'];
	$descripcion_envio = $_POST['descripcion_envio'];
?>

<div class="activo" id="mensaje_consultar">Consultar Productos del envío <?php echo $descripcion_envio; ?></div>

<input type="hidden" name="id_envio" id="id_envio" value="<?php echo $id_envio; ?>">
<input type="hidden" name="descripcion_envio" id="descripcion_envio" value="<?php echo $descripcion_envio; ?>">

<div id="imprimir_productos_consultados">
	<?php 
	$ids_tabla = "";
	$res = $obj_fd_productos_envio->Extraer_Productos_Envio($id_envio);
	if($res->num_rows)
	{
	?>
		<table id="tabla_productos_envios_registrados_consultar" class="activo">
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
					<td><?php echo $row["CANTIDAD"]; ?></td>
				</tr>
			<?php 
				}
			?>
			</tbody>
		</table>
	<?php 
	}
	?>
	<input type="hidden" name="ids_tabla" id="ids_tabla" value="<?php echo $ids_tabla; ?>">
</div>