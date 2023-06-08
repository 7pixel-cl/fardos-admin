<?php 

	require 'fpdf/fpdf.php';
	//require 'conexion.php';
	include 'barcode.php';
	
	include('../../../plugins/fardos-admin/process/clases.php');


	$pdf = new FPDF();
	$y = $pdf->GetY();
	//$pdf->SetAutoPageBreak(true, 20);
	$pdf->AddPage();
	$res = $obj_fd_productos_envio->Extraer_ID_Productos();

	$i = 1;
	$x = 20;
	while ($row = $res->fetch_assoc()){

		$code = $row['ID'];

		barcode('codigos/'.$code.'.png', $code, 20, 'horizontal', 'code128', true);
		
		$pdf->Image('codigos/'.$code.'.png',$x,$y+20,50,0,'PNG');
		
		$y = $y+30;
		if($i%8==0 && $x == 20)
		{
			$y = 0;
			$x = 80;
		}
		else if($i%8==0 && $x == 80)
		{
			$y = 0;
			$x = 140;
		}
		else if($i%8==0 && $x == 140)
		{
			$pdf->AddPage();
			$y = 0;
			$x = 20;
		}
		$i++;

	}
	$pdf->Output();	

?>