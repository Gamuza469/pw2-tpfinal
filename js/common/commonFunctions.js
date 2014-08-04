function createEmptyOption () {
	return '<option value="" selected>Seleccione...</option>';
}

function makeOption (value, text) {
	return '<option value="' + value + '">' + text + '</option>';
}

function mostrarDialogoCarga () {
	$('#cargando').dialog({
		close: function () {
			return false;
		},
		modal: true
	});
}

function fechaDeHoy () {
	var fechaHoy = new Date();
	var dia = fechaHoy.getUTCDate();
	var mes = fechaHoy.getUTCMonth() + 1;
	var anio = fechaHoy.getUTCFullYear();
	
	var agregaDiaCero = (dia < 10 ? '0' : '');
	var agregaMesCero = (mes < 10 ? '0' : '');
	
	var fechaCompleta = agregaDiaCero + dia.toString() + '/' + agregaMesCero + mes.toString() + '/' + anio.toString();
	
	return fechaCompleta;
}

function fechaStringToDateObject (fechaString) {
	var fechaArray = fechaString.split('/');
	var fechaObject = new Date (parseInt(fechaArray[2], 10), parseInt(fechaArray[1], 10) - 1, parseInt(fechaArray[0], 10), 0, 0, 0, 0);
	return fechaObject;
}

function evaluarFechas (fechaInicial, fechaFinal, evaluarHoras) {
	 //var fechaInicialObject = fechaStringToDateObject(fechaInicial);
	 var fechaInicialObject = new Date();
	 var fechaFinalObject = fechaStringToDateObject(fechaFinal);
	 	 
	 var resultadoDia = '';
	 var resultadoMes = '';
	 var resultadoAnio = '';
	 var resultadoHoras = '';
	 var resultadoGeneral = '';
	 
	 if (fechaInicialObject.getUTCFullYear() == fechaFinalObject.getUTCFullYear()) {
		resultadoAnio = 'iguales';
		if (fechaInicialObject.getUTCMonth() == fechaFinalObject.getUTCMonth()) {
			resultadoMes = 'iguales';
			if (fechaInicialObject.getUTCDate() == fechaFinalObject.getUTCDate()) {
				resultadoDia = 'iguales';
				resultadoGeneral = 'iguales';
			}
		}
	 }
	 
	
	if (resultadoDia != 'iguales') {
		resultadoGeneral = (fechaInicialObject.getUTCDate() > fechaFinalObject.getUTCDate() ? 'mayor' : 'menor');
	}
	if (resultadoMes != 'iguales') {
		resultadoGeneral = (fechaInicialObject.getUTCMonth() > fechaFinalObject.getUTCMonth() ? 'mayor' : 'menor');
	}
	if (resultadoAnio != 'iguales') {
		resultadoGeneral = (fechaInicialObject.getUTCFullYear() > fechaFinalObject.getUTCFullYear() ? 'mayor' : 'menor');
	}
	if (evaluarHoras == true) {
		resultadoGeneral = fechaInicialObject.getUTCHours() - fechaFinalObject.getUTCHours();
	}
	 
	 return resultadoGeneral;
}

function evaluarFechasDias (fechaInicial, fechaFinal) {
	 var fechaInicialObject = new Date();
	 var fechaFinalObject = fechaStringToDateObject(fechaFinal);
	 
	 return fechaFinalObject.getUTCDate() - fechaInicialObject.getUTCDate();
}

function formatUTCDateToBSAS (fecha) {
	var arrayFecha = fecha.split('-');
	var fechaFormatoBSAS = arrayFecha[2] + '/' + arrayFecha[1] + '/' + arrayFecha[0];
	return fechaFormatoBSAS;
}