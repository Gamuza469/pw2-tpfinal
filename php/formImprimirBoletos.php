<html>
	<head>
		<title>.:: Imprimir Pasaje y Boarding Pass ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/imprimirBoletos.php" id="formImprimirBoletos" method="post">
				<div class="encabezado">
					<div class="boarding_pass">El check-in se ha completado.</div>
					<div class="busca_vue">
						<div>
							<div class="imprime">
								<label class="nombreItem">Imprimir Boarding Pass</label>
								<input id="impr_board" name="impr_board" type="button" value="Imprimir" />
							</div><br>
							<div class="boton">
								<hr>
								<div class="imprime"><input id="close" type="button" value="Salir" /></div>
							</div>	
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
				$('#impr_board').click(function(){
					window.location.href = './pdf/imprimir_boarding_dompdf.php';
				});
			});
		</script>
	</body>
</html>