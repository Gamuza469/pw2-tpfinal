<html>
	<head>
		<title>.:: Buscador de Vuelo ::.</title>
		<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery.validate.js"></script>
		<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/procesarVuelo.php" id="formBuscadorVuelo" method="POST" enctype="text/plain">
				<div class="encabezado">
					<div class="busca_vuelo">Buscador de Vuelo</div>
					<div class="busca_vue">
						<div class="destino">
							<label class="nombreItem">Destino:</label>&nbsp;<input type="text" id="destino" name="destino"/>&nbsp;
							<input type="button" id="buscarDestino" name="buscarDestino" value="Buscar Destino"/>
						</div>
						<div class="origen">
							<label class="nombreItem">Origen:</label>&nbsp;<input type="text" id="origen" name="origen"/>&nbsp;
							<input type="button" id="buscarOrigen" name="buscarOrigen" value="Buscar Origen"/>
						</div>
						<div class="fecha_partida">
							<label class="nombreItem">Fecha Partida:</label>&nbsp;<input type="text" id="fechaPartida" name="fechaPartida"/>
						</div>	
						<div class="fecha_regreso">
							<label class="nombreItem">Fecha Regreso:</label>&nbsp;<input type="text" id="fechaRegreso" name="fechaRegreso"/>
						</div>
						<div class="circuito">
							<label class="nombreItem">Circuito:</label>
							<label>Ida</label><input type="radio" name="idaVuelta" id="ida" value="ida"/>
							<label>Ida/Vuelta</label><input type="radio" name="idaVuelta" id="vuelta" value="vuelta"/>
						</div>
						<br>
						<div class="boton">
							<div class="verifica"><input type="submit" value="Verificar" /></div>
						</div>							
					</div>
				</div>
			</form>
		</div>		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#formBuscadorVuelo').validate({
					rules: {
						destino: {
							required: true
						},
						origen: {
							required: true
						},
						fechaPartida: {
							required: true
						},
						fechaRegreso: {
							required: true
						},
						idaVuelta: {
							required: true
						}
					},
					messages: {
						destino: 		'Ingrese el destino.',
						origen:			'Ingrese el origen.',
						fechaPartida:	'Especifique la fecha de partida.',
						fechaRegreso:	'Especifique la fecha de regreso.',
						idaVuelta:		'Especifique la ruta del vuelo.'
					}
				});
			});
		</script>
	</body>
</html>