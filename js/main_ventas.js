$(function()
{
/*
	$("#envios").click(function(){

	});
*/
	$("#ventas").click(function(){
		$(".activo").fadeOut(0);
		$(".activo").removeClass("activo");
		$(".ventas").fadeIn(300);
		$(".ventas").addClass("activo");
	});

	$("#crear_venta").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".crear_venta, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#crear_venta_regresar, #crear_venta_form #label_mensaje").fadeIn(300);
		$("#crear_venta_form #label_mensaje").css("display", "block");

		var pet = $("#crear_venta_form").attr("action");

		var met = $("#crear_venta_form").attr("method");

			var ajaxRequest;
			//var info = $("#crear_venta_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met
	            //data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_crear_venta").html(response);
		     	$('#tabla_productos_registrados').DataTable();
				$(".crear_venta, #crear_venta_form .dataTables_length, #crear_venta_form .dataTables_filter, #crear_venta_form .dataTables_info, #crear_venta_form .dataTables_paginate").addClass("activo");
		        console.log('Submitted successfully');

		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#crear_venta_form").submit(function(e){
		e.preventDefault();

		var pet = $("#crear_venta_form").attr("action");

		var met = $("#crear_venta_form").attr("method");

		var ajaxRequest;
		var info = $("#crear_venta_form").serialize();

			ajaxRequest= $.ajax({
	            url: $("#crear_venta_form #procesar_crear_venta_registro").val(),
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log("RESPONSE = "+response);
		     	$(".mensaje_crear_venta").fadeIn(300);
		     	$(".mensaje_crear_venta").addClass("activo");
	     		$("#codigo_barras").val("");
				$("#cantidad").val("1");
		     	if(response == 0)
		     	{
					$(".mensaje_crear_venta").removeClass("correcto");
					$(".mensaje_crear_venta").addClass("incorrecto");
					$(".mensaje_crear_venta").text("No se agregó el Producto, debe colocar un código de barras");
				}
				else if(response == 1)
				{
					$(".mensaje_crear_venta").removeClass("correcto");
					$(".mensaje_crear_venta").addClass("incorrecto");
					$(".mensaje_crear_venta").text("El producto no existe");
				}
				else if(response == 2)
				{
					$(".mensaje_crear_venta").removeClass("correcto");
					$(".mensaje_crear_venta").addClass("incorrecto");
					$(".mensaje_crear_venta").text("No se seleccionó al Vendedor");
				}
				else if(response == 3)
				{
					$(".mensaje_crear_venta").removeClass("correcto");
					$(".mensaje_crear_venta").addClass("incorrecto");
					$(".mensaje_crear_venta").text("La cantidad puesta es mayor a la cantidad que hay en el stock");
				}
				else if(response == 4)
				{
					$(".mensaje_crear_venta").removeClass("correcto");
					$(".mensaje_crear_venta").addClass("incorrecto");
					$(".mensaje_crear_venta").text("El producto ya existe en la linea de ventas");
				}
				else if(response == 5)
				{
					$(".mensaje_crear_venta").removeClass("correcto");
					$(".mensaje_crear_venta").addClass("incorrecto");
					$(".mensaje_crear_venta").text("No puede vender una cantidad menor o igual que Cero");
				}
				else
				{
			     	$("#imprimir_productos_agregados").html(response);
			     	$("#tabla_productos_registrados").DataTable();
			     	$("select#vendedor_id").attr("disabled", "disabled");
					$(".crear_venta, #crear_venta_form .dataTables_length, #crear_venta_form .dataTables_filter, #crear_venta_form .dataTables_info, #crear_venta_form .dataTables_paginate").addClass("activo");

					$(".mensaje_crear_venta").removeClass("incorrecto");
					$(".mensaje_crear_venta").addClass("correcto");
					console.log("BAND CREAR = "+$("#band_crear").val());
					if($("#band_crear").val() == 1)
					{
						$(".mensaje_crear_venta").text("Venta Creada Correctamente");
						$("#band_crear").val("0");
					}
					else
						$(".mensaje_crear_venta").text("Producto creado correctamente");
						

					$(".sin_iva").click(function(){
						var id = $(this).data("id");
						var cantidad = $("#cantidad_linea_venta"+id).val();

						if($(this).is(":checked"))
						{
							$("#iva_cobrado"+id).val(0);
							$("#iva_cobrado_hide"+id).val(0);

							var valor = (parseFloat($("#precio_cobrado_unidad"+id).val()))*cantidad;
							$("#total"+id+" span").text(valor.toFixed(0));
							$("#total_hide"+id).val(valor.toFixed(2));
						}
						else
						{
							var valor = $("#precio_cobrado_unidad"+id).val()*cantidad;
							$("#precio_cobrado"+id).val(valor.toFixed(0));

							var valor = $("#iva_cobrado_unidad"+id).val()*cantidad;
							$("#iva_cobrado"+id).val(valor.toFixed(0));
							$("#iva_cobrado_hide"+id).val(valor.toFixed(2));

							var valor = (parseFloat($("#precio_cobrado_unidad"+id).val())+parseFloat($("#iva_cobrado_unidad"+id).val()))*cantidad;
							$("#total"+id+" span").text(valor.toFixed(0));
							$("#total_hide"+id).val(valor.toFixed(2));
						}
					});


					$(".cantidad_linea_venta").change(function(){
						var id = $(this).data("id");
						var cantidad = $(this).val();
//						var cantidad_stock = $("#cantidad_stock"+id).val();

//						if(cantidad <= cantidad_stock)
//						{
						var valor = $("#precio_cobrado_unidad"+id).val()*cantidad;
						$("#precio_cobrado"+id).val(valor.toFixed(0));

						var valor_iva = $("#iva_cobrado_unidad"+id).val()*cantidad;
						var valor_iva_unidad = $("#iva_cobrado_unidad"+id).val();
						if($("#sin_iva"+id).is(":checked"))
						{
							valor_iva = 0;
							valor_iva_unidad = 0;
						}
						$("#iva_cobrado"+id).val(valor_iva.toFixed(0));
						$("#iva_cobrado_hide"+id).val(valor_iva.toFixed(2));

						var valor = (parseFloat($("#precio_cobrado_unidad"+id).val())+parseFloat(valor_iva_unidad))*cantidad;
						$("#total"+id+" span").text(valor.toFixed(0));
						$("#total_hide"+id).val(valor.toFixed(2));
//						}
					});

					$(".cantidad_linea_venta").keydown(function(){
						return false;
					});

					$(".precio_cobrado").keyup(function(){
						var id = $(this).data("id");
						var valor = $(this).val()*0.19;
						$("#iva_cobrado"+id).val(valor.toFixed(0));
						$("#iva_cobrado_hide"+id).val(valor.toFixed(2));
						var valor = parseFloat($(this).val())+parseFloat($(this).val()*0.19);
						$("#total"+id+" span").text(valor.toFixed(0));
						$("#total_hide"+id).val(valor.toFixed(2));
					});

					$(".elim_producto_venta").click(function(){
						var id = $(this).data("id");
						$("#fila"+id).slideUp(50);
						$("#fila_elim_"+id).val("1");
					});

					$("#boton_crear_venta").click(function(){
						$("#band_crear").val("1");
						$("#crear_venta_form").submit();
					});
				}
				$(".mensaje_crear_venta").fadeOut(5000);
			});

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });
	});


	$("#anular_venta").click(function(){

		$(".anular_venta, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#anular_venta_regresar, #anular_venta_form #label_mensaje").fadeIn(300);
		$("#anular_venta_form #label_mensaje").css("display", "block");

		var pet = $("#anular_venta_form").attr("action");

		var met = $("#anular_venta_form").attr("method");

			var ajaxRequest;
			var info = $("#anular_venta_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_anular_venta").html(response);
		     	$('#anular_venta_tabla').DataTable();
				$(".anular_venta, #anular_venta_form .dataTables_length, #anular_venta_form .dataTables_filter, #anular_venta_form .dataTables_info, #anular_venta_form .dataTables_paginate").addClass("activo");

				$(".boton_anular_venta").click(function(){
					console.log("ID = "+$(this).data("id"));
					$("#anular_venta_regresar").removeClass("activo");
					$(".activo").fadeOut(100);
					$(".activo").removeClass("activo");
					$("#anular_venta_regresar").addClass("activo");


					var ajaxRequest_modif;
					var pet_modif = $("#anular_venta_form #procesar_anular_venta").val();
					ajaxRequest_modif= $.ajax({
			            url: pet_modif,
			            type: met,
			            data: 	{
						            id_venta: $(this).data("id"),
						            descripcion_venta: $(this).data("descripcion"),
						            producto_band: 1
								}
			        });

				    ajaxRequest_modif.done(function (response, textStatus, jqXHR){

				    	$("#impresion_tabla_anular_venta").html(response);
				     	$("#tabla_ventas_registradas_anular").DataTable();
						$(".anular_venta, #anular_venta_form .dataTables_length, #anular_venta_form .dataTables_filter, #anular_venta_form .dataTables_info, #anular_venta_form .dataTables_paginate").addClass("activo");

				    });
				});
		        console.log('Submitted successfully');

		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});


	$("#anular_venta_form").submit(function(e){
		e.preventDefault();
		//$("#crear, #modificar, #eliminar, .activo").fadeOut(300);
     	var confirmar_anular_venta = confirm("SEGURO QUE DESEA ANULAR ESTA VENTA?");
     	if(confirmar_anular_venta)
     	{
			$(".activo").removeClass("activo");
			$(".anular_venta").fadeIn(300);
			$("#anular_venta_form #label_mensaje").hide();
			$(".anular_venta").addClass("activo");
			$(".anular_venta, #anular_venta_form .dataTables_length, #anular_venta_form .dataTables_filter, #anular_venta_form .dataTables_info, #anular_venta_form .dataTables_paginate").addClass("activo");
			$("#anular_venta_regresar").removeClass("activo");
			$("#anular_venta_regresar").addClass("activo");

			var pet = $("#anular_venta_form #procesar_anular_venta_eliminar").val();

			var met = $("#anular_venta_form").attr("method");

				var ajaxRequest;
				var info = $("#anular_venta_form").serialize();

			$("#anular_venta_form table *").attr("disabled", "true");
			$("#anular_venta_form table").css("opacity", "0.5");
				ajaxRequest= $.ajax({
		            url: pet,
		            type: met,
		            data: info
		        });

				console.log(pet);
				console.log(met);
			     ajaxRequest.done(function (response, textStatus, jqXHR){

		     		$(".mensaje_anular_venta").fadeIn(300);
		     		$(".mensaje_anular_venta").addClass("activo");

			     	if(confirmar_anular_venta)
			     	{
						$(".mensaje_anular_venta").addClass("incorrecto");
						$(".mensaje_anular_venta").text("La Venta ha sido anulada correctamente");
					}

					$(".mensaje_anular_venta").fadeOut(5000);
					$("#anular_venta_submit").fadeOut(300);
			     	//$("#anular_venta_form table *").removeAttr("disabled");
			     	//$("#anular_venta_form table").css("opacity", "1");
					$(".anular_venta, #anular_venta_form .dataTables_length, #anular_venta_form .dataTables_filter, #anular_venta_form .dataTables_info, #anular_venta_form .dataTables_paginate, #anular_venta_form .dataTable").addClass("activo");

			        console.log('Submitted successfully');
			     });

			     ajaxRequest.fail(function (){
			       console.log('There is error while submit');
			     });
		}
	});

	function historico_ventas()
	{
		$(".historico_ventas, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#historico_ventas_regresar, #historico_ventas_form #label_mensaje").fadeIn(300);
		$("#historico_ventas_form #label_mensaje").css("display", "block");

		var pet = $("#historico_ventas_form").attr("action");

		var met = $("#historico_ventas_form").attr("method");

			var ajaxRequest;
			var info = $("#historico_ventas_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_historico_ventas").html(response);
		     	$('#historico_ventas_tabla').DataTable();
				$(".historico_ventas, #historico_ventas_form .dataTables_length, #historico_ventas_form .dataTables_filter, #historico_ventas_form .dataTables_info, #historico_ventas_form .dataTables_paginate").addClass("activo");

				$(".boton_historico_ventas").click(function(){
					console.log("ID = "+$(this).data("id"));
					$("#historico_ventas_form #label_mensaje").hide();
					$("#historico_ventas_regresar").removeClass("activo");
					$(".activo").fadeOut(100);
					$(".activo").removeClass("activo");
					$("#historico_ventas_regresar").addClass("activo");
					$("#historico_ventas_regresar").hide();
					$("#regresar_historico").show();

					var ajaxRequest_modif;
					var pet_modif = $("#historico_ventas_form #procesar_historico_ventas").val();
					var info = $("#historico_ventas_form").serialize();

					var valor_option = 0;
					if($("#ultimos30").is(":checked"))
						valor_option = 1;
					else if($("#mes_actual").is(":checked"))
						valor_option = 2;

					ajaxRequest_modif= $.ajax({
			            url: pet_modif,
			            type: met,
			            data:  {
						            id_venta: $(this).data("id"),
						            descripcion_venta: $(this).data("descripcion"),
						            producto_band: 1, 
									vendedor_buscar: $("#vendedor_buscar").val(),
									fecha_inicio: $("#fecha_inicio").val(),
									fecha_fin: $("#fecha_fin").val(),
									mes_buscar: valor_option
								}
			        });

				    ajaxRequest_modif.done(function (response, textStatus, jqXHR){

				    	$("#impresion_tabla_historico_ventas").html(response);
				     	$("#tabla_historico_ventas_registradas").DataTable();
						$(".historico_ventas, #historico_ventas_form .dataTables_length, #historico_ventas_form .dataTables_filter, #historico_ventas_form .dataTables_info, #historico_ventas_form .dataTables_paginate").addClass("activo");

				    });
				});
		        console.log('Submitted successfully');

		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });
	}

	$("#regresar_historico").click(function()
	{
		historico_ventas();
	});

	$("#historico_ventas").click(function()
	{
		$("#regresar_historico").hide();
		historico_ventas();
	});

	$("#historico_ventas_form").submit(function(e)
	{
		e.preventDefault();
		historico_ventas();
	});

	$("#crear_venta_regresar, #anular_venta_regresar, #historico_ventas_regresar").click(function(){
		$(".activo").fadeOut(300);
		$(".activo").removeClass("activo");
	});

});
