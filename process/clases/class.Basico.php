<?php

class Telefonos
{
	var $BD;
	
	function __construct()
	{
		$this->BD = new MySQL_Clase();	
	}
	
	function Registrar_Telefono($rif, $id, $descripcion, $numero)
	{
		$this->BD->Conectar();
		$consulta="INSERT INTO TELEFONOS(DIRECCIONES_EMPRESAS_RIF, DIRECCIONES_ID, DESCRIPCION, NUMERO) VALUES('$rif', '$id', '$descripcion', '$numero')";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

	function Extraer_Telefono($rif, $direccion_id)
	{
		$this->BD->Conectar();
		//$consulta="SELECT DESCRIPCION, NUMERO FROM TELEFONOS WHERE DIRECCIONES_EMPRESAS_RIF = '$rif'";
		$consulta = "SELECT DIR.ID DIRECCION_ID, TEL.DESCRIPCION DESCRIPCION, TEL.NUMERO NUMERO 
					 FROM TELEFONOS TEL, DIRECCIONES DIR 
					 WHERE TEL.DIRECCIONES_EMPRESAS_RIF = '$rif' AND DIR.EMPRESAS_RIF = TEL.DIRECCIONES_EMPRESAS_RIF AND				
 					 DIR.ID = TEL.DIRECCIONES_ID
					 AND DIR.ID = $direccion_id";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

}

?>