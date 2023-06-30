<?php

class fd_linea_ventas
{
	var $BD;
	
	function __construct()
	{
		$this->BD = new MySQL_Clase();	
	}
	
	function Extraer_Precio_Producto($id_wp)
	{
		$this->BD->Conectar();
		$consulta="SELECT meta_value PRECIO FROM syh_postmeta WHERE meta_key = '_price' AND post_id = $id_wp";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		$res = $res->fetch_assoc();
		$res = $res["PRECIO"];

		return $res;
	}

	function Registrar_Linea_de_Venta($id_venta, $id_producto, $producto, $cantidad, $precio_cobrado, $iva_cobrado)
	{
		$this->BD->Conectar();
		$consulta="INSERT INTO fd_linea_ventas(ID_VENTA, ID_PRODUCTO, PRODUCTO, CANTIDAD, PRECIO_COBRADO, IVA_COBRADO) VALUES($id_venta, $id_producto, '$producto', $cantidad, '$precio_cobrado', '$iva_cobrado')";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

	function Extraer_Productos_Linea_Venta($id_venta)
	{
		$this->BD->Conectar();
		$consulta="SELECT ID, ID_PRODUCTO, PRODUCTO, CANTIDAD, PRECIO_COBRADO, IVA_COBRADO FROM fd_linea_ventas WHERE ID_VENTA = $id_venta";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Eliminar_Linea_No_Cerrada($id_venta)
	{
		$this->BD->Conectar();
		$consulta="DELETE FROM fd_linea_ventas WHERE ID_VENTA = $id_venta";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Modificar_Linea_Venta($id, $cantidad_linea_venta, $precio_cobrado, $iva_cobrado)
	{
		$this->BD->Conectar();
		$consulta="UPDATE fd_linea_ventas SET CANTIDAD = $cantidad_linea_venta, 
											  PRECIO_COBRADO = '$precio_cobrado',
											  IVA_COBRADO = $iva_cobrado
										  WHERE ID = $id";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Extraer_Suma_Cantidad_Vendido($id_venta)
	{
		$this->BD->Conectar();
		$consulta="SELECT SUM(CANTIDAD) CANTIDAD, SUM(PRECIO_COBRADO+IVA_COBRADO) VENDIDO FROM fd_linea_ventas WHERE ID_VENTA = $id_venta";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Extraer_Productos_Linea_Venta_Modificados($id)
	{
		$this->BD->Conectar();
		$consulta="SELECT ID_PRODUCTO, PRODUCTO, CANTIDAD, PRECIO_COBRADO, IVA_COBRADO FROM fd_linea_ventas WHERE ID = $id";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Eliminar_Linea_Venta($id)
	{
		$this->BD->Conectar();
		$consulta="DELETE FROM fd_linea_ventas WHERE ID = $id";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Verificar_Producto_En_Linea_De_Venta($id_producto, $id_venta)
	{
		$this->BD->Conectar();
		$consulta="SELECT CANTIDAD FROM fd_linea_ventas WHERE ID_PRODUCTO = $id_producto AND ID_VENTA = $id_venta";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		if($res->num_rows)
			$res = 0;
		else
			$res = 1;

		return $res;
	}

}

?>