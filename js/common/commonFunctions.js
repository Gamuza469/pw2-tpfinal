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
		}
	});
}