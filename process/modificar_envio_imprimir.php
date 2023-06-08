<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


	if($_POST['modificar_band'] == 1)
	{
		echo "<table class='modificar_envio' id='modificar_envio'>
			  <thead>
				<tr class='encabezado'>
					<td class='anchofecha'>Fecha</td>
					<td>Descripción</td>
					<td class='ancho'>Enviado</td>
					<td class='ancho'>Recibido</td>
				</tr>
			  </thead>";

			$obj_fd_envios = new fd_envios();
			$res = $obj_fd_envios->Extraer_Envios();
			$azul = 0;
			$color_tabla = "";
			echo "<tbody>";
			while($row = $res->fetch_assoc())
			{
				if($azul) $color_tabla = "azul";else $color_tabla = "blanco";
				$disabled_enviado = "";
				$disabled_recibido = "";
				$id 		 = $row['ID'];
				$fecha 		 = $row['FECHA'];
				$descripcion = $row['DESCRIPCION'];
				$enviado 	 = $row['ENVIADO']; if($enviado) $enviado = "checked";else $enviado = "";
				$recibido 	 = $row['RECIBIDO']; if($recibido) $recibido = "checked";else $recibido = "";

				if($enviado == "checked" && $recibido == "checked")
				{
					$disabled_enviado = "disabled";
					$disabled_recibido = "disabled";
				}
				else if($enviado == "checked")
				{
					$disabled_enviado = "";
					$disabled_recibido = "";
				}
				else
				{
					$disabled_enviado = ""; 
					$disabled_recibido = "disabled";
				}
				$fecha_v     = explode("-", $fecha);
				$fecha_buscar = $fecha_v[2].$fecha_v[1].$fecha_v[0];
				echo "<tr class='modif_activo' id='modif_id_$id'>
						<td class='anchofecha'><input type='date' id='fecha_$id' value='$fecha' /> <textarea style='width:0; height:0;visibility:hidden;'>$fecha_buscar</textarea></td>
						<td><textarea id='descripcion_$id' style='width:100%;'>".$descripcion."</textarea></td>
						<td class='ancho'><input type='checkbox' class='check_enviado' data-id='$id' id='enviado_$id' $enviado $disabled_enviado /></td>
						<td class='ancho'><input type='checkbox' class='check_recibido' data-id='$id' id='recibido_$id' $recibido $disabled_recibido /></td>";
				echo "</tr>";
	/*
						echo "<td>";echo $row['DESCRIPCION']; echo "</td>";
						echo "<td>"; echo $row['ENVIADO']; echo "</td>";
						echo "<td>"; echo $row['RECIBIDO']; echo "</td>";
	*/

				if($azul) $azul = 0;else $azul = 1;
			}
			echo "</tbody>";
			echo "<tfoot></tfoot>";
			echo "</table>";
			echo "<input type='submit' class='modificar_envio' id='modificar_envios' value='Modificar Envío(s)'>";
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