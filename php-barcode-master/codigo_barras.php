<?php 

	require 'fpdf/fpdf.php';
	//require 'conexion.php';
	include 'barcode.php';
	
	include('../../../plugins/fardos-admin/process/clases.php');


	$pdf = new FPDF();
	$y = $pdf->GetY();
	//$pdf->SetAutoPageBreak(true, 20);
	$pdf->AddPage();
	$res = $obj_fd_stock->Extraer_ID_Productos_Stock();

	$i = 1;
	$x = 20;
	while ($row = $res->fetch_assoc()){

		$code = $row['ID_PRODUCTO_EMPRESA'];

		barcode('codigos/'.$code.'.png', $code, 40, 'horizontal', 'code128b', true);
		
		$pdf->Image('codigos/'.$code.'.png',$x,$y+20,50,0,'PNG');
		
		$y = $y+50;
		if($i%5==0 && $x == 20)
		{
			$y = 0;
			$x = 80;
		}
		else if($i%5==0 && $x == 80)
		{
			$y = 0;
			$x = 140;
		}
		else if($i%5==0 && $x == 140)
		{
			$pdf->AddPage();
			$y = 0;
			$x = 20;
		}
		$i++;

	}
	$pdf->Output();	

?>