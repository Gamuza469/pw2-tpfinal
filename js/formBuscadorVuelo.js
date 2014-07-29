$(document).ready(function(){
	$.ajax({
		data: {hola: 'hola'},
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		//alert('jaja');
		alert(data);
	});
	
	$('#formBuscadorVuelo').validate({
		rules: {
			destino: {
				required: true
			},
			origen: {
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
			fechaPartida: 'Especifique la fecha de partida.',
			fechaRegreso: 'Especifique la fecha de regreso.',
			idaVuelta: 'Especifique la ruta del vuelo.'
		},
		//submitHandler: function(form) {
			//Reformatea fechas
			//form.submit();
		//}
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
		$('#provincia option').eq(0).prop('selected',true);
		$('#dialogBuscarAeropuerto').dialog({
			buttons: [{
				text: 'Aceptar',
				click: function(){
					if ($('#formBuscarAeropuerto').valid()) {
						var idBoton = $(event.target).prop('id');
						if (idBoton == 'buscarDestino') {
							$('#destino').val('El aeropuerto de alla');
							$('#destino_hidden').val('GGGG');
							$('#destino').valid();
						} else {
							$('#origen').val('El aeropuerto de aca');
							$('#origen_hidden').val('ASDF');
							$('#origen').valid();
						}
						
						if ($('#destino').val() != '' && $('#origen').val() != '') {
							$('#divRuta').show();
						}
						
						$(this).dialog('close');
					}
				}
			},{
				text: 'Cancelar',
				click: function(){
					$(this).dialog('close');
				}
			}],
			modal: true,
			width: 500
		});
	});
	
	$('#fechaPartida, #fechaRegreso').datepicker({
		/*,*/
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
	$('#fechaPartida, #fechaRegreso').datepicker('option', 'beforeShowDay', function(fecha) {
		var dia = fecha.getDay();
		var habilitarDia = [(dia != 1 && dia != 2)];
		return habilitarDia;
	});
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
		$('#ciudad option').eq(0).prop('selected',true);
	});
	
	$('#filtroProvincia').click(function(){
		$('#divPcia').show();
		$('#provincia').prop('disabled', false);
		$('#ciudad').prop('disabled', true);
		$('#ciudad option').eq(0).prop('selected',true);
	});
	
	$('#ruta').change(function(){
		if ($(this).children('option').eq(0).prop('selected') == false) {
			$('#circuito').show();
			$('#ida, #vuelta').prop('disabled', false);
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
		window.location.href = './formVerificarReserva.php';
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