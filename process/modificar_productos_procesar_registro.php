<?php 
	include('../../../plugins/fardos-admin/process/clases.php'); 

	$id_envio 		   = $_POST['id_envio'];


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

			$res = $obj_fd_productos_envio->Extraer_Productos_Envio($id_envio);
			while($row = $res->fetch_assoc())
			{
				if(isset($_POST['cantidad_'.$row["ID"]]))
					$res_modif = $obj_fd_productos_envio->Modificar_Producto_Envio($row["ID"], $_POST['cantidad_'.$row["ID"]]);
			}

			$res = $obj_fd_productos_envio->Extraer_Productos_Envio($id_envio);
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
	<input type="submit" class="activo" id="modificar_producto_submit" value="Modificar Producto(s)">
