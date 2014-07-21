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
							<div class="imprime"><input type="submit" value="Cerrar" />
						</div>							
					</div>
				</div>
			</form>	
		</div>
	</body>
</html>