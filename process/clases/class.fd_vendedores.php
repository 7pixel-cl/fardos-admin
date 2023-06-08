<?php

class fd_vendedores
{
	var $BD;
	
	function __construct()
	{
		$this->BD = new MySQL_Clase();	
	}
	
	function Registrar_Vendedor($nombre_vendedor, $apellido_vendedor, $telefono_vendedor, $email_vendedor)
	{
		$this->BD->Conectar();
		$consulta="INSERT INTO fd_vendedores(NOMBRES, APELLIDOS, TELEFONO, EMAIL) VALUES('$nombre_vendedor', '$apellido_vendedor', '$telefono_vendedor', '$email_vendedor')";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

	function Extraer_Vendedores()
	{
		$this->BD->Conectar();
		$consulta="SELECT ID, NOMBRES, APELLIDOS, TELEFONO, EMAIL FROM fd_vendedores";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Modificar_Vendedor($id, $nombres, $apellidos, $telefono, $email)
	{
		$this->BD->Conectar();
		$consulta="UPDATE fd_vendedores SET NOMBRES = '$nombres', APELLIDOS = '$apellidos', TELEFONO = '$telefono', EMAIL = '$email' WHERE ID = $id";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Eliminar_Vendedor($id)
	{
		$this->BD->Conectar();
		$consulta="DELETE FROM fd_vendedores WHERE ID = $id";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}


}

?>