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
							Bienvenido Berruezo, Dami&aacute;n.<br>
							Su c&oacute;digo de reserva es: <span id="codigoReserva"></span><br>
							El estado de su reserva es: <span id="estadoReserva"></span>
						</div>
						<div>
							Acci&oacute;n recomendada:<br>
							<span id="accionRec">Realizar check-in a partir de las 48hs. anteriores al d&iacute;a del vuelo.</span>
						</div>
						<div>
							Imprimir comprobantes:<br>
							<span id="comprobantes">
								<input type="submit" id="impReserva" name="impReserva" value="Comprobante de reserva"/><br>
								<input type="submit" id="impPago" name="impPago" value="Comprobante de pago"/><br>
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
					var fechaHoy = fechaDeHoy();
					var fechaPartida = formatUTCDateToBSAS(datos.fecha_partida);
					var evaluaFechas = evaluarFechas(fechaHoy, fechaPartida, false);
					var evaluaFechasConHora = evaluarFechas(fechaHoy, fechaPartida, true);
					
					console.log(fechaHoy);
					console.log(fechaPartida);
					console.log(evaluaFechas);
					console.log(evaluaFechasConHora);
					$('#codigoReserva').text(datos.codigo_reserva);
					
					if (datos.pagado == 0 && datos.checked_in != -1 && (evaluaFechas == 'menor' || (evaluaFechas == 'iguales' && evaluaFechasConHora >= 2))) {
						estado = 'Reserva pendiente de pago.';
					} else if (datos.pagado == 0 && (evaluaFechas == 'mayor' || (evaluaFechas == 'iguales' && evaluaFechasConHora < 2))) {
						estado = 'Reserva caida.'
					} else if (datos.pagado == 1 && datos.checked_in == 0 && (evaluaFechas == 'menor' || (evaluaFechas == 'iguales' && evaluaFechasConHora >= 2))) {
						estado = 'Pasaje pagado.'
					} else if (datos.pagado == 1 && datos.checked_in == 0 && (evaluaFechas == 'mayor' || (evaluaFechas == 'iguales' && evaluaFechasConHora < 2))) {
						estado = 'Pasaje caido.'
					} else if (datos.pagado == 1 && datos.checked_in == 1) {
						estado = 'Check-In realizado.'
					}
					
					$('#estadoReserva').text(estado);
					
				});
			}
		</script>
	</body>
</html>