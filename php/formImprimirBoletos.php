<html>
	<head>
		<title>.:: Imprimir Pasaje y Boarding Pass ::.</title>
		<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/imprimirBoletos.php" id="formImprimirBoletos" method="POST" enctype="text/plain">
				<div class="encabezado">
					<div class="boarding_pass">Pasaje y Boarding Pass</div>
					<div class="busca_vue">
						<div class="boton">
							<div class="imprime"><input type="submit" value="Imprimir Boarding Pass" />
							<input type="submit" value="Imprimir Pasaje" /></div>
						</div>							
					</div>
				</div>
			</form>	
		</div>
	</body>
</html>