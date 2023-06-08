<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


	if($_POST['eliminar_band'] == 1)
	{
		echo "<table class='eliminar_envio' id='eliminar_envio'>
			<thead>
			<tr class='encabezado_rojo'>
				<td class='anchofecha'>Fecha</td>
				<td>Descripción</td>
				<td class='ancho'>Enviado</td>
				<td class='ancho'>Recibido</td>
				<td class='ancho'>Eliminar?</td>
			</tr>
			</thead>";

			$res = $obj_fd_envios->Extraer_Envios();
			$azul = 0;
			$color_tabla = "";
			echo "<tbody>";
			while($row = $res->fetch_assoc())
			{
				if($azul) $color_tabla = "azul";else $color_tabla = "blanco";
				$id = $row['ID'];
				$descripcion = $row['DESCRIPCION'];
				$fecha 		 = $row['FECHA'];
				$fecha_v     = explode("-", $fecha);
				$fecha_buscar = $fecha_v[2].$fecha_v[1].$fecha_v[0];

				echo "<tr class='elim_activo' id='elim_tr_$id'>
						<td class='anchofecha'>";echo $fecha; echo "<textarea style='width:0; height:0;visibility:hidden;'>$fecha_buscar</textarea></td>";
						echo "<td>";echo $descripcion; echo "<textarea style='width:0; height:0;visibility:hidden;'>$descripcion</textarea></td>";
						echo "<td class='ancho'>"; if($row['ENVIADO']) echo "SI"; else echo "NO"; "</td>";
						echo "<td class='ancho'>"; if($row['RECIBIDO']) echo "SI"; else echo "NO"; "</td>";
						echo "<td class='ancho'><input type='checkbox' id='elim_$id' value='$id' /></td>";
				echo "</tr>";

				if($azul) $azul = 0;else $azul = 1;
			}
			echo "</tbody>";
			echo "<tfoot></tfoot>";
			echo "</table>";
			//echo "<input type='hidden' name='eliminar_band' value='0' />";
			echo "<input type='submit' class='eliminar_envio' id='eliminar_envios' value='Eliminar Envío(s)'>";
	}
	else
	{
		$res = $obj_fd_envios->Extraer_Envios();
		while($row = $res->fetch_assoc())
		{
			echo $row["ID"]."-";
		}
		//unset($_POST['eliminar_band']);
		//echo "<input type='hidden' name='eliminar_band' value='1' />";
	}
		
?>