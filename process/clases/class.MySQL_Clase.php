<?php
class MySQL_Clase
{
 	 private $conexion;
     private $total_consultas;
	 var $servidor;
	 var $usuario;
	 var $password;
	 var $BaseD;

	function __construct()
	{
/*		
		
		
		$this->servidor = "68.178.143.50";
		$this->usuario = "CONCESIONARIOSBD";
		$this->password = "Vehiculos777!";
		$this->BaseD = "CONCESIONARIOSBD";
*/
		
		/*
		$this->servidor = "mysql";
		$this->usuario = "root";
		$this->password = "18757685";
		$this->BaseD = "fardosde_wpnew";
		*/
		
		
		$this->servidor = "localhost";
		$this->usuario = "root";
		$this->password = "";
		$this->BaseD = "fardos";

	}

	public function Conectar()
	{
		if(!isset($this->conexion))
		{
			$this->conexion = new mysqli($this->servidor,$this->usuario,$this->password, $this->BaseD) or die(mysqli_error());
			// mysql_select_db($this->BaseD,$this->conexion) or die(mysql_error());
			$this->conexion->set_charset("utf8");
			
		}
	}

	public function Query($query)
	{
		$this->total_consultas++;
		var_dump($query);
		$resultado = $this->conexion->query($query);
		print_r($resultado, true);
		
		if(!$resultado)
		{
			echo 'MySQL2 Error: ' . $this->conexion->error;
			exit;
		}
		return $resultado; 
	}

	public function fetch_row($consulta)
	{
		return mysql_fetch_row($consulta);
	}

	public function num_rows($consulta)
	{ 
	  return mysql_num_rows($consulta);
	}

	public function getTotalConsultas()
	{
	  return $this->total_consultas;
	}
	
	public function Desconectar()
	{
		// $this->conexion->close();
	}
	
	public function getLastId()
	{
	  return $this->conexion->insert_id;
	}
}
?>
