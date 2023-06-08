<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');


	if($_POST['modificar_band'] == 1)
	{
		echo "<table class='modificar_vendedor' id='modificar_vendedor_tabla'>
			  <thead>
				<tr class='encabezado'>
					<td>Nombres</td>
					<td>Apellidos</td>
					<td>Teléfono(s)</td>
					<td>Email</td>
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

				echo "<tr class='modif_activo' id='modif_id_$id'>
						<td><input type='text' id='nombres_$id' value='$nombres' /><textarea style='width:0; height:0;visibility:hidden;'>".$nombres."</textarea></td>
						<td><input type='text' id='apellidos_$id' value='$apellidos' /><textarea style='width:0; height:0;visibility:hidden;'>".$apellidos."</textarea></td>
						<td><input type='text' id='telefono_$id' value='$telefono' /><textarea style='width:0; height:0;visibility:hidden;'>$telefono</textarea></td>
						<td><input type='email' id='email_$id' value='$email' /><textarea style='width:0; height:0;visibility:hidden;'>$email</textarea></td>";
				echo "</tr>";

			}
			echo "</tbody>";
			echo "<tfoot></tfoot>";
			echo "</table>";
			echo "<input type='submit' class='modificar_vendedor' id='modificar_vendedor_submit' value='Modificar Vendedor(es)'>";
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