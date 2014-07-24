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
					<div class="boarding_pass">Pasaje y Boarding Pass</div>
					<div class="busca_vue">
						<div>
							<div class="imprime">
								<label class="nombreItem">Boarding Pass</label>
								<input name="impr_board" type="submit" value="Imprimir" />
								<input name="save_board" type="submit" value="Guardar" /><br>
								<label class="nombreItem">Pasaje</label>
								<input name="impr_pasaj" type="submit" value="Imprimir" />
								<input name="save_pasaj" type="submit" value="Guardar" />
							</div><br>
							<div class="boton">
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
			});
		</script>
	</body>
</html>