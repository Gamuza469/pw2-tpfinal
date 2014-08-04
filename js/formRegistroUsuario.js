$(document).ready(function(){
	loadDatosVuelo();
	$('#formRegistroUsuario').validate({
		rules: {
			nombre: {
				required: true,
				maxlength: 256
			},
			apellido: {
				required: true,
				maxlength: 254
			},
			dni: {
				digits: true,
				minlength: 8,
				required: true
			},
			fechaNacimiento: {
				required: true
			},
			email: {
				email: true,
				required: true
			},
			password: {
				minlength: 4,
				maxlength: 32,
				required: true
			},
			confPassword: {
				equalTo: '#password',
				minlength: 4,
				maxlength: 32,
				required: true
			}
		},
		messages: {
			nombre:				'Ingrese su nombre.',
			apellido:			'Ingrese su apellido',
			dni:				'Ingrese su DNI.',
			fechaNacimiento:	'Ingrese su fecha de nacimiento.',
			email:				'Ingrese su direcci&oacute;n de E-Mail.',
			password:			'Especifique una contrase&ntilde;a, m&iacute;nimo 4 caracteres alfanum&eacute;ricos.',
			confPassword:		'Las contrase&ntilde;as no coinciden.'
		}
	});
	
	$('#fechaNacimiento').datepicker({
		buttonImage: '../css/images/calendar.gif',
		buttonImageOnly: true,
		changeMonth: true,
		changeYear: true,
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		dateFormat: 'dd/mm/yy',
		maxDate: "-18y",
		monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		onSelect: function(){
			$(this).valid();
		},
		showOn: "button",
		yearRange: 'c-125:c+0'
	});
	
	$('#cancelarReserva').click(function(){
		$('#divCancelarReserva').dialog({
			buttons: [{
				text: 'Cancelar reserva definitivamente',
				click: function () {
					window.location.href = './formBuscadorVuelo.php';
					$(this).dialog('close');
				}
			},{
				text: 'Continuar con la reserva',
				click: function () {
					$(this).dialog('close');
				}
			}],
			modal: true,
			width: 650
		});
	});
});

function loadDatosVuelo () {
	$.ajax({
		data: {
			requestType: 'datosVueloSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
			createVueloTable(data.respuesta[0]);
			loadOtrosDatos();
	});
}

function createVueloTable (datos) {
	var lugarPartida = datos.aeropuerto_origen + ', ' + datos.ciudad_origen + ',<br>' + datos.provincia_origen + '.';
	var lugarRegreso = datos.aeropuerto_destino + ', ' + datos.ciudad_destino + ',<br>' + datos.provincia_destino + '.';

	var $tbody = $('#datosVuelo tbody');
	$tbody.append('<tr></tr>');
	$tbody.children().last().append('<td>Lugar de partida:<br>' + lugarPartida + '</td>');
	$tbody.children().last().append('<td>Lugar de arrivo:<br>' + lugarRegreso + '</td>');
	$tbody.append('<tr></tr>');
	$tbody.children().last().append('<td colspan="2">Fecha de partida:</td>');
	$tbody.append('<tr></tr>');
	$tbody.children().last().append('<td>Clase:<br>' + datos.nombre_clase + '</td>');
	$tbody.children().last().append('<td>Precio:<br>$ ' + datos.precio + '</td>');
	
	$('#datosVuelo').parent().after('<div></div>');
	
}

function loadOtrosDatos () {
	$.ajax({
		data: {
			requestType: 'fechaPartidaArrivo',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
			var $tr = $('#datosVuelo tbody tr').eq(1);
			var datos = data.respuesta[0];
			var stringIdaVuelta = 'El viaje consiste en ';
			
			$tr.children().remove();
			
			if (datos.idaVuelta == 1) {
				$tr.append('<td>Fecha de partida:<br>' + datos.fechaPartida + '</td>');
				$tr.append('<td>Fecha de regreso:<br>' + datos.fechaRegreso + '</td>');
				stringIdaVuelta += 'ida y vuelta.';
			} else {
				$tr.append('<td colspan="2">Fecha de partida: ' + datos.fechaPartida + '</td>');
				stringIdaVuelta += 'ida solamente.';
			}
			
			$tr.parent().parent().parent().after('<div>' + stringIdaVuelta + '</div>');
	});
}