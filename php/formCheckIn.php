<html>
	<head>
		<title>.:: Check-In ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/elegirAsientos.php" id="formCheckIn" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Check-In (Selecci&oacute;n de Asiento)</div>
					<div class="busca_vue">
						<div class="asientos">
						</div>
						<div class="boton">
							<div class="asiento_seleccion"><input name="submit" type="submit" value="Elegir Asiento" />
							<input type="button" value="Borrar Selecci&oacute;n" /></div>
						</div>							
					</div>
				</div>
			</form>	
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				
			});
		</script>
	</body>
</html>