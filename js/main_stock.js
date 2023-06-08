$(function()
{
/*
	$("#envios").click(function(){

	});
*/
	$("#stock").click(function(){
		$(".activo").fadeOut(0);
		$(".activo").removeClass("activo");
		$(".stock").fadeIn(300);
		$(".stock").addClass("activo");
	});

	$("#mostrar_stock").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".consultar_stock, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#consultar_regresar_stock, #consultar_stock_form #label_mensaje").fadeIn(300);
		$("#consultar_stock_form #label_mensaje").css("display", "block");

		var pet = $("#consultar_stock_form").attr("action");

		var met = $("#consultar_stock_form").attr("method");

			var ajaxRequest;
			var info = $("#consultar_stock_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	//console.log(response);
		     	$("#impresion_tabla_consultar_stock").html(response);
		     	$('#consultar_stock_tabla').DataTable();
				$(".consultar_stock, #consultar_stock_form .dataTables_length, #consultar_stock_form .dataTables_filter, #consultar_stock_form .dataTables_info, #consultar_stock_form .dataTables_paginate").addClass("activo");
		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});


	$("#modificar_stock").click(function(){

		$(".stock, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#modificar_regresar_stock, #modificar_stock_form #label_mensaje").fadeIn(300);
		$("#modificar_stock_form #label_mensaje").css("display", "block");

		var pet = $("#modificar_stock_form").attr("action");

		var met = $("#modificar_stock_form").attr("method");

			var ajaxRequest;
			var info = $("#modificar_stock_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {modificar_band:1}
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_modificar_stock").html(response);
		     	$('#modificar_stock_tabla').DataTable();
				$(".modificar_stock, #modificar_stock_form .dataTables_length, #modificar_stock_form .dataTables_filter, #modificar_stock_form .dataTables_info, #modificar_stock_form .dataTables_paginate").addClass("activo");
		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#modificar_stock_form").submit(function(e){
		e.preventDefault();
		//$("#crear, #modificar, #eliminar, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$(".modificar_stock").fadeIn(300);
		$(".modificar_stock, #modificar_stock_form .dataTables_length, #modificar_stock_form .dataTables_filter, #modificar_stock_form .dataTables_info, #modificar_stock_form .dataTables_paginate").addClass("activo");

		var pet = $("#modificar_stock_form").attr("action");

		var met = $("#modificar_stock_form").attr("method");

		var allresponse = 1;

			var ajaxRequest;
			var info = $("#modificar_stock_form").serialize();

			$("#modificar_stock_form table *").attr("disabled", "true");
			$("#modificar_stock_form table").css("opacity", "0.5");
			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {modificar_band:0}
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	var id_modificar_v = response.split("-");
		     	console.log("....................");

		     	for(var i = 0; i < id_modificar_v.length-1; i++)
		     	{
		     		if($("#modif_id_"+id_modificar_v[i]).hasClass("modif_activo"))
		     		{
		     			console.log(id_modificar_v[i]);

						var ajaxRequest_modif;
						var info = $("#modificar_stock_form").serialize();
						var pet_modif = $("#modificar_stock_form #procesar_modificacion").val();
						ajaxRequest_modif= $.ajax({
				            url: pet_modif,
				            type: met,
				            data: 	{
							            id_modificar: id_modificar_v[i],
										id_producto_empresa: $("#id_producto_empresa_"+id_modificar_v[i]).val(),
										id_wp_posts: $("#id_wp_posts_"+id_modificar_v[i]).val(),
										num_fardos: $("#num_fardos_"+id_modificar_v[i]).val(),
										kilos: $("#kilos_"+id_modificar_v[i]).val()
									}
				        });

					    ajaxRequest_modif.done(function (response, textStatus, jqXHR){

							ajaxRequest= $.ajax({
					            url: pet,
					            type: met,
					            data: {modificar_band:1}
					        });

							if(!response)
							{
								allresponse = response;
							}

					        ajaxRequest.done(function (response, textStatus, jqXHR){
						     	console.log(response);
						     	$("#impresion_tabla_modificar_stock").html(response);
						     	$('#modificar_stock_tabla').DataTable();
								$(".modificar_stock, #modificar_stock_form .dataTables_length, #modificar_stock_form .dataTables_filter, #modificar_stock_form .dataTables_info, #modificar_stock_form .dataTables_paginate").addClass("activo");
						        console.log('Submitted successfully');
					        });

					    });
					}
		     	}
		     	//$("#impresion_tabla_eliminar").html(response);
		     	console.log("....................");
	     		$(".mensaje_modificar_stock").fadeIn(300);
	     		$(".mensaje_modificar_stock").addClass("activo");
		     	if(allresponse == 1)
		     	{
					$(".mensaje_modificar_stock").removeClass("incorrecto");
					$(".mensaje_modificar_stock").addClass("correcto");
					$(".mensaje_modificar_stock").text("Stock Modificado correctamente");
				}
				else
				{
					$(".mensaje_modificar_stock").removeClass("correcto");
					$(".mensaje_modificar_stock").addClass("incorrecto");
					$(".mensaje_modificar_stock").text("No se realizaron las modificaciones");
				}
				$(".mensaje_modificar_stock").fadeOut(5000);
				$("#modificar_stock_form table *").removeAttr("disabled");
				$("#modificar_stock_form table").css("opacity", "1");

		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });
	});


	$("#consultar_regresar_stock").click(function(){
		$(".activo").fadeOut(300);
		$(".activo").removeClass("activo");
//		$(".registro_envio").fadeOut(300);
		//$("#crear, #modificar, #eliminar").fadeIn(300);
		//$("#crear, #modificar, #eliminar").addClass("activo");
	});

	$("#generar_stock").click(function(){
		window.open($("#generar_stock_actual").val());
	});

});
