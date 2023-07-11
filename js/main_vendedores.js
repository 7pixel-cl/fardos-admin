$(function()
{
/*
	$("#envios").click(function(){

	});
*/
	$("#vendedores").click(function(){
		$(".activo").fadeOut(0);
		$(".activo").removeClass("activo");
		$(".vendedores").fadeIn(300);
		$(".vendedores").addClass("activo");
	});

	$("#crear_vendedor").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".vendedores, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$(".registro_vendedor").fadeIn(300);
		$(".registro_vendedor").addClass("activo");
		$(".registro_vendedor").css("display", "block");
	});

	$("#crear_vendedor_form").submit(function(e){
		e.preventDefault();

		var pet = $("#crear_vendedor_form").attr("action");
		var met = $("#crear_vendedor_form").attr("method");
		var ajaxRequest;
		var info = $("#crear_vendedor_form").serialize();

		ajaxRequest= $.ajax({
            url: pet,
            type: met,
            data: info
        });

		console.log(pet);
		console.log(met);
	     ajaxRequest.done(function (response, textStatus, jqXHR){
	     	console.log(response);
	     	$(".mensaje_crear_registro_vendedor").fadeIn(300);
	     	$(".mensaje_crear_registro_vendedor").addClass("activo");
	     	if(response == 1)
	     	{
	     		$("#nombre_vendedor").val("");
				$("#apellido_vendedor").val("");
	     		$("#telefono_vendedor").val("");
				$("#email_vendedor").val("");

				$(".mensaje_crear_registro_vendedor").removeClass("incorrecto");
				$(".mensaje_crear_registro_vendedor").addClass("correcto");
				$(".mensaje_crear_registro_vendedor").text("Vendedor creado correctamente");
			}
			else
			{
				$(".mensaje_crear_registro_vendedor").removeClass("correcto");
				$(".mensaje_crear_registro_vendedor").addClass("incorrecto");
				$(".mensaje_crear_registro_vendedor").text("No se creó el Vendedor, hay campos vacíos o incorrectos");
			}
			$(".mensaje_crear_registro_vendedor").fadeOut(5000);
	        console.log('Submitted successfully');
	     });

	     ajaxRequest.fail(function (){
	       console.log('There is error while submit');
	     });
	});

	$("#modificar_vendedor").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".vendedores, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#modificar_regresar_vendedor, #modificar_vendedor_form #label_mensaje").fadeIn(300);
		$("#modificar_vendedor_form #label_mensaje").css("display", "block");

		var pet = $("#modificar_vendedor_form").attr("action");

		var met = $("#modificar_vendedor_form").attr("method");

			var ajaxRequest;
			var info = $("#modificar_vendedor_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {modificar_band:1}
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_modificar_vendedor").html(response);
		     	$('#modificar_vendedor_tabla').DataTable();
				$(".modificar_vendedor, #modificar_vendedor_form .dataTables_length, #modificar_vendedor_form .dataTables_filter, #modificar_vendedor_form .dataTables_info, #modificar_vendedor_form .dataTables_paginate").addClass("activo");
		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#modificar_vendedor_form").submit(function(e){
		e.preventDefault();
		//$("#crear, #modificar, #eliminar, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$(".modificar_vendedor").fadeIn(300);
		$(".modificar_vendedor, #modificar_vendedor_form .dataTables_length, #modificar_vendedor_form .dataTables_filter, #modificar_vendedor_form .dataTables_info, #modificar_vendedor_form .dataTables_paginate").addClass("activo");

		var pet = $("#modificar_vendedor_form").attr("action");

		var met = $("#modificar_vendedor_form").attr("method");

		var allresponse = 1;

			var ajaxRequest;
			var info = $("#modificar_vendedor_form").serialize();

			$("#modificar_vendedor_form table *").attr("disabled", "true");
			$("#modificar_vendedor_form table").css("opacity", "0.5");
			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {modificar_band:0}
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	//console.log(response);
		     	var id_modificar_v = response.split("-");
		     	console.log("....................");
				// console.log('testing1');

		     	for(var i = 0; i < id_modificar_v.length-1; i++)
		     	{
				//	console.log('testing');
					//console.log(id_modificar_v);
		     		if($("#modif_id_"+id_modificar_v[i]).hasClass("modif_activo"))
		     		{
		     			console.log(id_modificar_v[i]);

						var ajaxRequest_modif;
						var info = $("#modificar_vendedor_form").serialize();
						var pet_modif = $("#modificar_vendedor_form #procesar_modificacion").val();
						ajaxRequest_modif= $.ajax({
				            url: pet_modif,
				            type: met,
				            data: 	{
							            id_modificar: id_modificar_v[i],
										nombre_modificar: $("#nombres_"+id_modificar_v[i]).val(),
										apellido_modificar: $("#apellidos_"+id_modificar_v[i]).val(),
										telefono_modificar: $("#telefono_"+id_modificar_v[i]).val(),
										email_modificar: $("#email_"+id_modificar_v[i]).val()
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
						     	$("#impresion_tabla_modificar_vendedor").html(response);
						     	$('#modificar_vendedor_tabla').DataTable();
								$(".modificar_vendedor, #modificar_vendedor_form .dataTables_length, #modificar_vendedor_form .dataTables_filter, #modificar_vendedor_form .dataTables_info, #modificar_vendedor_form .dataTables_paginate").addClass("activo");
						        console.log('Submitted successfully');
					        });

					    });
					}
		     	}
		     	//$("#impresion_tabla_eliminar").html(response);
		     	console.log("....................");
	     		$(".mensaje_modificar_vendedor").fadeIn(300);
	     		$(".mensaje_modificar_vendedor").addClass("activo");
		     	if(allresponse == 1)
		     	{
					$(".mensaje_modificar_vendedor").removeClass("incorrecto");
					$(".mensaje_modificar_vendedor").addClass("correcto");
					$(".mensaje_modificar_vendedor").text("Vendedor(es) Modificado(s) correctamente");
				}
				else
				{
					$(".mensaje_modificar_vendedor").removeClass("correcto");
					$(".mensaje_modificar_vendedor").addClass("incorrecto");
					$(".mensaje_modificar_vendedor").text("No se realizaron las modificaciones");
				}
				$(".mensaje_modificar_vendedor").fadeOut(5000);
				$("#modificar_vendedor_form table *").removeAttr("disabled");
				$("#modificar_vendedor_form table").css("opacity", "1");

		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });
	});

	$("#eliminar_vendedor").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".eliminar_vendedor, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#eliminar_regresar_vendedor, #eliminar_vendedor_form #label_mensaje").fadeIn(300);
		$("#eliminar_vendedor_form #label_mensaje").css("display", "block");

		var pet = $("#eliminar_vendedor_form").attr("action");

		var met = $("#eliminar_vendedor_form").attr("method");

			var ajaxRequest;
			var info = $("#eliminar_vendedor_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {eliminar_band:1}
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_eliminar_vendedor").html(response);
		     	$('#eliminar_vendedor_tabla').DataTable();
				$(".eliminar_vendedor, #eliminar_vendedor_form .dataTables_length, #eliminar_vendedor_form .dataTables_filter, #eliminar_vendedor_form .dataTables_info, #eliminar_vendedor_form .dataTables_paginate").addClass("activo");
		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#eliminar_vendedor_form").submit(function(e){
		e.preventDefault();
		//$("#crear, #modificar, #eliminar, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$(".eliminar_vendedor").fadeIn(300);
		$(".eliminar_vendedor").addClass("activo");
		$(".eliminar_vendedor, #eliminar_vendedor_form .dataTables_length, #eliminar_vendedor_form .dataTables_filter, #eliminar_vendedor_form .dataTables_info, #eliminar_vendedor_form .dataTables_paginate").addClass("activo");

		var pet = $("#eliminar_vendedor_form").attr("action");

		var met = $("#eliminar_vendedor_form").attr("method");

			var ajaxRequest;
			var info = $("#eliminar_vendedor_form").serialize();

		$("#eliminar_vendedor_form table *").attr("disabled", "true");
		$("#eliminar_vendedor_form table").css("opacity", "0.5");
			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {eliminar_band:0}
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	var id_eliminar = response.split("-");
		     	var allresponse = 1;
		     	console.log("....................");
		     	for(var i = 0; i < id_eliminar.length-1; i++)
		     	{
		     		if($("#elim_tr_"+id_eliminar[i]).hasClass("elim_activo"))
		     		{
			     		if($("#elim_"+id_eliminar[i]).is(":checked"))
			     		{
			     			console.log(id_eliminar[i]+" --> eliminar");
							var ajaxRequest_elim;
							var info = $("#eliminar_vendedor_form").serialize();
							var pet_elim = $("#eliminar_vendedor_form #procesar_eliminacion").val();

							ajaxRequest_elim= $.ajax({
					            url: pet_elim,
					            type: met,
					            data: {envio_eliminar:id_eliminar[i]}
					        });

						    ajaxRequest_elim.done(function (response, textStatus, jqXHR){
								ajaxRequest= $.ajax({
						            url: pet,
						            type: met,
						            data: {eliminar_band:1}
						        });

								if(!response)
								{
									allresponse = response;
								}

						        ajaxRequest.done(function (response, textStatus, jqXHR){
							     	console.log(response);
							     	$("#impresion_tabla_eliminar_vendedor").html(response);
							     	$('#eliminar_vendedor_tabla').DataTable();
									$(".eliminar_vendedor, #eliminar_vendedor_form .dataTables_length, #eliminar_vendedor_form .dataTables_filter, #eliminar_vendedor_form .dataTables_info, #eliminar_vendedor_form .dataTables_paginate").addClass("activo");
							        console.log('Submitted successfully');
						        });

						    });

			     		}
			     		else
			     			console.log(id_eliminar[i]+" --> Quieto");
		     		}
		     	}
		     	//$("#impresion_tabla_eliminar_vendedor").html(response);
		     	console.log("....................");
	     		$(".mensaje_eliminar_vendedor").fadeIn(300);
	     		$(".mensaje_eliminar_vendedor").addClass("activo");
		     	if(allresponse == 1)
		     	{
					//$(".mensaje_eliminar_vendedor").removeClass("incorrecto");
					$(".mensaje_eliminar_vendedor").addClass("incorrecto");
					$(".mensaje_eliminar_vendedor").text("Vendedor(es) Eliminados(s) correctamente");
				}
				else
				{
					//$(".mensaje_eliminar_vendedor").removeClass("correcto");
					$(".mensaje_eliminar_vendedor").addClass("incorrecto");
					$(".mensaje_eliminar_vendedor").text("No se realizaron las modificaciones");
				}
				$(".mensaje_eliminar_vendedor").fadeOut(5000);
		     	$("#eliminar_vendedor_form table *").removeAttr("disabled");
		     	$("#eliminar_vendedor_form table").css("opacity", "1");
		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });
	});

	$("#consultar_vendedor").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".consultar_vendedor, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#consultar_regresar_vendedor, #consultar_vendedor_form #label_mensaje").fadeIn(300);
		$("#consultar_vendedor_form #label_mensaje").css("display", "block");

		var pet = $("#consultar_vendedor_form").attr("action");

		var met = $("#consultar_vendedor_form").attr("method");

			var ajaxRequest;
			var info = $("#consultar_vendedor_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: info
	        });

			console.log(pet);
			console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	console.log(response);
		     	$("#impresion_tabla_consultar_vendedor").html(response);
		     	$('#consultar_vendedor_tabla').DataTable();
				$(".consultar_vendedor, #consultar_vendedor_form .dataTables_length, #consultar_vendedor_form .dataTables_filter, #consultar_vendedor_form .dataTables_info, #consultar_vendedor_form .dataTables_paginate").addClass("activo");
		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});


	$("#crear_regresar_vendedor, #modificar_regresar_vendedor, #eliminar_regresar_vendedor, #consultar_regresar_vendedor").click(function(){
		$(".activo").fadeOut(300);
		$(".activo").removeClass("activo");
//		$(".registro_envio").fadeOut(300);
		//$("#crear, #modificar, #eliminar").fadeIn(300);
		//$("#crear, #modificar, #eliminar").addClass("activo");
	});


		//var nom, m, msj;  = $("#main form").serialize()
});
