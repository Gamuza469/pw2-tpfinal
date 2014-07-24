<html>
	<head>
		<title>.:: Pago Realizado ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/despuesPagar.php" id="formPagoRealizado" method="post">
				<div class="encabezado">
					<div class="boarding_pass">Su pago ha sido registrado</div>
					<div class="busca_vue">
						<div class="boton">
							<div class="imprime"><input type="submit" value="Cerrar" /><input id="close" type="button" value="Cerrar (sin PHP)" /><input id="check" type="button" value="Check-In" /></div>
						</div>							
					</div>
				</div>
			</form>	
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