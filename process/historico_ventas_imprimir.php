<?php 
	//include('../../../themes/shopperpress/functions.php');
	include('../../../plugins/fardos-admin/process/clases.php');
?>

	<table class="historico_ventas" id="tabla_buscar">
		<tr style="height: 0px;">
			<td></td>
			<td>Fecha Inicio</td>
			<td>Fecha Fin</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
<?php 
$vendedor_buscar = "";
$fecha_inicio = "";
$fecha_fin = "";
$mes_buscar = "";
$id_venta_buscar = ""; 

if(isset($_POST["vendedor_buscar"]))
{
	$vendedor_buscar = $_POST["vendedor_buscar"];
	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_fin = $_POST["fecha_fin"];
	$mes_buscar = $_POST["mes_buscar"];
    $id_venta_buscar = $_POST["id_venta_buscar"];
}
?>
			<td><input type="text" name="vendedor_buscar" id="vendedor_buscar" placeholder="Vendedor..." value="<?php echo $vendedor_buscar; ?>"></td>
			<td><input type="date" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Inicio..." value="<?php echo $fecha_inicio; ?>"></td>
			<td><input type="date" name="fecha_fin" id="fecha_fin" placeholder="Fecha Fin..." value="<?php echo $fecha_fin; ?>"></td>
			<td><input type="text" name="id_venta_buscar" id="id_venta_buscar" placeholder="ID Venta." value="<?php echo $id_venta_buscar; ?>"></td>
            <td><input type="radio" name="mes_buscar" id="ultimos30" value="1" <?php if($mes_buscar == 1) echo "checked"; ?>> Ultimos 30 días</td>
			<td><input type="radio" name="mes_buscar" id="mes_actual" value="2" <?php if($mes_buscar == 2) echo "checked"; ?>> Mes Actual</td>
                     
		</tr>
		<tr style="text-align: center;"><td colspan="5"><input type="submit" name="buscar_filtros" id="buscar_filtros" value="Buscar"></td></tr>
	</table>

	<table class='historico_ventas' id='historico_ventas_tabla'>
		<thead>
		<tr class='encabezado'>
			<td class="ancho">ID VENTA</td>
			<td class='anchofecha'>FECHA</td>
			<td>NOMBRE</td>
			<td class='ancho'>CANTIDAD</td>
			<td class='ancho'>VENDIDO</td>
			<td class='ancho'></td>
		</tr>
		</thead>
<?php 
		$filtros = "";

		if(isset($_POST['vendedor_buscar']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_fin']) || isset($_POST['mes_buscar'])|| isset($_POST['id_venta_buscar']) )
		{
			$fecha_inicio = "";
			$fecha_fin = "";

			if($_POST['vendedor_buscar'])
			{
				$nombre = $_POST['vendedor_buscar'];
				$nombre = str_replace(" ", "%", $nombre);
				$filtros .= " AND CONCAT(NOMBRES,' ', APELLIDOS) LIKE '%$nombre%'";
			}
			if($_POST['fecha_inicio'])
			{
				$fecha_inicio = $_POST['fecha_inicio'];
				$filtros .= " AND FECHA >= '$fecha_inicio'";
			}
                        if($_POST['id_venta_buscar'])
                        {
                                $id_venta_buscar = $_POST['id_venta_buscar'];
                                $filtros .= " AND venta.ID = '$id_venta_buscar'";
                        }

			if($_POST['fecha_fin'])
			{
				$fecha_fin = $_POST['fecha_fin'];

				if($fecha_inicio)
					$filtros .= " AND FECHA BETWEEN '$fecha_inicio' AND '$fecha_fin'";
				else
					$filtros .= " AND FECHA <= '$fecha_fin'";
			}
			if(@$_POST['mes_buscar'])
			{
				$mes_buscar = $_POST['mes_buscar'];

				if($mes_buscar == 2)
				{
					$fecha_actual = $obj_fd_ventas->Extraer_Fecha_Actual();
					$fecha_v = explode("-", $fecha_actual);
					$mes = $fecha_v[1];
					$filtros .= " AND MONTH(FECHA) = '$mes'";
				}
				else
				{
					$filtros .= " AND FECHA BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()";
				}
			}
		}

		$total_fardos = 0;
		$total_vendido = 0;
		$res = $obj_fd_ventas->Extraer_Ventas_Cerradas($filtros);

		echo "<tbody>";
		while($row = $res->fetch_assoc())
		{

			$id_venta 	   = $row['ID_VENTA'];
			$nombre   	   = $row['NOMBRES']." ".$row['APELLIDOS'];
			$fecha 		   = $row['FECHA'];
			$fecha_v       = explode("-", $fecha);
			$fecha_buscar  = $fecha_v[2].$fecha_v[1].$fecha_v[0];

			$res_total = $obj_fd_linea_ventas->Extraer_Suma_Cantidad_Vendido($id_venta);
			$row_total = $res_total->fetch_assoc();

			$cantidad 	   = $row_total['CANTIDAD'];
			$total_fardos  += $cantidad;
			$vendido	   = $row_total['VENDIDO'];
			$total_vendido += $vendido;

			echo "<tr>
					<td class='ancho'>";echo $id_venta; echo "<textarea style='width:0; height:0;visibility:hidden;'>$id_venta</textarea></td>
					<td class='anchofecha'>";echo $fecha; echo "<textarea style='width:0; height:0;visibility:hidden;'>$fecha_buscar</textarea></td>";
					echo "<td>";echo $nombre; echo "<textarea style='width:0; height:0;visibility:hidden;'>$nombre</textarea></td>";
					echo "<td>";echo $cantidad; echo "<textarea style='width:0; height:0;visibility:hidden;'>$cantidad</textarea></td>";
					echo "<td>";echo round($vendido, 0, PHP_ROUND_HALF_DOWN); echo "<textarea style='width:0; height:0;visibility:hidden;'>$vendido</textarea></td>";
					echo "<td class='ancho'><div class='boton_historico_ventas' data-id='$id_venta' data-descripcion='$nombre FECHA: $fecha'>Seleccionar</div></td>";
			echo "</tr>";
			//var_dump($row);
			// die("products_first_ends");
		}
?>
		</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td></td>
				<td><strong>TOTAL</strong></td>
				<td><strong><?php echo $total_fardos; ?></strong></td>
				<td><strong><?php echo round($total_vendido, 0, PHP_ROUND_HALF_DOWN); ?></strong></td>
				<td></td>
			</tr>
		</tfoot>
		</table>
		
