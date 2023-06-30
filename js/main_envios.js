$(function()
{
/*
	$("#envios").click(function(){

	});
*/
	$("#envios").click(function(){
		$(".activo").fadeOut(0);
		$(".activo").removeClass("activo");
		$(".envios").fadeIn(300);
		$(".envios").addClass("activo");
	});

	$("#crear").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".envios, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$(".registro_envio").fadeIn(300);
		$(".registro_envio").addClass("activo");
		$(".registro_envio").css("display", "block");
	});

	$("#crear_form").submit(function(e){
		e.preventDefault();

		var pet = $("#crear_form").attr("action");
		var met = $("#crear_form").attr("method");
		var ajaxRequest;
		var info = $("#crear_form").serialize();

		ajaxRequest= $.ajax({
            url: pet,
            type: met,
            data: info
        });

		//console.log(pet);
		//console.log(met);
	     ajaxRequest.done(function (response, textStatus, jqXHR){
	     	//console.log(response);
	     	$(".mensaje_crear_registro").fadeIn(300);
	     	$(".mensaje_crear_registro").addClass("activo");
	     	if(response == 1)
	     	{
	     		$("#fecha_registro").val("");
				$("#descripcion_registro").val("");
				$(".mensaje_crear_registro").removeClass("incorrecto");
				$(".mensaje_crear_registro").addClass("correcto");
				$(".mensaje_crear_registro").text("Envío creado correctamente");
			}
			else
			{
				$(".mensaje_crear_registro").removeClass("correcto");
				$(".mensaje_crear_registro").addClass("incorrecto");
				$(".mensaje_crear_registro").text("No se creó el envío, hay campos vacíos");
			}
			$(".mensaje_crear_registro").fadeOut(5000);
	        console.log('Submitted successfully');
	     });

	     ajaxRequest.fail(function (){
	       console.log('There is error while submit');
	     });
	});

	$("#modificar").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".envios, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#modificar_regresar, #modificar_form #label_mensaje").fadeIn(300);
		$("#modificar_form #label_mensaje").css("display", "block");

		var pet = $("#modificar_form").attr("action");

		var met = $("#modificar_form").attr("method");

			var ajaxRequest;
			var info = $("#modificar_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {modificar_band:1}
	        });

			//console.log(pet);
			//console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	$("#impresion_tabla_modificar").html(response);
		     	$('#modificar_envio').DataTable();
				$(".modificar_envio, #modificar_form .dataTables_length, #modificar_form .dataTables_filter, #modificar_form .dataTables_info, #modificar_form .dataTables_paginate").addClass("activo");
		        console.log('Submitted successfully');
		     	//console.log(response);

				$(".check_enviado").click(function(){
					console.log("check_enviado");
					var id = $(this).data("id");
					if($("#enviado_"+id).is(":checked"))
						$("#recibido_"+id).removeAttr("disabled");
					else
						$("#recibido_"+id).attr("disabled", "disabled");
				});

				$(".check_recibido").click(function(){
					console.log("check_recibido");
					var id = $(this).data("id");
					if($("#recibido_"+id).is(":checked"))
						$("#enviado_"+id).attr("disabled", "disabled");
					else
						$("#enviado_"+id).removeAttr("disabled");
				});
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#modificar_form").submit(function(e){
		e.preventDefault();
		//$("#crear, #modificar, #eliminar, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$(".modificar_envio").fadeIn(300);
		$(".modificar_envio, #modificar_form .dataTables_length, #modificar_form .dataTables_filter, #modificar_form .dataTables_info, #modificar_form .dataTables_paginate").addClass("activo");

		var pet = $("#modificar_form").attr("action");

		var met = $("#modificar_form").attr("method");

		var allresponse = 1;

			var ajaxRequest;
			var info = $("#modificar_form").serialize();

			$("#modificar_form table *").attr("disabled", "true");
			$("#modificar_form table").css("opacity", "0.5");
			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {modificar_band:0}
	        });

			//console.log(pet);
			//console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	//console.log(response);
		     	var id_modificar_v = response.split("-");
		     	//console.log("....................");

		     	for(var i = 0; i < id_modificar_v.length-1; i++)
		     	{
		     		if($("#modif_id_"+id_modificar_v[i]).hasClass("modif_activo"))
		     		{
		     			//console.log(id_modificar_v[i]);
						var ajaxRequest_modif;
						var info = $("#modificar_form").serialize();
						var pet_modif = $("#modificar_form #procesar_modificacion").val();


						var enviado_modif = 0;
			     		if($("#enviado_"+id_modificar_v[i]).is(":checked"))
			     			enviado_modif = 1;

						var recibido_modif = 0;
			     		if($("#recibido_"+id_modificar_v[i]).is(":checked"))
			     			recibido_modif = 1;

						ajaxRequest_modif= $.ajax({
				            url: pet_modif,
				            type: met,
				            data: 	{
							            id_modificar: id_modificar_v[i],
										fecha_modificar: $("#fecha_"+id_modificar_v[i]).val(),
										descripcion_modificar: $("#descripcion_"+id_modificar_v[i]).val(),
										enviado_modificar: enviado_modif,
										recibido_modificar: recibido_modif
									}
				        });

				        console.log("RECIBIDO = "+pet_modif);

					    ajaxRequest_modif.done(function (response, textStatus, jqXHR){
					    	//console.log(response);

							ajaxRequest= $.ajax({
					            url: pet,
					            type: met,
					            data: {modificar_band:1}
					        });
							console.log("RECIBIDO 2 = "+pet);
							if(!response)
							{
								allresponse = response;
							}

					        ajaxRequest.done(function (response, textStatus, jqXHR){
						     	console.log(response);
						     	$("#impresion_tabla_modificar").html(response);
						     	$('#modificar_envio').DataTable();
								$(".modificar_envio, #modificar_form .dataTables_length, #modificar_form .dataTables_filter, #modificar_form .dataTables_info, #modificar_form .dataTables_paginate").addClass("activo");
						        console.log('Submitted successfully');

								$(".check_enviado").click(function(){
									console.log("check_enviado");
									var id = $(this).data("id");
									if($("#enviado_"+id).is(":checked"))
										$("#recibido_"+id).removeAttr("disabled");
									else
										$("#recibido_"+id).attr("disabled", "disabled");
								});

								$(".check_recibido").click(function(){
									console.log("check_recibido");
									var id = $(this).data("id");
									if($("#recibido_"+id).is(":checked"))
										$("#enviado_"+id).attr("disabled", "disabled");
									else
										$("#enviado_"+id).removeAttr("disabled");
								});
					        });

					    });
					}
		     	}
		     	//$("#impresion_tabla_eliminar").html(response);
		     	//console.log("....................");


	     		$(".mensaje_modificar_envio").fadeIn(300);
	     		$(".mensaje_modificar_envio").addClass("activo");
		     	if(allresponse == 1)
		     	{
					$(".mensaje_modificar_envio").removeClass("incorrecto");
					$(".mensaje_modificar_envio").addClass("correcto");
					$(".mensaje_modificar_envio").text("Envío(s) Modificado(s) correctamente");
				}
				else
				{
					$(".mensaje_modificar_envio").removeClass("correcto");
					$(".mensaje_modificar_envio").addClass("incorrecto");
					$(".mensaje_modificar_envio").text("No se realizaron las modificaciones");
				}
				$(".mensaje_modificar_envio").fadeOut(5000);
				$("#modificar_form table *").removeAttr("disabled");
				$("#modificar_form table").css("opacity", "1");

		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });
	});


	$("#eliminar").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".envios, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#eliminar_regresar, #eliminar_form #label_mensaje").fadeIn(300);
		$("#eliminar_form #label_mensaje").css("display", "block");

		var pet = $("#eliminar_form").attr("action");

		var met = $("#eliminar_form").attr("method");

			var ajaxRequest;
			var info = $("#eliminar_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {eliminar_band:1}
	        });

			//console.log(pet);
			//console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	//console.log(response);
		     	$("#impresion_tabla_eliminar").html(response);
		     	$('#eliminar_envio').DataTable();
				$(".eliminar_envio, #eliminar_form .dataTables_length, #eliminar_form .dataTables_filter, #eliminar_form .dataTables_info, #eliminar_form .dataTables_paginate").addClass("activo");
		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});

	$("#eliminar_form").submit(function(e){
		e.preventDefault();
		//$("#crear, #modificar, #eliminar, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$(".eliminar_envio").fadeIn(300);
		$(".eliminar_envio").addClass("activo");
		$(".eliminar_envio, #eliminar_form .dataTables_length, #eliminar_form .dataTables_filter, #eliminar_form .dataTables_info, #eliminar_form .dataTables_paginate").addClass("activo");

		var pet = $("#eliminar_form").attr("action");

		var met = $("#eliminar_form").attr("method");

			var ajaxRequest;
			var info = $("#eliminar_form").serialize();

		$("#eliminar_form table *").attr("disabled", "true");
		$("#eliminar_form table").css("opacity", "0.5");
			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: {eliminar_band:0}
	        });

			//console.log(pet);
			//console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	//console.log(response);
		     	var id_eliminar = response.split("-");
		     	var allresponse = 1;
		     	//console.log("....................");
		     	var confirmar_elim = confirm("Seguro desea eliminar estos envíos con todos sus productos?");
		     	if(confirmar_elim)
		     	for(var i = 0; i < id_eliminar.length-1; i++)
		     	{
		     		if($("#elim_tr_"+id_eliminar[i]).hasClass("elim_activo"))
		     		{
			     		if($("#elim_"+id_eliminar[i]).is(":checked"))
			     		{
			     			console.log(id_eliminar[i]+" --> eliminar");
							var ajaxRequest_elim;
							var info = $("#eliminar_form").serialize();
							var pet_elim = $("#eliminar_form #procesar_eliminacion").val();

							ajaxRequest_elim= $.ajax({
					            url: pet_elim,
					            type: met,
					            data: {envio_eliminar:id_eliminar[i]}
					        });

						    ajaxRequest_elim.done(function (response, textStatus, jqXHR){
	/*
						    	$("#elim_tr_"+id_eliminar[i]).remove();
						    	$("#eliminar_envio").hide();
						    	$("#eliminar_envio").show();
						    	console.log("Eliminado");
	*/
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
							     //	console.log(response);
							     	$("#impresion_tabla_eliminar").html(response);
							     	$('#eliminar_envio').DataTable();
									$(".eliminar_envio, #eliminar_form .dataTables_length, #eliminar_form .dataTables_filter, #eliminar_form .dataTables_info, #eliminar_form .dataTables_paginate").addClass("activo");
							        console.log('Submitted successfully');
						        });

						    });

			     		}
			     		else
			     			console.log(id_eliminar[i]+" --> Quieto");
		     		}
		     	}
		     	//$("#impresion_tabla_eliminar").html(response);
		     	console.log("....................");
	     		$(".mensaje_eliminar_envio").fadeIn(300);
	     		$(".mensaje_eliminar_envio").addClass("activo");
		     	if(allresponse == 1 && confirmar_elim)
		     	{
					//$(".mensaje_eliminar_envio").removeClass("incorrecto");
					$(".mensaje_eliminar_envio").addClass("incorrecto");
					$(".mensaje_eliminar_envio").text("Envío(s) Eliminados(s) correctamente");
				}
				else
				{
					//$(".mensaje_eliminar_envio").removeClass("correcto");
					$(".mensaje_eliminar_envio").addClass("incorrecto");
					$(".mensaje_eliminar_envio").text("No se realizaron las eliminaciones");
				}
				$(".mensaje_eliminar_envio").fadeOut(5000);
		     	$("#eliminar_form table *").removeAttr("disabled");
		     	$("#eliminar_form table").css("opacity", "1");
		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });
	});

	$("#consultar").click(function(){
		//$("#crear, #modificar, #eliminar, #consultar, .activo").fadeOut(300);
		$(".envios, .activo").fadeOut(300);
		$(".activo").removeClass("activo");
		$("#consultar_regresar, #consultar_form #label_mensaje").fadeIn(300);
		$("#consultar_form #label_mensaje").css("display", "block");

		var pet = $("#consultar_form").attr("action");

		var met = $("#consultar_form").attr("method");

			var ajaxRequest;
			var info = $("#consultar_form").serialize();

			ajaxRequest= $.ajax({
	            url: pet,
	            type: met,
	            data: info
	        });

			//console.log(pet);
			//console.log(met);
		     ajaxRequest.done(function (response, textStatus, jqXHR){
		     	//console.log(response);
		     	$("#impresion_tabla_consultar").html(response);
		     	$('#consultar_envio').DataTable();
				$(".consultar_envio, #consultar_form .dataTables_length, #consultar_form .dataTables_filter, #consultar_form .dataTables_info, #consultar_form .dataTables_paginate").addClass("activo");
		        console.log('Submitted successfully');
		     });

		     ajaxRequest.fail(function (){
		       console.log('There is error while submit');
		     });

	});


	$("#crear_regresar, #modificar_regresar, #eliminar_regresar, #consultar_regresar").click(function(){
		$(".activo").fadeOut(300);
		$(".activo").removeClass("activo");
//		$(".registro_envio").fadeOut(300);
		//$("#crear, #modificar, #eliminar").fadeIn(300);
		//$("#crear, #modificar, #eliminar").addClass("activo");
	});


		//var nom, m, msj;  = $("#main form").serialize()
});
