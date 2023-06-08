<?php

class fd_stock
{
	var $BD;
	
	function __construct()
	{
		$this->BD = new MySQL_Clase();	
	}

	function Extraer_Productos_Stock_WP()
	{
		$this->BD->Conectar();
		$consulta="SELECT ID, post_title NOMBRE_PRODUCTO FROM wp_posts WHERE post_type = 'post' ORDER BY post_title";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

	function Extraer_ID_WP($id_producto_empresa)
	{
		$this->BD->Conectar();
		$consulta="SELECT ID_WP_POSTS FROM fd_stock WHERE ID_PRODUCTO_EMPRESA = $id_producto_empresa";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		$res = $res->fetch_assoc();
		$res = $res["ID_WP_POSTS"];

		return $res;
	}

	function Extraer_ID_EMPRESA($id_wp_posts)
	{
		$this->BD->Conectar();
		$consulta="SELECT ID_PRODUCTO_EMPRESA FROM fd_stock WHERE ID_WP_POSTS = $id_wp_posts";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		$res = $res->fetch_assoc();
		$res = $res["ID_PRODUCTO_EMPRESA"];

		return $res;
	}

	function Extraer_Precio_Producto($id_wp)
	{
		$this->BD->Conectar();
		$consulta="SELECT meta_value PRECIO FROM wp_postmeta WHERE meta_key = 'price' AND post_id = $id_wp";
		$res = $this->BD->Query($consulta) or die(mysql_error());		

		$res = $res->fetch_assoc();
		if(isset($res["PRECIO"])){
			$res = $res["PRECIO"];
		}
		else{
			$res = 0;
		}

		$this->BD->Desconectar();

		return $res;
	}

	function Extraer_Cantidad_Producto($id_wp)
	{
		$this->BD->Conectar();
		$consulta="SELECT meta_value CANTIDAD FROM wp_postmeta WHERE meta_key = 'qty' AND post_id = $id_wp";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		if($res->num_rows)
		{
			$res = $res->fetch_assoc();
			$res = $res["CANTIDAD"];
		}
		else
			$res = 0;

		return $res;
	}

	function Verificar_ID_WP_POST($id_wp_posts)
	{
		$this->BD->Conectar();
		$consulta="SELECT * FROM fd_stock WHERE ID_WP_POSTS = $id_wp_posts";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		
		
		$this->BD->Desconectar();
		
		if($res->num_rows == 0)
			$res = 1;
		else
			$res = 0;
		
		

		return $res;
	}

	function Insertar_Producto_Stock($id_wp_posts, $id_producto_empresa, $kilos_totales)
	{
		$this->BD->Conectar();
		$consulta="INSERT INTO fd_stock(ID_WP_POSTS, ID_PRODUCTO_EMPRESA, KILOS_TOTALES) VALUES($id_wp_posts, '$id_producto_empresa', $kilos_totales)";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();
		
		return $res;
	}

	function Insertar_Producto_Stock_WP($id_wp, $cantidad)
	{
		$this->BD->Conectar();
		$consulta="INSERT INTO wp_postmeta(post_id, meta_key, meta_value) VALUES($id_wp, 'qty', $cantidad)";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Verificar_Producto_Stock_WP($id_wp)
	{
		$this->BD->Conectar();
		$consulta="SELECT * FROM wp_postmeta WHERE post_id = $id_wp AND meta_key = 'qty'";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		if($res->num_rows)
			$res = 1;
		else
			$res = 0;

		return $res;
	}

	function Extraer_Nombre_Producto($id_wp)
	{
		$this->BD->Conectar();
		$consulta="SELECT ID, post_title NOMBRE_PRODUCTO FROM wp_posts WHERE post_type = 'post' AND ID = $id_wp";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Extraer_Producto_Stock($id)
	{
		$this->BD->Conectar();
		$consulta="SELECT ID_WP_POSTS, ID_PRODUCTO_EMPRESA, KILOS_TOTALES FROM fd_stock WHERE ID_WP_POSTS = $id LIMIT 1";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}
	

	function Extraer_Productos_Stock()
	{
		$this->BD->Conectar();
		$consulta="SELECT ID, ID_WP_POSTS, ID_PRODUCTO_EMPRESA, KILOS_TOTALES FROM fd_stock";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Extraer_ID_Productos_Stock()
	{
		$this->BD->Conectar();
		$consulta="SELECT ID_PRODUCTO_EMPRESA FROM fd_stock WHERE ID_PRODUCTO_EMPRESA <> 0";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Modificar_Productos_Stock($id, $id_producto_empresa, $kilos)
	{
		$this->BD->Conectar();
		$consulta="UPDATE fd_stock SET ID_PRODUCTO_EMPRESA = $id_producto_empresa, KILOS_TOTALES = $kilos WHERE ID_WP_POSTS = $id";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

	function Aumentar_Cantidad_Producto_WP($id_wp, $cantidad_fardos)
	{
		$this->BD->Conectar();
		$consulta="UPDATE wp_postmeta SET meta_value = meta_value+$cantidad_fardos WHERE meta_key = 'qty' AND post_id = $id_wp";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}


	function Restar_Cantidad_Producto_WP($id_wp, $cantidad_fardos)
	{
		$this->BD->Conectar();
		$consulta="UPDATE wp_postmeta SET meta_value = meta_value-$cantidad_fardos WHERE meta_key = 'qty' AND post_id = $id_wp";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}


	function Modificar_Cantidad_Producto($id_wp, $cantidad_fardos)
	{
		$this->BD->Conectar();
		$consulta="UPDATE wp_postmeta SET meta_value = $cantidad_fardos WHERE meta_key = 'qty' AND post_id = $id_wp";
		$res = $this->BD->Query($consulta) or die(mysql_error());
		$this->BD->Desconectar();

		return $res;
	}

}

?>