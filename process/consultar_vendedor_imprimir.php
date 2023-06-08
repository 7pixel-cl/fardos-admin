<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


		echo "<table class='consultar_vendedor' id='consultar_vendedor_tabla'>
			<thead>
			<tr class='encabezado'>
					<td>Nombres</td>
					<td>Apellidos</td>
					<td>Teléfono(s)</td>
					<td>Email</td>
			</tr>
			</thead>";

			$res = $obj_fd_vendedores->Extraer_Vendedores();
			$azul = 0;
			$color_tabla = "";
			echo "<tbody>";
			while($row = $res->fetch_assoc())
			{
				if($azul) $color_tabla = "azul";else $color_tabla = "blanco";
				$id 	   = $row['ID'];
				$nombres   = $row['NOMBRES'];
				$apellidos = $row['APELLIDOS'];
				$telefono  = $row['TELEFONO'];
				$email 	   = $row['EMAIL'];

				echo "<tr class='elim_activo' id='elim_tr_$id'>
						<td>";echo $nombres; echo "<textarea style='width:0; height:0;visibility:hidden;'>$nombres</textarea></td>";
						echo "<td>";echo $apellidos; echo "<textarea style='width:0; height:0;visibility:hidden;'>$apellidos</textarea></td>";
						echo "<td>"; echo $telefono; echo "<textarea style='width:0; height:0;visibility:hidden;'>$telefono</textarea></td>";
						echo "<td>"; echo $email; echo "<textarea style='width:0; height:0;visibility:hidden;'>$email</textarea></td>";
				echo "</tr>";

				if($azul) $azul = 0;else $azul = 1;
			}
			echo "</tbody>";
			echo "<tfoot></tfoot>";
			echo "</table>";
		
?>