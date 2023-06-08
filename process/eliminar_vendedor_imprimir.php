<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


	if($_POST['eliminar_band'] == 1)
	{
		echo "<table class='eliminar_vendedor' id='eliminar_vendedor_tabla'>
			<thead>
			<tr class='encabezado_rojo'>
					<td>Nombres</td>
					<td>Apellidos</td>
					<td>Teléfono(s)</td>
					<td>Email</td>
				<td class='ancho'>Eliminar?</td>
			</tr>
			</thead>";

			$res = $obj_fd_vendedores->Extraer_Vendedores();
			echo "<tbody>";
			while($row = $res->fetch_assoc())
			{
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
						echo "<td class='ancho'><input type='checkbox' id='elim_$id' value='$id' /></td>";
				echo "</tr>";

			}
			echo "</tbody>";
			echo "<tfoot></tfoot>";
			echo "</table>";
			//echo "<input type='hidden' name='eliminar_band' value='0' />";
			echo "<input type='submit' class='eliminar_vendedor' id='eliminar_vendedor_submit' value='Eliminar Vendedor(es)'>";
	}
	else
	{
		$res = $obj_fd_vendedores->Extraer_Vendedores();
		while($row = $res->fetch_assoc())
		{
			echo $row["ID"]."-";
		}
		//unset($_POST['eliminar_band']);
		//echo "<input type='hidden' name='eliminar_band' value='1' />";
	}
		
?>