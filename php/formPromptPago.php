<html>
	<head>
		<title>.:: Pagar Pasaje ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<div class="encabezado">
				<div class="busca_vuelo">Su reserva ha sido verificada, aceptada y completada</div>
				<div class="busca_vue">
					<div id="muestraCodReserva">
						
					</div>
					<div class="boton">
						<input type="button" id="imprimirReserva" value="Imprimir Resumen Reserva"/>
					</div>
					<div class="boton">
						<div class="pagar_imprimir">
						<hr>
							<input type="button" id="ahora" name="ahora" value="Pagar ahora"/>
							<input type="button" id="despues" name="despues" value="Pagar despues"/>
						</div>
					</div>							
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#ahora').click(function(){
					window.location.href = "./formPagoPasaje.php";
				});
				
				$('#despues').click(function(){
					window.location.href = "./formBuscadorVuelo.php";
				});
				
				loadCodigoReserva();
			});
			
			function loadCodigoReserva () {
				$.ajax({
					data: {
						requestType: 'codigoReservaSelect',
						verify: 'valid'
					},
					dataType: 'json',
					type: 'post',
					url: './action/ajaxRequestAndResponse.php'
				}).done(function(data){
					$('#muestraCodReserva').text('Su codigo de reserva es: ' + data.respuesta[0].codigo_reserva);
				});
			}
		</script>
	</body>
</html>