<html>
	<head>
		<title>.:: Estado de reserva ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/verificarReserva.php" id="formVerificarReserva" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Estado de reserva</div>
					<div class="busca_vue">	
						<div class="reserva">
							<label class="nombreItem">C&oacute;digo reserva:</label>&nbsp;<input type="text" maxlength="8" id="reserva" name="reserva"/>
						</div>
						<BR>
						<div class="boton">
							<div class="imprime">
								<input type="submit" name="submit" value="Verificar de estado reserva"/>
								<input type="reset" value="Borrar Datos"/>
							</div>
						</div>							
					</div>
				</div>
			</form>	
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#formVerificarReserva').validate({
					rules: {
						reserva: {
							minlength: 8,
							maxlength: 8,
							required: true
						}
					},
					messages: {
						reserva: 'Ingrese su codigo de reserva.'
					}
				});
			});
		</script>
	</body>
</html>