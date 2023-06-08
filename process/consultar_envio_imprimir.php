<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


		echo "<table class='consultar_envio' id='consultar_envio'>
			<thead>
			<tr class='encabezado'>
				<td class='anchofecha'>Fecha</td>
				<td>Descripción</td>
				<td class='ancho'>Enviado</td>
				<td class='ancho'>Recibido</td>
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

				echo "<tr>
						<td class='anchofecha'>";echo $fecha; echo "<textarea style='width:0; height:0;visibility:hidden;'>$fecha_buscar</textarea></td>";
						echo "<td>";echo $descripcion; echo "<textarea style='width:0; height:0;visibility:hidden;'>$descripcion</textarea></td>";
						echo "<td class='ancho'>"; if($row['ENVIADO']) echo "SI"; else echo "NO"; "</td>";
						echo "<td class='ancho'>"; if($row['RECIBIDO']) echo "SI"; else echo "NO"; "</td>";
				echo "</tr>";

				if($azul) $azul = 0;else $azul = 1;
			}
			echo "</tbody>";
			echo "<tfoot></tfoot>";
			echo "</table>";
		
?>