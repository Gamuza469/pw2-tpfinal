<html>
	<head>
		<title>.:: Pago Realizado ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<div class="encabezado">
				<div class="boarding_pass">Su pago ha sido registrado</div>
				<div class="busca_vue">
					<div class="boton">
						<input type="button" id="imprimirPago" value="Imprimir Comprobante de Pago"/>
					</div>
					<div class="boton">
						<div class="imprime"><input id="close" type="button" value="Cerrar" /><input id="check" type="button" value="Realizar Check-In" /></div>
					</div>							
				</div>
			</div>
		</div>
		<script	type="text/javascript">
			$(document).ready(function(){
				$('#close').click(function(){
					window.location.href = '../index.php';
				});
				
				$('#check').click(function(){
					window.location.href = './formCheckIn.php';
				});
			});
		</script>
	</body>
</html>