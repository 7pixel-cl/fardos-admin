<?php 

	require 'fpdf/fpdf.php';
	//require 'conexion.php';
	include 'barcode.php';
	
	include('../../../plugins/fardos-admin/process/clases.php');


	$pdf = new FPDF();
	//$y = $pdf->GetY();
	//$pdf->SetAutoPageBreak(true, 20);
	$pdf->AddPage();
	
	
	
	$alto = 6;
	$ancho1 = 15;
	$ancho2 = 110;
	$ancho3 = 30;
	$x = array(5, 20, 130, 145, 175);
	$y = 10;
	$pdf->SetFont('Arial','B',10);

	$pdf->SetXY($x[0], $y);
	$pdf->Cell($ancho1,$alto,'CODE',1,1,'C');
	$pdf->SetXY($x[1], $y);
	$pdf->Cell($ancho2,$alto,'PRODUCTO',1,1,'C');
	$pdf->SetXY($x[2], $y);
	$pdf->Cell($ancho1,$alto,'CANT',1,1,'C');
	$pdf->SetXY($x[3], $y);
	$pdf->Cell($ancho3,$alto,'PRECIO S/IVA',1,1,'C');
	$pdf->SetXY($x[4], $y);
	$pdf->Cell($ancho3,$alto,'PRECIO C/IVA',1,1,'C');

	$pdf->SetFont('Arial','',10);

	$res = $obj_fd_stock->Extraer_Productos_Stock_WP();

	
	$i = 0;
	while($row = $res->fetch_assoc())
	{

		$id_wp_posts	 = $row['ID'];
		$nombre_producto = $row['post_title'];
		$num_fardos = $obj_fd_stock->Extraer_Cantidad_Producto($id_wp_posts);
		if($num_fardos>0)
		{
			$id_producto_empresa = $obj_fd_stock->Extraer_ID_EMPRESA($id_wp_posts);
			$precio_sin_iva = $obj_fd_stock->Extraer_Precio_Producto($id_wp_posts);
			$precio_con_iva = $precio_sin_iva + $precio_sin_iva*0.19;
			$precio_con_iva = round($precio_con_iva, 0, PHP_ROUND_HALF_DOWN);
			$precio_sin_iva = round($precio_sin_iva, 0, PHP_ROUND_HALF_DOWN);

			$nombre_producto = iconv('utf-8', 'cp1252', $nombre_producto);

			$y += $alto;
			$pdf->SetXY($x[0], $y);
			$pdf->Cell($ancho1,$alto, $id_producto_empresa,1,1,'C');
			$pdf->SetXY($x[1], $y);
			$pdf->Cell($ancho2,$alto,' '.$nombre_producto,1,1,'L');
			$pdf->SetXY($x[2], $y);
			$pdf->Cell($ancho1,$alto, $num_fardos,1,1,'C');
			$pdf->SetXY($x[3], $y);
			$pdf->Cell($ancho3,$alto, $precio_sin_iva,1,1,'C');
			$pdf->SetXY($x[4], $y);
			$pdf->Cell($ancho3,$alto, $precio_con_iva,1,1,'C');

			$i++;
			if($i%43==0)
			{
				$pdf->AddPage();
				$y = 10;
			}
		}
	}
	

	$pdf->Output();	

?>
