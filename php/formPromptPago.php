<html>
	<head>
		<title>.:: Pagar Pasaje ::.</title>
		<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/cuandoPagar.php" id="formPromptPago" method="POST" enctype="text/plain">
				<div class="encabezado">
					<div class="busca_vuelo">Su reserva ha sido verificada, aceptada y completada</div>
					<div class="busca_vue">
						<div class="boton">
							<div class="pagar_imprimir">
								<input type="submit" id="ahora" value="Pagar ahora"/>
								<input type="submit" id="despues" value="Pagar despues"/>
							</div>
						</div>							
					</div>
				</div>
			</form>	
		</div>
	</body>
</html>