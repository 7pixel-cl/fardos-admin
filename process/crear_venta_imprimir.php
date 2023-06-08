<?php 
	include('../../../plugins/fardos-admin/process/clases.php'); 

?>

<div class="activo" id="mensaje_crear_venta">Crear Venta</div>

<?php 
	$res_venta = $obj_fd_ventas->Extraer_Ventas_No_Cerradas();
	while($row_venta = $res_venta->fetch_assoc())
	{
		$obj_fd_linea_ventas->Eliminar_Linea_No_Cerrada($row_venta["ID"]);
		$obj_fd_ventas->Eliminar_Venta_No_Cerrada($row_venta["ID"]);
	}
?>
<table id="tabla_crear_ventas" class="activo">
	<tr>
		<td>Vendedor</td>
		<td>Código de Barras</td>
		<td>Cantidad</td>
		<td></td>
	</tr>
	<tr>
		<td>
			<select name="vendedor_id" id="vendedor_id">
				<option value="0">Seleccione...</option>
				<?php 
					$res = $obj_fd_vendedores->Extraer_Vendedores();
					while($row = $res->fetch_assoc())
					{
				?>
					<option value="<?php echo $row['ID']; ?>"><?php echo $row["NOMBRES"]." ".$row["APELLIDOS"]; ?></option>
				<?php
					}
				?>
			</select>
		</td>
		<td><input type="text" name="codigo_barras" id="codigo_barras" placeholder="Ingrese Código..."></td>
		<td><input type="number" name="cantidad" min="1" id="cantidad" placeholder="Ingrese Cantidad..." value="1"></td>
		<td><input type="submit" class="activo" name="crear_venta_submit" id="crear_venta_submit" value="Aceptar"></td>
	</tr>
</table>

<?php /* ?>
<input type="hidden" name="id_envio" id="id_envio" value="<?php echo $id_envio; ?>">
<input type="hidden" name="descripcion_envio" id="descripcion_envio" value="<?php echo $descripcion_envio; ?>">
<?php */ ?>

<div id="imprimir_productos_agregados">
</div>