<html>
	<head>
		<?php
			//Lógica principal
			//Lógica de sesión
			//Manejo de errores
		?>
		<title>.:: Buscador de Vuelo ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/procesarVuelo.php" id="formBuscadorVuelo" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Buscador de Vuelo</div>
					<div class="busca_vue">
						<div class="destino">
							<label class="nombreItem">Destino:</label>&nbsp;<textarea id="destino" name="destino" readonly>asdas</textarea>&nbsp;
							<input type="button" id="buscarDestino" maxlength="128" name="buscarDestino" value="Buscar Destino"/>
						</div>
						<div class="origen">
							<label class="nombreItem">Origen:</label>&nbsp;<textarea id="origen" name="origen" readonly>asdas</textarea>&nbsp;
							<input type="button" id="buscarOrigen" maxlength="128" name="buscarOrigen" value="Buscar Origen"/>
						</div>
						<div class="fecha_partida">
							<label class="nombreItem">Fecha Partida:</label>&nbsp;<input type="text" id="fechaPartida" name="fechaPartida"/>
						</div>	
						<div class="fecha_regreso">
							<label class="nombreItem">Fecha Regreso:</label>&nbsp;<input type="text" id="fechaRegreso" name="fechaRegreso"/>
						</div>
						<div class="circuito">
							<label class="nombreItem">Circuito:</label>
							<label>Ida</label><input type="radio" name="idaVuelta[]" id="ida" value="ida"/>
							<label>Ida/Vuelta</label><input type="radio" name="idaVuelta[]" id="vuelta" value="vuelta"/>
						</div>
						<br>
						<div class="boton">
							<div class="verifica"><input name="submit" type="submit" value="Verificar" /></div>
						</div>
						<?php
							echo('<input id="destino_hidden" name="destino_hidden" value="'."ABCD".'" type="hidden">');
							echo('<input id="origen_hidden" name="origen_hidden" value="'."ABCD".'" type="hidden">');
						?>						
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
						'idaVuelta[]': {
							required: true
						}
					},
					messages: {
						destino: 		'Ingrese el destino.',
						origen:			'Ingrese el origen.',
						fechaPartida:	'Especifique la fecha de partida.',
						fechaRegreso:	'Especifique la fecha de regreso.',
						'idaVuelta[]':		'Especifique la ruta del vuelo.'
					}
				});
			});
		</script>
	</body>
</html>