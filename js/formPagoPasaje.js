$(document).ready(function(){
	loadMontoOriginal();
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
	
	loadMediosPago();
	
	$('#medioPago').change(function(){
		resetAllFields();
		removeAllRules();
		loadMontoOriginal();
		
		var medioPago = $(this).children('option:selected').val();
		if (medioPago == 'TARC' || medioPago == 'TARD') {
			addTarjetaRules();
			loadBancos(medioPago);
			$('#bancos').show();
			$('#cia_emisora').show();
			$('#formas_pago').show();
			$('#nro_tarj').show();
			$('#nro_ident').show();
			$('#banco').prop('disabled', false);
		} else if (medioPago == 'PAGT' || medioPago == 'PAGE') {
			addServicioRules();
			loadServicios(medioPago);
			$('#servicios').show();
			$('#servicio').prop('disabled', false);
		} else if (medioPago == 'TRAB') {
			addTransferenciaRules();
			loadBancos(medioPago);
			$('#bancos').show();
			$('#nro_cuenta').show();
			$('#banco').prop('disabled', false);
		} else if (medioPago == 'EFEC') {
			loadTipoPagoEfectivo(medioPago);
			$('#efect').show();
		}
	});
	
	$('#banco').change(function(){
		var medioPago = $('#medioPago').children('option:selected').val();
		if (medioPago == 'TARC' || medioPago == 'TARD') {
			loadEmpresas(medioPago, $(this).val());
			$('#emisor option').eq(0).prop('selected', true);
			$('#formaPago option').eq(0).prop('selected', true);
			$('#nroTarjeta').val('');
			$('#nroIdentificador').val('');
			
			$('#formaPago').prop('disabled', true);
			$('#nroTarjeta').prop('disabled', true);
			$('#nroIdentificador').prop('disabled', true);
				
			$('#emisor').prop('disabled', false);
		} else {
			loadFormaPagoByBanco(medioPago, $(this).val());
			$('#nroCuenta').prop('disabled', false);
		}
		
	});
	
	$('#emisor').change(function(){
		loadTipoPago($('#medioPago').val(), $('#banco').val(), $(this).val());
		$('#formaPago option').eq(0).prop('selected', true);
		$('#nroTarjeta').val('');
		$('#nroIdentificador').val('');
		
		$('#nroTarjeta').prop('disabled', true);
		$('#nroIdentificador').prop('disabled', true);
	
		$('#formaPago').prop('disabled', false);
	});
	
	$('#formaPago').change(function(){
		loadFormaPago($('#medioPago').val(), $('#banco').val(), $('#emisor').val(), $(this).val());
		setFormaPago($(this).val());
		$('#nroTarjeta').prop('disabled', false);
		$('#nroIdentificador').prop('disabled', false);
	});
	
	$('#servicio').change(function(){
		loadFormaPagoByServicio($('#medioPago').val(), $(this).val());
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
	
	$('#banco').prop('disabled',true);
	$('#emisor').prop('disabled',true);
	$('#formaPago').prop('disabled',true);
	$('#servicio').prop('disabled',true);
	
	$('#nro_tarj').hide();
	$('#nro_ident').hide();
	$('#nro_cuenta').hide();
	
	$('#nroTarjeta').val('');
	$('#nroIdentificador').val('');
	$('#nroCuenta').val('');
	
	$('#nroTarjeta').prop('disabled',true);
	$('#nroIdentificador').prop('disabled',true);
	$('#nroCuenta').prop('disabled',true);
	
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
	$('#banco').rules('add',{
		required: true,
		messages: {
			required: 'Seleccione un banco.'
		}
	});
	
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

function loadMediosPago () {
	$.ajax({
		data: {
			requestType: 'medioPagoSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		$('#medioPago').children('option').remove();
		$('#medioPago').append(createEmptyOption());
		$(data.respuesta).each(function(){
			$('#medioPago').append(makeOption(this.codigo_medio_pago, this.nombre));
		});
	});
}

function loadBancos (medioPago) {
	$.ajax({
		data: {
			medioPago: medioPago,
			requestType: 'bancosByMedioPagoSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		$('#banco').children('option').remove();
		$('#banco').append(createEmptyOption());
		$(data.respuesta).each(function(){
			$('#banco').append(makeOption(this.id_banco, this.nombre_banco));
		});
	});
}

function loadEmpresas (medioPago, banco) {
	$.ajax({
		data: {
			banco: banco,
			medioPago: medioPago,
			requestType: 'empresasByBancoAndMedioPagoSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		$('#emisor').children('option').remove();
		$('#emisor').append(createEmptyOption());
		$(data.respuesta).each(function(){
			$('#emisor').append(makeOption(this.id_empresa_medio_pago, this.nombre_empresa));
		});
	});
}

function loadTipoPago (medioPago, banco, empresa) {
	$.ajax({
		data: {
			banco: banco,
			empresa: empresa,
			medioPago: medioPago,
			requestType: 'tipoPagoByEmpresaAndBancoAndMedioPagoSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		$('#formaPago').children('option').remove();
		$('#formaPago').append(createEmptyOption());
		$(data.respuesta).each(function(){
			$('#formaPago').append(makeOption(this.id_tipo_pago, this.nombre_tipo));
		});
	});
}

function loadServicios (medioPago) {
	$.ajax({
		data: {
			medioPago: medioPago,
			requestType: 'empresasByMedioPagoSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		$('#servicio').children('option').remove();
		$('#servicio').append(createEmptyOption());
		$(data.respuesta).each(function(){
			$('#servicio').append(makeOption(this.id_empresa_medio_pago, this.nombre_empresa));
		});
	});
}

function loadMontoOriginal () {
	if ($('#monto').val() != $('#montoOriginal').val()) {
		$('#monto').val('$ ' + $('#montoOriginal').val()); 
	}
}

function loadFormaPagoByBanco (medioPago, banco) {
	$.ajax({
		data: {
			banco: banco,
			medioPago: medioPago,
			requestType: 'tipoPagoByBancoSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		calculateTotalFee(data.respuesta[0].interes, data.respuesta[0].cuotas);
		setFormaPago(data.respuesta[0].id_forma_pago);
	});
}

function loadFormaPagoByServicio (medioPago, empresa) {
	$.ajax({
		data: {
			empresa: empresa,
			medioPago: medioPago,
			requestType: 'tipoPagoByEmpresaSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		calculateTotalFee(data.respuesta[0].interes, data.respuesta[0].cuotas);
		setFormaPago(data.respuesta[0].id_forma_pago);
	});
}

function calculateTotalFee (interes, cuotas) {
	var montoFinal;
	var valorCuota;
	
	var stringMonto = '';
	
	montoFinal = parseFloat($('#montoOriginal').val());
	cuotas = parseInt(cuotas, 10);
	interes = parseInt(interes, 10);
	
	if (interes > 0) {
		interes = 1 + (interes / 100);
		montoFinal = (montoFinal * interes);
	}
	
	if (cuotas > 1) {
		montoFinal = montoFinal / cuotas;
		stringMonto += cuotas.toString() + ' cuotas de '
	}
	
	$('#monto').val(stringMonto + '$ ' + montoFinal.toFixed(2));
}

function loadFormaPago (medioPago, banco, empresa, tipoPago) {
	$.ajax({
		data: {
			banco: banco,
			empresa: empresa,
			medioPago: medioPago,
			requestType: 'formaPagoByMedioPagoBancoEmpresaTipoSelect',
			tipoPago: tipoPago,
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		calculateTotalFee(data.respuesta[0].interes, data.respuesta[0].cuotas);
		setFormaPago(data.respuesta[0].id_forma_pago);
	});
}

function loadTipoPagoEfectivo (medioPago) {
	$.ajax({
		data: {
			medioPago: medioPago,
			requestType: 'tipoPagoEfectivoSelect',
			verify: 'valid'
		},
		dataType: 'json',
		type: 'post',
		url: './action/ajaxRequestAndResponse.php'
	}).done(function(data){
		setFormaPago(data.respuesta[0].id_forma_pago);
	});
}

function setFormaPago (idFormaPago) {
	$('#formaPagoComun').val(idFormaPago);
}