$(function()
{
/*
	$("#envios").click(function(){

	});
*/
	$("#productos").click(function(){
		$(".activo").fadeOut(0);
		$(".activo").removeClass("activo");
		$(".productos").fadeIn(300);
		$(".productos").addClass("activo");
	});

	$("#crear_productos").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".anadir_producto, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#anadir_regresar_producto, #anadir_producto_form #label_mensaje").fadeIn(300);
		$("#anadir_producto_form #label_mensaje").css("display", "block");

		var pet = $("#anadir_producto_form").attr("action");

		var met = $("#anadir_producto_form").attr("method");

			var ajaxRequest;
			var info = $("#anadir_producto_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_anadir_producto").html(response);
		     	$('#anadir_producto_tabla').DataTable();
				$(".anadir_producto, #anadir_producto_form .dataTables_length, #anadir_producto_form .dataTables_filter, #anadir_producto_form .dataTables_info, #anadir_producto_form .dataTables_paginate").addClass("activo");

				$(".boton_anadir_producto").click(function(){
					console.log("ID = "+$(this).data("id"));
					$("#anadir_regresar_producto").removeClass("activo");
					$(".activo").fadeOut(100);
					$(".activo").removeClass("activo");
					$("#anadir_regresar_producto").addClass("activo");


					var ajaxRequest_modif;
					var pet_modif = $("#anadir_producto_form #procesar_anadir").val();
					ajaxRequest_modif= $.ajax({
			            url: pet_modif,
			            type: met,
			            data: 	{
						            id_envio: $(this).data("id"),
						            descripcion_envio: $(this).data("descripcion"),
						            producto_band: 1
								}
			        });

				    ajaxRequest_modif.done(function (response, textStatus, jqXHR){

				    	$("#impresion_tabla_anadir_producto").html(response);
				     	$("#tabla_productos_envios_registrados").DataTable();
						$(".anadir_producto, #anadir_producto_form .dataTables_length, #anadir_producto_form .dataTables_filter, #anadir_producto_form .dataTables_info, #anadir_producto_form .dataTables_paginate").addClass("activo");

				    });
				});
		        console.log('Submitted successfully');

		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#anadir_producto_form").submit(function(e){
		e.preventDefault();

		var pet = $("#anadir_producto_form").attr("action");

		var met = $("#anadir_producto_form").attr("method");

		var ajaxRequest;
		var info = $("#anadir_producto_form").serialize();

			ajaxRequest= $.ajax({
	            url: $("#anadir_producto_form #procesar_anadir_registro").val(),
	            type: met,
	            data: info
	        });
			console.log('Here1');
			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log("RESPONSE = "+response);
		     	$(".mensaje_anadir_producto").fadeIn(300);
		     	$(".mensaje_anadir_producto").addClass("activo");
	     		$("#codigo_barras").val("");
				$("#cantidad").val("1");
		     	if(response == 0)
		     	{
					$(".mensaje_anadir_producto").removeClass("correcto");
					$(".mensaje_anadir_producto").addClass("incorrecto");
					$(".mensaje_anadir_producto").text("No se agregó el Producto, debe colocar un código de barras");
				}
				else if(response == 1 || response == 2)
				{
					$(".mensaje_anadir_producto").removeClass("correcto");
					$(".mensaje_anadir_producto").addClass("incorrecto");
					$(".mensaje_anadir_producto").text("El producto no existe");
				}
				else
				{
			     	$("#imprimir_productos_agregados").html(response);
			     	$("#tabla_productos_envios_registrados").DataTable();
					$(".anadir_producto, #anadir_producto_form .dataTables_length, #anadir_producto_form .dataTables_filter, #anadir_producto_form .dataTables_info, #anadir_producto_form .dataTables_paginate").addClass("activo");

					$(".mensaje_anadir_producto").removeClass("incorrecto");
					$(".mensaje_anadir_producto").addClass("correcto");
					$(".mensaje_anadir_producto").text("Producto creado correctamente");
				}
				$(".mensaje_anadir_producto").fadeOut(5000);
			});

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });
	});


	$("#modificar_productos").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".modificar_producto, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#modificar_regresar_producto, #modificar_productos_form #label_mensaje").fadeIn(300);
		$("#modificar_productos_form #label_mensaje").css("display", "block");

		var pet = $("#modificar_productos_form").attr("action");
		console.log('Here 2');

		var met = $("#modificar_productos_form").attr("method");

			var ajaxRequest;
			var info = $("#modificar_productos_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_modificar_producto").html(response);
		     	$('#modificar_producto_tabla').DataTable();
				$(".modificar_producto, #modificar_productos_form .dataTables_length, #modificar_productos_form .dataTables_filter, #modificar_productos_form .dataTables_info, #modificar_productos_form .dataTables_paginate").addClass("activo");

				$(".boton_modificar_producto").click(function(){
					console.log("ID = "+$(this).data("id"));
					$("#modificar_regresar_producto").removeClass("activo");
					$(".activo").fadeOut(100);
					$(".activo").removeClass("activo");
					$("#modificar_regresar_producto").addClass("activo");


					var ajaxRequest_modif;
					var pet_modif = $("#modificar_productos_form #procesar_modificar").val();
					ajaxRequest_modif= $.ajax({
			            url: pet_modif,
			            type: met,
			            data: 	{
						            id_envio: $(this).data("id"),
						            descripcion_envio: $(this).data("descripcion"),
						            producto_band: 1
								}
			        });

				    ajaxRequest_modif.done(function (response, textStatus, jqXHR){

				    	$("#impresion_tabla_modificar_producto").html(response);
				     	$("#tabla_productos_envios_registrados_modificar").DataTable();
						$(".modificar_producto, #modificar_productos_form .dataTables_length, #modificar_productos_form .dataTables_filter, #modificar_productos_form .dataTables_info, #modificar_productos_form .dataTables_paginate").addClass("activo");

				    });
				});
		        console.log('Submitted successfully');

		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#modificar_productos_form").submit(function(e){
		e.preventDefault();

		var pet = $("#modificar_productos_form").attr("action");

		var met = $("#modificar_productos_form").attr("method");
		console.log('Here 3 ');

		var ajaxRequest;
		var info = $("#modificar_productos_form").serialize();

			ajaxRequest= $.ajax({
	            url: $("#modificar_productos_form #procesar_modificar_registro").val(),
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	$(".mensaje_modificar_producto").fadeIn(300);
		     	$(".mensaje_modificar_producto").addClass("activo");

		     	$("#imprimir_productos_modificados").html(response);
		     	$("#tabla_productos_envios_registrados_modificar").DataTable();
				$(".modificar_producto, #modificar_productos_form .dataTables_length, #modificar_productos_form .dataTables_filter, #modificar_productos_form .dataTables_info, #modificar_productos_form .dataTables_paginate").addClass("activo");

				$(".mensaje_modificar_producto").removeClass("incorrecto");
				$(".mensaje_modificar_producto").addClass("correcto");
				$(".mensaje_modificar_producto").text("Producto(s) Modificado(s) correctamente");
				$(".mensaje_modificar_producto").fadeOut(5000);
			});

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });
	});


	$("#eliminar_productos").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".eliminar_producto, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#eliminar_regresar_producto, #eliminar_productos_form #label_mensaje").fadeIn(300);
		$("#eliminar_productos_form #label_mensaje").css("display", "block");

		var pet = $("#eliminar_productos_form").attr("action");

		var met = $("#eliminar_productos_form").attr("method");

			var ajaxRequest;
			var info = $("#eliminar_productos_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_eliminar_producto").html(response);
		     	$('#eliminar_producto_tabla').DataTable();
				$(".eliminar_producto, #eliminar_productos_form .dataTables_length, #eliminar_productos_form .dataTables_filter, #eliminar_productos_form .dataTables_info, #eliminar_productos_form .dataTables_paginate").addClass("activo");

				$(".boton_eliminar_producto").click(function(){
					console.log("ID = "+$(this).data("id"));
					$("#eliminar_regresar_producto").removeClass("activo");
					$(".activo").fadeOut(100);
					$(".activo").removeClass("activo");
					$("#eliminar_regresar_producto").addClass("activo");


					var ajaxRequest_modif;
					var pet_modif = $("#eliminar_productos_form #procesar_eliminar").val();
					ajaxRequest_modif= $.ajax({
			            url: pet_modif,
			            type: met,
			            data: 	{
						            id_envio: $(this).data("id"),
						            descripcion_envio: $(this).data("descripcion"),
						            producto_band: 1
								}
			        });

				    ajaxRequest_modif.done(function (response, textStatus, jqXHR){

				    	$("#impresion_tabla_eliminar_producto").html(response);
				     	$("#tabla_productos_envios_registrados_eliminar").DataTable();
						$(".eliminar_producto, #eliminar_productos_form .dataTables_length, #eliminar_productos_form .dataTables_filter, #eliminar_productos_form .dataTables_info, #eliminar_productos_form .dataTables_paginate").addClass("activo");

				    });
				});
		        console.log('Submitted successfully');

		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#eliminar_productos_form").submit(function(e){
		e.preventDefault();

		var pet = $("#eliminar_productos_form").attr("action");

		var met = $("#eliminar_productos_form").attr("method");

     	var ids_tabla = $("#ids_tabla").val();
     	var id_eliminar = ids_tabla.split("-");
     	var last_response;
     	console.log(ids_tabla);
     	console.log("....................");
     	for(var i = 0; i < id_eliminar.length-1; i++)
     	{
     		if($("#elim_tr_"+id_eliminar[i]).hasClass("elim_activo"))
     		{
	     		if($("#elim_producto_"+id_eliminar[i]).is(":checked"))
	     		{
	     			console.log(id_eliminar[i]+" --> eliminar");
					var ajaxRequest_elim;
					//var info = $("#eliminar_productos_form").serialize();
					var pet_elim = $("#eliminar_productos_form #procesar_eliminar_registro").val();

					ajaxRequest_elim= $.ajax({
			            url: pet_elim,
			            type: met,
			            data: {id_eliminar:id_eliminar[i], id_envio: $("#id_envio").val()}
			        });

				    ajaxRequest_elim.done(function (response, textStatus, jqXHR){

					    	$("#imprimir_productos_eliminados").html(response);
					     	$("#tabla_productos_envios_registrados_eliminar").DataTable();
							$(".eliminar_producto, #eliminar_productos_form .dataTables_length, #eliminar_productos_form .dataTables_filter, #eliminar_productos_form .dataTables_info, #eliminar_productos_form .dataTables_paginate").addClass("activo");
							last_response = response;
				    });

	     		}
	     		else
	     			console.log(id_eliminar[i]+" --> Quieto");
     		}
     	}

	     	$(".mensaje_eliminar_producto").fadeIn(300);
	     	$(".mensaje_eliminar_producto").addClass("activo");

	     	$("#imprimir_productos_eliminados").html(last_response);
	     	$("#tabla_productos_envios_registrados_eliminar").DataTable();
			$(".eliminar_producto, #eliminar_productos_form .dataTables_length, #eliminar_productos_form .dataTables_filter, #eliminar_productos_form .dataTables_info, #eliminar_productos_form .dataTables_paginate").addClass("activo");

			$(".mensaje_eliminar_producto").removeClass("correcto");
			$(".mensaje_eliminar_producto").addClass("incorrecto");
			$(".mensaje_eliminar_producto").text("Producto Eliminado correctamente");
			$(".mensaje_eliminar_producto").fadeOut(5000);


	});


	$("#consultar_productos").click(function(){

		$(".consultar_producto, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#consultar_regresar_producto, #consultar_productos_form #label_mensaje").fadeIn(300);
		$("#consultar_productos_form #label_mensaje").css("display", "block");

		var pet = $("#consultar_productos_form").attr("action");

		var met = $("#consultar_productos_form").attr("method");

			var ajaxRequest;
			var info = $("#consultar_productos_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_consultar_producto").html(response);
		     	$('#consultar_producto_tabla').DataTable();
				$(".consultar_producto, #consultar_productos_form .dataTables_length, #consultar_productos_form .dataTables_filter, #consultar_productos_form .dataTables_info, #consultar_productos_form .dataTables_paginate").addClass("activo");

				$(".boton_consultar_producto").click(function(){
					console.log("ID = "+$(this).data("id"));
					$("#consultar_regresar_producto").removeClass("activo");
					$(".activo").fadeOut(100);
					$(".activo").removeClass("activo");
					$("#consultar_regresar_producto").addClass("activo");


					var ajaxRequest_modif;
					var pet_modif = $("#consultar_productos_form #procesar_consultar").val();
					ajaxRequest_modif= $.ajax({
			            url: pet_modif,
			            type: met,
			            data: 	{
						            id_envio: $(this).data("id"),
						            descripcion_envio: $(this).data("descripcion"),
						            producto_band: 1
								}
			        });

				    ajaxRequest_modif.done(function (response, textStatus, jqXHR){

				    	$("#impresion_tabla_consultar_producto").html(response);
				     	$("#tabla_productos_envios_registrados_consultar").DataTable();
						$(".consultar_producto, #consultar_productos_form .dataTables_length, #consultar_productos_form .dataTables_filter, #consultar_productos_form .dataTables_info, #consultar_productos_form .dataTables_paginate").addClass("activo");

				    });
				});
		        console.log('Submitted successfully');

		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#anadir_regresar_producto, #modificar_regresar_producto, #eliminar_regresar_producto, #consultar_regresar_producto").click(function(){
		$(".activo").fadeOut(300);
		$(".activo").removeClass("activo");
	});

	$("#generar_codigos").click(function(){
		window.open($("#generar_codigos_barra").val());
	});

	$("#generar_codigos_img").click(function(){
		window.open($("#generar_codigos_barra_img").val());
	});

});
