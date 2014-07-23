$(document).ready(function(){
	$('#formReservarPasaje').validate({
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
		maxDate: "+0d",
		monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		onSelect: function(){
			$(this).valid();
		},
		showOn: "button",
		yearRange: 'c-125:c+0'
	});
});