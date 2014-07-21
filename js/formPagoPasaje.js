$(document).ready(function(){
	$('#formPagoPasaje').validate({
		rules: {
			medioPago: {
				required: true
			}
		},
		messages: {
			medioPago: 'Seleccione un medio de pago.'
		}
	});
	
	$('#medioPago').change(function(){
		resetAllFields();
		removeAllRules();
		
		var medioPago = $(this).children('option:selected').val();
		if (medioPago == 'TARC' || medioPago == 'TARD') {
			addTarjetaRules();
			$('#bancos').show();
		} else if (medioPago == 'PAGT' || medioPago == 'PAGE') {
			addServicioRules();
			$('#servicios').show();
		} else if (medioPago == 'TRAB') {
			addTransferenciaRules();
			$('#bancos').show();
		} else {
			$('#efect').show();
		}
	});
	
	$('#banco').change(function(){
		var medioPago = $('#medioPago').children('option:selected').val();
		if (medioPago == 'TARC' || medioPago == 'TARD') {
			$('#cia_emisora').show();
		} else {
			$('#nro_cuenta').show();
		}
		
	});
	
	$('#emisor').change(function(){
		$('#formas_pago').show();
	});
	
	$('#formaPago').change(function(){
		$('#nro_tarj').show();
		$('#nro_ident').show();
	});
});

function resetAllFields () {
	$('#bancos').hide();
	$('#cia_emisora').hide();
	$('#formas_pago').hide();
	$('#servicios').hide();
	
	$('#banco option').eq(0).prop('selected',true);
	$('#emisor option').eq(0).prop('selected',true);
	$('#formaPago option').eq(0).prop('selected',true);
	$('#servicio option').eq(0).prop('selected',true);
	
	$('#nro_tarj').hide();
	$('#nro_ident').hide();
	$('#nro_cuenta').hide();
	
	$('#nroTarjeta').val('');
	$('#nroIdentificador').val('');
	$('#nroCuenta').val('');
	
	$('#efect').hide();
}

function removeAllRules () {
	$('#banco').rules('remove');
	$('#emisor').rules('remove');
	$('#formaPago').rules('remove');
	$('#servicio').rules('remove');
	$('#nroTarjeta').rules('remove');
	$('#nroIdentificador').rules('remove');
	$('#nroCuenta').rules('remove');
}

function addTarjetaRules () {
	$('#banco').rules('add',{
		required: true,
		messages: {
			required: 'Seleccione un banco.'
		}
	});
	
	$('#emisor').rules('add',{
		required: true,
		messages: {
			required: 'Seleccione un emisor.'
		}
	});
	
	$('#formaPago').rules('add',{
		required: true,
		messages: {
			required: 'Seleccione una forma de pago.'
		}
	});
	
	$('#nroTarjeta').rules('add',{
		required: true,
		digits: true,
		minlength: 16,
		messages: {
			required: 'Escriba su n&uacute;mero de tarjeta.',
			digits: 'S&oacute;lo se aceptan caracteres num&eacute;ricos.',
			minlength: 'Por favor ingrese los 16 (dieciseis) d&iacute;gitos de su tarjeta.'
		}
	});
	
	$('#nroIdentificador').rules('add',{
		required: true,
		digits: true,
		minlength: 3,
		messages: {
			required: 'Escriba el n&uacute;mero identificador de su tarjeta.',
			digits: 'S&oacute;lo se aceptan caracteres num&eacute;ricos.',
			minlength: 'Por favor ingrese los 3 (tres) d&iacute;gitos del n&uacute;mero identificador de su tarjeta.'
		}
	});
}

function addServicioRules () {
	$('#servicio').rules('add',{
		required: true,
		messages: {
			required: 'Seleccione un prestador de servicios.'
		}
	});
}

function addTransferenciaRules () {
	$('#nroCuenta').rules('add',{
		required: true,
		digits: true,
		minlength: 22,
		messages: {
			required: 'Escriba el n&uacute;mero de su C.B.U..',
			digits: 'S&oacute;lo se aceptan caracteres num&eacute;ricos.',
			minlength: 'Por favor ingrese los 22 (veintidos) d&iacute;gitos de su C.B.U..'
		}
	});
}