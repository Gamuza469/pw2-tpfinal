<html>
	<head>
		<title>.:: Imprimir Pasaje y Boarding Pass ::.</title>
		<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
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
							</div>
						</div>							
					</div>
				</div>
			</form>	
		</div>
	</body>
</html>