<html>
	<head>
		<title>.:: Estado de reserva ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/continuarProceso.php" id="formEstadoReserva" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Estado de reserva</div>
					<div class="busca_vue">	
						<div class="reserva">
							Bienvenido <span id="nombreApellido"></span>.<br><br>
							Su c&oacute;digo de reserva es: <span id="codigoReserva"></span><br><br>
							El estado de su reserva es: <span id="estadoReserva"></span>
						</div>
						<br>
						<div>
							Acci&oacute;n(es) recomendada(s):<br>
							<span id="accionRec"></span>
						</div>
						<br>
						<div>
							<span id="comprobantes">
								Imprimir comprobantes:<br>
							</span>
						</div>
						<BR>						
					</div>
				</div>
			</form>	
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				checkReservaStatus();
			});
			
			function checkReservaStatus () {
				$.ajax({
					data: {
						requestType: 'reservaStatusByCodigoReservaSelect',
						verify: 'valid'
					},
					dataType: 'json',
					type: 'post',
					url: './action/ajaxRequestAndResponse.php'
				}).done(function(data){
					var datos = data.respuesta[0];
					var estado = '';
					var codigoEstado = 0;
					var razon = '';
					var accion = '';
					var imprimir = '';
					
					$('#nombreApellido').text(datos.nombre);
					
					var fechaHoy = fechaDeHoy();
					var fechaPartida = formatUTCDateToBSAS(datos.fecha_partida);
					var evaluaFechas = evaluarFechas(fechaHoy, fechaPartida, false);
					var evaluaFechasConHora = evaluarFechas(fechaHoy, fechaPartida, true);
					var evaluaFechasDias = evaluarFechasDias(fechaHoy, fechaPartida);
					
					$('#codigoReserva').text(datos.codigo_reserva);
					
					if (datos.pagado == 0 && datos.checked_in != -1 && datos.numero_excedente == 0 && (evaluaFechas == 'menor' || (evaluaFechas == 'iguales' && evaluaFechasConHora >= 2))) {
						estado = 'Reserva pendiente de pago.';
						codigoEstado = 0;
					} else if (datos.pagado == 0 && datos.checked_in == 0 && datos.numero_excedente == 0 && (evaluaFechas == 'mayor' || (evaluaFechas == 'iguales' && evaluaFechasConHora < 2))) {
						estado = 'Reserva caida.';
						codigoEstado = 1;
					} else if (datos.pagado == 0 && datos.checked_in == -1 && datos.numero_excedente == 0) {
						estado = 'Reserva caida.';
						codigoEstado = 5;
					} else if (datos.pagado == 1 && datos.checked_in == 0 && datos.numero_excedente == 0 && ((evaluaFechas == 'menor' && evaluaFechasDias > 2) || (evaluaFechas == 'iguales' && evaluaFechasConHora < 2))) {
						estado = 'Pasaje pagado.';
						codigoEstado = 2;
					} else if (datos.pagado == 1 && datos.checked_in == 0 && datos.numero_excedente == 0 && (evaluaFechas == 'mayor' || (evaluaFechas == 'iguales' && evaluaFechasConHora < 2))) {
						estado = 'Pasaje caido.';
						codigoEstado = 3;
					} else if (datos.pagado == 1 && datos.checked_in == 0 && datos.numero_excedente == 0 && ((evaluaFechas == 'menor' && evaluaFechasDias <= 2) || (evaluaFechas == 'iguales' && (evaluaFechasConHora >= 2 && evaluaFechasConHora <= 23)))) {
						estado = 'Esperando check-in.';
						codigoEstado = 6;
					} else if (datos.pagado == 1 && datos.checked_in == 1 && datos.numero_excedente == 0) {
						estado = 'Check-in realizado.';
						codigoEstado = 4;
					} else if (datos.pagado == 0 && datos.checked_in == 0 && datos.numero_excedente > 0 && ((evaluaFechas == 'menor' && evaluaFechasDias > 2) || (evaluaFechas == 'iguales' && evaluaFechasConHora < 2))) {
						estado = 'Reserva en lista de espera.';
						codigoEstado = 7;
					} else if (datos.pagado == 0 && datos.checked_in == 0 && datos.numero_excedente > 0 && ((evaluaFechas == 'menor' && evaluaFechasDias <= 2) || (evaluaFechas == 'iguales' && (evaluaFechasConHora >= 2 && evaluaFechasConHora <= 23)))) {
						estado = 'Reserva en lista de espera.';
						codigoEstado = 8;
					} else if (datos.pagado == 0 && datos.checked_in == 0 && datos.numero_excedente > 0 && (evaluaFechas == 'mayor' || (evaluaFechas == 'iguales' && evaluaFechasConHora < 2))) {
						estado = 'Reserva caida.';
						codigoEstado = 9;
					} else if (datos.pagado == 1 && datos.checked_in == 0 && datos.numero_excedente > 0 && ((evaluaFechas == 'menor' && evaluaFechasDias <= 2) || (evaluaFechas == 'iguales' && (evaluaFechasConHora >= 2 && evaluaFechasConHora <= 23)))) {
						estado = 'Pasaje pagado.';
						codigoEstado = 10;
					} else if (datos.pagado == 1 && datos.checked_in == 1 && datos.numero_excedente > 0) {
						estado = 'Check-in realizado.';
						codigoEstado = 10;
					} else if (datos.pagado == 1 && datos.checked_in == 0 && datos.numero_excedente > 0 && (evaluaFechas == 'mayor' || (evaluaFechas == 'iguales' && evaluaFechasConHora < 2))) {
						estado = 'Pasaje caido.';
						codigoEstado = 11;
					} 
					
					$('#estadoReserva').text(estado);
					
					//alert(codigoEstado);
					
					switch (codigoEstado) {
						case 0:
							accion = '<a href="./formPagoPasaje.php">Pague su reserva ahora</a> e <a href="./pdf/imprimir_reserva.php">imprima su comprobante de reserva</a>.';
							break;
						case 1:
							accion = '<a href="./formBuscadorVuelo.php">Realice una nueva reserva</a>.';
							break;
						case 2:
							accion = 'Realice el check-in 48 hs. antes del vuelo. Mientras tanto <a href="./pdf/imprimir_comp_pago.php">imprima su comprobante de pago</a>.';
							break;
						case 3:
							accion = 'No ha realizado el proceso de check-in y su pasaje ha perdido validez. El monto abonado le ser&aacute; reintegrado previa aplicaci&oacute;n de deducciones.';
							break;
						case 4:
							accion = 'Imprima su <a href="./pdf/imprimir_boarding_dompdf.php">boarding pass</a>. Buen viaje!';
							break;
						case 5:
							accion = 'Su reserva fue cedida a otro pasajero en lista de espera.<br><a href="./formBuscadorVuelo.php">Realice una nueva reserva</a>.';
							break;
						case 6:
							accion = '<a href="./formCheckIn.php">Realice el check-in ahora</a>.';
							break;
						case 7:
							accion = 'Si en las 48 hs. anteriores al vuelo existen reservas sin pagar, se lo habilitara a Ud. a realizar el pago de su pasaje y check-in.';
							break;
						case 8:
							accion = '<a href="./formPagoPasaje.php">Pague su reserva ahora</a> e <a href="./pdf/imprimir_reserva.php">imprima su comprobante de reserva</a>.';
							break;
						case 9:
							accion = '<a href="./formBuscadorVuelo.php">Realice una nueva reserva</a>.';
							break;
						case 10:
							accion = 'Imprima su <a href="./pdf/imprimir_boarding_dompdf.php">boarding pass</a>. Buen viaje!';
							break;
						case 11:
							accion = 'No ha realizado el proceso de check-in y su pasaje ha perdido validez. El monto abonado le ser&aacute; reintegrado previa aplicaci&oacute;n de deducciones.';
							break;
					}
					
					$('#accionRec').append(accion);
					
					switch (codigoEstado) {
						case 0:
						case 7:
						case 8:
							imprimir = '<input type="button" id="impReserva" name="impReserva" value="Comprobante de reserva"/>';
							break;
						case 2:
						case 3:
						case 6:
						case 10:
						case 11:
							imprimir = '<input type="button" id="impReserva" name="impReserva" value="Comprobante de reserva"/><br>' +
								'<input type="button" id="impPago" name="impPago" value="Comprobante de pago"/>';
							break;
						case 4:
							imprimir = '<input type="button" id="impReserva" name="impReserva" value="Comprobante de reserva"/><br>' +
								'<input type="button" id="impPago" name="impPago" value="Comprobante de pago"/><br>' + 
								'<input type="button" id="boardingPass" name="boardingPass" value="Boarding pass"/>';
							break;
					}
					
					switch (codigoEstado) {
						case 0:
						case 8:
							loadVariablesPago();
							break;
					}
					
					$('#comprobantes').append(imprimir);
					
					$('#impReserva').click(function(){
						window.location.href = './pdf/imprimir_reserva.php';
					});
					$('#impPago').click(function(){
						window.location.href = './pdf/imprimir_comp_pago.php';
					});
					$('#boardingPass').click(function(){
						window.location.href = './pdf/imprimir_boarding_dompdf.php';
					});
				});
			}
			
			function loadVariablesPago () {
				$.ajax({
					data: {
						requestType: 'setVariablesPagoSelect',
						verify: 'valid'
					},
					dataType: 'json',
					type: 'post',
					url: './action/ajaxRequestAndResponse.php'
				});
			}
		</script>
	</body>
</html>