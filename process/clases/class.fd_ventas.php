<?php

class fd_ventas
{
	var $BD;
	
	function __construct()
	{
		$this->BD = new MySQL_Clase();	
	}
	
	function Registrar_Venta($id_vendedor)
	{
		$this->BD->Conectar();
		$consulta="INSERT INTO fd_ventas(ID_VENDEDOR) VALUES($id_vendedor)";
		$res = $this->BD->Query($consulta) or die(mysql_error());
				
		$this->BD->Desconectar();
		
		
		return $res;
	}
	
	function Registrar_Venta_2($id_vendedor)
	{
		$this->BD->Conectar();
		$consulta="INSERT INTO fd_ventas(ID_VENDEDOR) VALUES($id_vendedor)";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		
		$id_venta = $this->BD->getLastId();
		
		$this->BD->Desconectar();
		
		
		
		return $id_venta;
	}

	function Extraer_Ventas_No_Cerradas()
	{
		$this->BD->Conectar();
		$consulta="SELECT ID FROM fd_ventas WHERE VENTA_CERRADA = 0 AND VENTA_ELIMINADA = 0";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

	function Eliminar_Venta_No_Cerrada($id)
	{
		$this->BD->Conectar();
		$consulta="DELETE FROM fd_ventas WHERE ID = $id";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Extraer_Fecha_Actual()
	{
		$this->BD->Conectar();
		$consulta="SELECT CURDATE() FECHA FROM DUAL";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		$res = $res->fetch_assoc();
		$res = $res["FECHA"];

		return $res;
	}

	function Cerrar_Venta($id, $fecha_cierre)
	{
		$this->BD->Conectar();
		$consulta="UPDATE fd_ventas SET FECHA = '$fecha_cierre', VENTA_CERRADA = 1 WHERE ID = $id";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

	function Extraer_Ventas_Cerradas($filtros)
	{
		$this->BD->Conectar();
		$consulta="SELECT venta.ID ID_VENTA, vendedor.NOMBRES NOMBRES, vendedor.APELLIDOS APELLIDOS, vendedor.TELEFONO TELEFONO, vendedor.EMAIL EMAIL, venta.FECHA FECHA
				   FROM fd_ventas venta, fd_vendedores vendedor
				   WHERE venta.ID_VENDEDOR = vendedor.ID AND venta.VENTA_ELIMINADA = 0 AND venta.VENTA_CERRADA = 1 $filtros";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

	function Eliminar_Venta($id_venta)
	{
		$this->BD->Conectar();
		$consulta="UPDATE fd_ventas SET VENTA_ELIMINADA = 1 WHERE ID = $id_venta";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

}

?>
