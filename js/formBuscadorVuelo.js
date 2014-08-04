$(document).ready(function(){
	$('#formBuscadorVuelo').validate({
		rules: {
			destino: {
				required: true
			},
			origen: {
				required: true
			},
			clase: {
				required: true
			},
			fechaPartida: {
				required: true
			},
			fechaRegreso: {
				required: true
			},
			idaVuelta: {
				required: true
			}
		},
		messages: {
			destino: 'Ingrese el destino.',
			origen:	'Ingrese el origen.',
			clase: 'Especifique la clase deseada.',
			fechaPartida: 'Especifique la fecha de partida.',
			fechaRegreso: 'Especifique la fecha de regreso.',
			idaVuelta: 'Especifique la ruta del vuelo.'
		}
	});
	
	$('#formBuscarAeropuerto').validate({
		rules: {
			provincia: {
				required: true
			},
			ciudad: {
				required: true
			},
			aeropuerto: {
				required: true
			}
		},
		messages: {
			provincia: '<br>Seleccione una provincia.',
			ciudad: '<br>Seleccione una ciudad',
			aeropuerto: '<br>Seleccione un aeropuerto'
		}
	});
	
	$('#buscarDestino, #buscarOrigen').click(function(event){
		resetBuscadorAeropuertoFields();
		mostrarDialogoAeropuerto(event);
	});
	
	$('#fechaPartida, #fechaRegreso').datepicker({
		buttonImage: '../css/images/calendar.gif',
		buttonImageOnly: true,
		changeMonth: true,
		changeYear: true,
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		dateFormat: 'dd/mm/yy',
		minDate: '+3d',
		monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		showOn: "button",
		onSelect: function(){
			$(this).valid();
		}
	});
	
	var fechaMinima = '3';
	$('#fechaRegreso').datepicker('option', 'minDate', '+' + fechaMinima + 'd');
	$('#fechaPartida').datepicker('option', 'onSelect', function(){
		$(this).valid();
		$('#fechaRegreso').val('');
		if ($('#vuelta').prop('checked') == true) {
			$('#fechaRegreso').prop('disabled', false);
			$('#fechaRegreso').datepicker('option', 'minDate', $('#fechaPartida').val());
		}
	});
	$('#fechaRegreso').datepicker('option', 'onSelect', function(){$(this).valid();});
	
	$('#provincia').change(function(){
		if ($(this).children('option').eq(0).prop('selected') == false) {
			loadCiudadByProvincia($(this).val());
			$('#ciudad').prop('disabled', false);
		} else {
			$('#ciudad').prop('disabled', true);
			$('#ciudad option').eq(0).prop('selected',true);
		}
	});
	
	$('#filtroCiudad').click(function(){
		$('#divPcia').hide();
		$('#provincia option').eq(0).prop('selected',true);
		$('#ciudad').prop('disabled', false);
		loadCiudades();
	});
	
	$('#filtroProvincia').click(function(){
		$('#divPcia').show();
		$('#provincia').prop('disabled', false);
		$('#ciudad').prop('disabled', true);
		$('#ciudad option').eq(0).prop('selected',true);
		loadProvincias();
	});
	
	$('#clase').change(function(){
		if ($(this).children('option').eq(0).prop('selected') == false) {
			$('#circuito').show();
			$('#ida, #vuelta').prop('disabled', false);
			$('#ida, #vuelta').prop('checked', false);
			$('#claseHidden').val($(this).val());
		} else {
			$('#circuito').hide();
			$('#ida, #vuelta').prop('checked', false);
			$('#ida, #vuelta').prop('disabled', true);
			$('#fecha_partida').hide();
			$('#fecha_regreso').hide();
			resetFechas();
			$('#botonVerifica').hide();
		}
	});
	
	$('#ida, #vuelta').click(function(){
		resetFechas();
		if ($(this).prop('id') == 'ida') {
			$('#fechaPartida').prop('disabled', false);
			$('#fecha_partida').show();
			$('#fecha_regreso').hide();
		} else {
			$('#fechaPartida').prop('disabled', false);
			$('#fecha_partida').show();
			$('#fecha_regreso').show();
		}
		$('#botonVerifica').show();
	});
	
	$('#logIn').click(function(){
		$('#divCancelarBusqueda').dialog({
			buttons: [{
				text: 'Cancelar busqueda y consultar reserva',
				click: function () {
					window.location.href = './formVerificarReserva.php';
					$(this).dialog('close');
				}
			},{
				text: 'Continuar con la busqueda',
				click: function () {
					$(this).dialog('close');
				}
			}],
			modal: true,
			width: 750
		});
	});
	
	blockAndResetFields();
});

function blockAndResetFields () {
	resetFechas();
	$('#ruta option').eq(0).prop('selected',true);
	$('#destino, #origen').val('');
	$('#ida, #vuelta').prop('checked', false);
	
	$('#ida, #vuelta').prop('disabled', true);
	$('#provincia option').eq(0).prop('selected',true);
	$('#ciudad option').eq(0).prop('selected',true);
}

function resetFechas () {
	$('#fechaPartida, #fechaRegreso').val('');
	$('#fechaPartida, #fechaRegreso').prop('disabled', true);
}

function resetBuscadorAeropuertoFields () {
	$('#filtroCiudad').prop('checked', true);
	$('#filtroProvincia').prop('checked', false);
	$('#divPcia').hide();
	$('#ciudad option').eq(0).prop('selected',true);
	$('#provincia').prop('disabled', true);
	$('#ciudad').prop('disabled', false);
}

function loadCiudades () {
	$.ajax({
		beforeSend: function () {
			mostrarDialogoCarga();
		},
		data: {
			requestType: 'ciudadSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		$('#ciudad').children('option').remove();
		$('#ciudad').append(createEmptyOption());
		$(data.respuesta).each(function(){
			var ciudad = this.nombre_ciudad + ' (' + this.nombre_provincia + ')';
			$('#ciudad').append(makeOption(this.id_ciudad, ciudad));
		});
		$('#cargando').dialog('close');
	});
}

function loadProvincias () {
	$.ajax({
		beforeSend: function () {
			mostrarDialogoCarga();
		},
		data: {
			requestType: 'provinciaSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		$('#provincia').children('option').remove();
		$('#provincia').append(createEmptyOption());
		$(data.respuesta).each(function(){
			$('#provincia').append(makeOption(this.id_provincia, this.nombre));
		});
		$('#cargando').dialog('close');
	});
}

function loadCiudadByProvincia (id_provincia) {
	$.ajax({
		beforeSend: function () {
			mostrarDialogoCarga();
		},
		data: {
			idProvincia : id_provincia,
			requestType: 'ciudadByProvinciaSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		$('#ciudad').children('option').remove();
		$('#ciudad').append(createEmptyOption());
		$(data.respuesta).each(function(){
			$('#ciudad').append(makeOption(this.id_ciudad, this.nombre));
		});
		$('#cargando').dialog('close');
	});
}

function mostrarDialogoAeropuerto (event) {
	$('#dialogBuscarAeropuerto').dialog({
		buttons: [{
			text: 'Aceptar',
			click: function(){
				if ($('#formBuscarAeropuerto').valid()) {
					var idBoton = $(event.target).prop('id');
					var texto = '';
					
					if ($('#filtroCiudad').prop('checked') == true) {
						texto = $('#ciudad option:selected').text();
					} else {
						texto = $('#ciudad option:selected').text() + ' (' + $('#provincia option:selected').text() + ')';
					}
					
					if (idBoton == 'buscarDestino') {
						$('#destino').val(texto);
						$('#destino_hidden').val($('#ciudad option:selected').val());
						$('#destino').valid();
					} else {
						$('#origen').val(texto);
						$('#origen_hidden').val($('#ciudad option:selected').val());
						$('#origen').valid();
					}
					
					if ($('#destino').val() != '' && $('#origen').val() != '') {
						loadListaVuelos($('#origen_hidden').val(), $('#destino_hidden').val());
					}
					
					$(this).dialog('close');
				}
			},
			open: function () {
				loadCiudades();
			}
		},{
			text: 'Cancelar',
			click: function(){
				$(this).dialog('close');
			}
		}],
		modal: true,
		width: 750
	});
}

function loadListaVuelos (origen, destino) {
	$.ajax({
		data: {
			origen: origen,
			destino: destino,
			requestType: 'vuelosByOrigenDestinoSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		
		$('#divRuta').hide();
		$('#divClase').hide();
		$('#circuito').hide();
		$('#fecha_partida').hide();
		$('#fecha_regreso').hide();
		$('#botonVerifica').hide();
		
		$('#tablaVuelos tbody').children().remove();
		
		if (!$.isEmptyObject(data.respuesta)) {
			$(data.respuesta).each(function(){
				$('#tablaVuelos tbody').append('<tr></tr>');
				$('#tablaVuelos tbody tr').last().append(
					'<td>' +
						this.aeropuerto_origen + ',<br>' +
						this.ciudad_origen + ' (' + this.provincia_origen + ')' +
					'</td><td>' +
						this.aeropuerto_destino + ',<br>' +
						this.ciudad_destino + ' (' + this.provincia_destino + ')' +
					'</td>' +
					'<td>' +
						'<input type="button" id="' + this.numero_vuelo + '" value="Seleccionar\nvuelo" />' +
					'</td>'
				);
				
				$('#tablaVuelos').find('input[type="button"]').each(function(){
					$(this).click(function(){
						$(this).parent().parent().css('background-color', 'blue');
						$('#vuelo').val($(this).prop('id'));
						loadClasesVuelo($(this).prop('id'));
						loadFrecuencia($(this).prop('id'));
					});
				});
			});
			$('#destino_hidden').val(data.respuesta[0].codigo_oaci_destino);
			$('#origen_hidden').val(data.respuesta[0].codigo_oaci_origen);
			$('#divRuta').show();
			
		} else {
			$('#divRuta').hide();
		}
		
		$('#tablaVuelos tbody tr').css('background-color', '');
	});
}

function loadClasesVuelo (numeroVuelo) {
	$.ajax({
		data: {
			numeroVuelo: numeroVuelo,
			requestType: 'clasesByVueloSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		$('#clase').children('option').remove();
		$('#clase').append(createEmptyOption());
		$(data.respuesta).each(function(){
			$('#clase').append(makeOption(this.id_clase_vuelo, this.nombre + ' (Precio: $ ' + this.precio + ')'));
		});
	});
}

function loadFrecuencia (numeroVuelo) {
	$.ajax({
		data: {
			numeroVuelo: numeroVuelo,
			requestType: 'frecuenciaByVueloSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
			$('#fechaPartida, #fechaRegreso').datepicker('option', 'beforeShowDay', function(fecha) {
					return parseFrecuencia(data.respuesta[0].frecuencia, fecha);
			});
			$('#divClase').show();
	});
}

function parseFrecuencia (frecuencia, fecha) {
	var dias = [];
	var dia = fecha.getDay();
	
	if (/D/.test(frecuencia) && dia == 0) {
		return [true];
	} else if (/L/.test(frecuencia) && dia == 1) {
		return [true];
	} else if (/A/.test(frecuencia) && dia == 2) {
		return [true];
	} else if (/I/.test(frecuencia) && dia == 3) {
		return [true];
	} else if (/J/.test(frecuencia) && dia == 4) {
		return [true];
	} else if (/V/.test(frecuencia) && dia == 5) {
		return [true];
	} else if (/S/.test(frecuencia) && dia == 6) {
		return [true];
	} else {
		return [false];
	}	
}