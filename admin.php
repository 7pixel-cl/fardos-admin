<!--<meta http-equiv="Content-type" content="text/html; charset=utf-8" />-->
<!--<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">-->
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/fardos-admin/estilos.css">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/fardos-admin/DataTables/datatables.min.css">

<?php 
//header("Content-Type: text/html;charset=utf-8");
?>



<div id="menu">
<div class="inicio" id="envios">Envíos</div>
<div class="inicio" id="productos">Productos</div>
<div class="inicio" id="stock">Stock</div>
<div class="inicio" id="vendedores">Vendedores</div>
<div class="inicio" id="ventas">Ventas</div>
</div>
<?php 
//*************************************************************************************************************
//												SECCIÓN ENVÍOS
//*************************************************************************************************************
?>
	<div class="envios boton_opciones crear" id="crear">Crear Envío</div>
	<div class="envios boton_opciones modificar" id="modificar">Modificar Envío(s)</div>
	<div class="envios boton_opciones eliminar" id="eliminar">Eliminar Envío(s)</div>
	<div class="envios boton_opciones consultar" id="consultar">Consultar Envío(s)</div>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/crear_envio.php" method="post" id="crear_form">
	<div class="mensaje_crear_registro"></div>
	<span class="registro_envio" id="label_mensaje_registro">Crear un Envío</span>
	<span class="registro_envio" id="label_crear_registro">Fecha:</span>
	<input type="date" name="fecha_registro" class="registro_envio" id="fecha_registro">
	<span class="registro_envio" id="label_descripcion_registro">Descripción:</span>
	<textarea name="descripcion_registro" class="registro_envio" id="descripcion_registro"></textarea>
	<input type="submit" class="registro_envio" id="crear_registro" value="Crear" />
	<div class="registro_envio" id="crear_regresar">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/modificar_envio_imprimir.php" method="post" id="modificar_form">
	<input type="hidden" name="procesar_modificacion" id="procesar_modificacion" value="<?php echo plugins_url(); ?>/fardos-admin/process/modificar_envio.php">
	<div class="mensaje_modificar_envio"></div>
	<span class="modificar_envio" id="label_mensaje">Modificar Envío(s)</span>
	<div id="impresion_tabla_modificar"></div>
	<div class="modificar_envio" id="modificar_regresar">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/eliminar_envio_imprimir.php" method="post" id="eliminar_form">
	<input type="hidden" name="procesar_eliminacion" id="procesar_eliminacion" value="<?php echo plugins_url(); ?>/fardos-admin/process/eliminar_envio.php">
	<div class="mensaje_eliminar_envio"></div>
	<span class="eliminar_envio" id="label_mensaje">Eliminar Envío(s)</span>
	<div id="impresion_tabla_eliminar"></div>
	<div class="eliminar_envio" id="eliminar_regresar">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/consultar_envio_imprimir.php" method="post" id="consultar_form">
	<span class="consultar_envio" id="label_mensaje">Consultar Envío(s)</span>
	<div id="impresion_tabla_consultar"></div>
	<div class="consultar_envio" id="consultar_regresar">Regresar</div>
</form>


<?php 
//*************************************************************************************************************
//												SECCIÓN PRODUCTOS
//*************************************************************************************************************
?>
	<div class="productos boton_opciones crear" id="crear_productos">Añadir Producto a Envío</div>
	<div class="productos boton_opciones modificar" id="modificar_productos">Modificar Cantidad de productos en Envíos</div>
	<div class="productos boton_opciones eliminar" id="eliminar_productos">Eliminar Producto de Envío</div>
	<div class="productos boton_opciones consultar" id="consultar_productos">Consultar Productos de Envíos</div>
	<div class="productos boton_opciones generar" id="generar_codigos">Generar Códigos de Barra en PDF</div>
	<div class="productos boton_opciones generar_img" id="generar_codigos_img">Generar Códigos de Barra en Imágenes</div>

	<input type="hidden" name="generar_codigos_barra" id="generar_codigos_barra" value="<?php echo plugins_url(); ?>/fardos-admin/php-barcode-master/codigo_barras.php">
	<input type="hidden" name="generar_codigos_barra_img" id="generar_codigos_barra_img" value="<?php echo plugins_url(); ?>/fardos-admin/php-barcode-master/codigos/">

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/anadir_producto_imprimir.php" method="post" id="anadir_producto_form">
	<input type="hidden" name="procesar_anadir" id="procesar_anadir" value="<?php echo plugins_url(); ?>/fardos-admin/process/anadir_productos.php">
<input type="hidden" name="procesar_anadir_registro" id="procesar_anadir_registro" value="<?php echo plugins_url(); ?>/fardos-admin/process/anadir_productos_procesar_registro.php">
	<div class="mensaje_anadir_producto"></div>
	<span class="anadir_producto" id="label_mensaje">Añadir Productos a Envío</span>
	<div id="impresion_tabla_anadir_producto"></div>
	<div class="anadir_producto" id="anadir_regresar_producto">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/modificar_producto_imprimir.php" method="post" id="modificar_productos_form">
	<input type="hidden" name="procesar_modificar" id="procesar_modificar" value="<?php echo plugins_url(); ?>/fardos-admin/process/modificar_productos.php">
	<input type="hidden" name="procesar_modificar_registro" id="procesar_modificar_registro" value="<?php echo plugins_url(); ?>/fardos-admin/process/modificar_productos_procesar_registro.php">
	<div class="mensaje_modificar_producto"></div>
	<span class="modificar_producto" id="label_mensaje">Modificar Productos de Envío(s)</span>
	<div id="impresion_tabla_modificar_producto"></div>
	<div class="modificar_producto" id="modificar_regresar_producto">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/eliminar_producto_imprimir.php" method="post" id="eliminar_productos_form">
	<input type="hidden" name="procesar_eliminar" id="procesar_eliminar" value="<?php echo plugins_url(); ?>/fardos-admin/process/eliminar_productos.php">
	<input type="hidden" name="procesar_eliminar_registro" id="procesar_eliminar_registro" value="<?php echo plugins_url(); ?>/fardos-admin/process/eliminar_productos_procesar_registro.php">
	<div class="mensaje_eliminar_producto"></div>
	<span class="eliminar_producto" id="label_mensaje">Eliminar Productos de Envío(s)</span>
	<div id="impresion_tabla_eliminar_producto"></div>
	<div class="eliminar_producto" id="eliminar_regresar_producto">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/consultar_producto_imprimir.php" method="post" id="consultar_productos_form">
	<input type="hidden" name="procesar_consultar" id="procesar_consultar" value="<?php echo plugins_url(); ?>/fardos-admin/process/consultar_productos.php">
	<span class="consultar_producto" id="label_mensaje">Consultar Productos de Envío(s)</span>
	<div id="impresion_tabla_consultar_producto"></div>
	<div class="consultar_producto" id="consultar_regresar_producto">Regresar</div>
</form>

<?php 
//*************************************************************************************************************
//												SECCIÓN STOCK
//*************************************************************************************************************
?>
	<div class="stock boton_opciones crear" id="mostrar_stock">Mostrar Stock Actual</div>
	<div class="stock boton_opciones modificar" id="modificar_stock">Modificar Stock</div>
	<div class="stock boton_opciones generar" id="generar_stock">Generar Listado Stock Actual</div>

	<input type="hidden" name="generar_stock_actual" id="generar_stock_actual" value="<?php echo plugins_url(); ?>/fardos-admin/php-barcode-master/listado_stock.php">


	<form action="<?php echo plugins_url(); ?>/fardos-admin/process/consultar_stock_imprimir.php" method="post" id="consultar_stock_form">
		<span class="consultar_stock" id="label_mensaje">Consultar Stock Actual</span>
		<div id="impresion_tabla_consultar_stock"></div>
		<div class="consultar_stock" id="consultar_regresar_stock">Regresar</div>
	</form>

	<form action="<?php echo plugins_url(); ?>/fardos-admin/process/modificar_stock_imprimir.php" method="post" id="modificar_stock_form">
		<input type="hidden" name="procesar_modificacion" id="procesar_modificacion" value="<?php echo plugins_url(); ?>/fardos-admin/process/modificar_stock.php">
		<div class="mensaje_modificar_stock"></div>
		<span class="modificar_stock" id="label_mensaje">Modificar Stock</span>
		<div id="impresion_tabla_modificar_stock"></div>
		<div class="modificar_stock" id="modificar_regresar_stock">Regresar</div>
	</form>

<?php 
//*************************************************************************************************************
//												SECCIÓN VENDEDORES
//*************************************************************************************************************
?>
	<div class="vendedores boton_opciones crear" id="crear_vendedor">Crear Vendedor</div>
	<div class="vendedores boton_opciones modificar" id="modificar_vendedor">Modificar Vendedor(es)</div>
	<div class="vendedores boton_opciones eliminar" id="eliminar_vendedor">Eliminar Vendedor(es)</div>
	<div class="vendedores boton_opciones consultar" id="consultar_vendedor">Consultar Vendedor(es)</div>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/crear_vendedor.php" method="post" id="crear_vendedor_form">
	<div class="mensaje_crear_registro_vendedor"></div>
	<span class="registro_vendedor" id="label_mensaje_registro">Crear un Vendedor</span>
	<span class="registro_vendedor">Nombre(s):</span>
	<input type="text" name="nombre_vendedor" class="registro_vendedor" id="nombre_vendedor">
	<span class="registro_vendedor">Apellido(s):</span>
	<input type="text" name="apellido_vendedor" class="registro_vendedor" id="apellido_vendedor">
	<span class="registro_vendedor">Teléfono:</span>
	<input type="text" name="telefono_vendedor" class="registro_vendedor" id="telefono_vendedor">
	<span class="registro_vendedor">Email:</span>
	<input type="email" name="email_vendedor" class="registro_vendedor" id="email_vendedor">
	<input type="submit" class="registro_vendedor" id="crear_registro_vendedor" value="Crear Vendedor" />
	<div class="registro_vendedor" id="crear_regresar_vendedor">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/modificar_vendedor_imprimir.php" method="post" id="modificar_vendedor_form">
	<input type="hidden" name="procesar_modificacion" id="procesar_modificacion" value="<?php echo plugins_url(); ?>/fardos-admin/process/modificar_vendedor.php">
	<div class="mensaje_modificar_vendedor"></div>
	<span class="modificar_vendedor" id="label_mensaje">Modificar Vendedor(es)</span>
	<div id="impresion_tabla_modificar_vendedor"></div>
	<div class="modificar_vendedor" id="modificar_regresar_vendedor">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/eliminar_vendedor_imprimir.php" method="post" id="eliminar_vendedor_form">
	<input type="hidden" name="procesar_eliminacion" id="procesar_eliminacion" value="<?php echo plugins_url(); ?>/fardos-admin/process/eliminar_vendedor.php">
	<div class="mensaje_eliminar_vendedor"></div>
	<span class="eliminar_vendedor" id="label_mensaje">Eliminar Vendedor(es)</span>
	<div id="impresion_tabla_eliminar_vendedor"></div>
	<div class="eliminar_vendedor" id="eliminar_regresar_vendedor">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/consultar_vendedor_imprimir.php" method="post" id="consultar_vendedor_form">
	<span class="consultar_vendedor" id="label_mensaje">Consultar Vendedor(es)</span>
	<div id="impresion_tabla_consultar_vendedor"></div>
	<div class="consultar_vendedor" id="consultar_regresar_vendedor">Regresar</div>
</form>

<?php
//*************************************************************************************************************
//												SECCIÓN VENTAS
//*************************************************************************************************************
?>
	<div class="ventas boton_opciones crear" id="crear_venta">Crear Venta</div>
	<div class="ventas boton_opciones modificar" id="anular_venta">Anular Venta</div>
	<div class="ventas boton_opciones consultar" id="historico_ventas">Histórico de Ventas</div>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/crear_venta_imprimir.php" method="post" id="crear_venta_form">
<input type="hidden" name="procesar_anadir_registro" id="procesar_crear_venta_registro" value="<?php echo plugins_url(); ?>/fardos-admin/process/crear_venta_procesar_registro.php">
	<div class="mensaje_crear_venta"></div>
	<input type="hidden" name="band_crear" id="band_crear" value="0">
	<div id="impresion_tabla_crear_venta"></div>
	<div class="crear_venta" id="crear_venta_regresar">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/anular_venta_imprimir.php" method="post" id="anular_venta_form">
	<input type="hidden" name="procesar_anular_venta" id="procesar_anular_venta" value="<?php echo plugins_url(); ?>/fardos-admin/process/anular_venta.php">
	<input type="hidden" name="procesar_anular_venta_eliminar" id="procesar_anular_venta_eliminar" value="<?php echo plugins_url(); ?>/fardos-admin/process/anular_venta_procesar.php">
	<div class="mensaje_anular_venta"></div>
	<span class="anular_venta" id="label_mensaje">Anular Venta</span>
	<div id="impresion_tabla_anular_venta"></div>
	<div class="anular_venta" id="anular_venta_regresar">Regresar</div>
</form>

<form action="<?php echo plugins_url(); ?>/fardos-admin/process/historico_ventas_imprimir.php" method="post" id="historico_ventas_form">
   <input type="hidden" name="procesar_historico_ventas" id="procesar_historico_ventas" value="<?php echo plugins_url(); ?>/fardos-admin/process/historico_ventas.php">
   <span class="historico_ventas" id="label_mensaje">Histórico de Ventas Realizadas</span>
   <div id="impresion_tabla_historico_ventas"></div>
   <div class="historico_ventas" id="historico_ventas_regresar">Regresar</div>
   <div class="historico_ventas" id="regresar_historico">Regresar Búsqueda</div>

</form>



<?php
//*************************************************************************************************************
//*************************************************************************************************************
//************************************************* SCRIPTS ***************************************************
//*************************************************************************************************************
//*************************************************************************************************************
?>
<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>-->
<script src="<?php echo plugins_url(); ?>/fardos-admin/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo plugins_url(); ?>/fardos-admin/DataTables/datatables.min.js"></script>
<script src="<?php echo plugins_url(); ?>/fardos-admin/js/main_envios.js"></script>
<script src="<?php echo plugins_url(); ?>/fardos-admin/js/main_vendedores.js"></script>
<script src="<?php echo plugins_url(); ?>/fardos-admin/js/main_productos.js"></script>
<script src="<?php echo plugins_url(); ?>/fardos-admin/js/main_stock.js"></script>
<script src="<?php echo plugins_url(); ?>/fardos-admin/js/main_ventas.js"></script>
