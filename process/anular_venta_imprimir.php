<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');

?>
	<table class='anular_venta' id='anular_venta_tabla'>
		<thead>
		<tr class='encabezado'>
			<td class="ancho">ID VENTA</td>
			<td class='anchofecha'>FECHA</td>
			<td>NOMBRE</td>
			<td class='ancho'>TELEFONO</td>
			<td class='ancho'>EMAIL</td>
			<td class='ancho'></td>
		</tr>
		</thead>
<?php 
		$res = $obj_fd_ventas->Extraer_Ventas_Cerradas("");
		echo "<tbody>";
		while($row = $res->fetch_assoc())
		{
			$id_venta 	  = $row['ID_VENTA'];
			$nombre   	  = $row['NOMBRES']." ".$row['APELLIDOS'];
			$fecha 		  = $row['FECHA'];
			$fecha_v      = explode("-", $fecha);
			$fecha_buscar = $fecha_v[2].$fecha_v[1].$fecha_v[0];
			$telefono 	  = $row['TELEFONO'];
			$email 		  = $row['EMAIL'];

			echo "<tr>
					<td class='ancho'>";echo $id_venta; echo "<textarea style='width:0; height:0;visibility:hidden;'>$id_venta</textarea></td>
					<td class='anchofecha'>";echo $fecha; echo "<textarea style='width:0; height:0;visibility:hidden;'>$fecha_buscar</textarea></td>";
					echo "<td>";echo $nombre; echo "<textarea style='width:0; height:0;visibility:hidden;'>$nombre</textarea></td>";
					echo "<td>";echo $telefono; echo "<textarea style='width:0; height:0;visibility:hidden;'>$telefono</textarea></td>";
					echo "<td>";echo $email; echo "<textarea style='width:0; height:0;visibility:hidden;'>$email</textarea></td>";
					echo "<td class='ancho'><div class='boton_anular_venta' data-id='$id_venta' data-descripcion='$nombre FECHA: $fecha'>Seleccionar</div></td>";
			echo "</tr>";

		}
		echo "</tbody>";
		echo "<tfoot></tfoot>";
		echo "</table>";
		
?>