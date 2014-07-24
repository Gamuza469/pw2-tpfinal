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
		<script src="../js/formBuscadorVuelo.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/procesarVuelo.php" id="formBuscadorVuelo" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Buscador de Vuelo</div>
					<div class="busca_vue">
						<div class="destino">
							<label class="nombreItem">Destino:</label>&nbsp;<textarea id="destino" name="destino" maxlength="128" readonly></textarea>&nbsp;
							<input type="button" id="buscarDestino" name="buscarDestino" value="Buscar Destino"/>
						</div>
						<div class="origen">
							<label class="nombreItem">Origen:</label>&nbsp;<textarea id="origen" name="origen" maxlength="128" readonly></textarea>&nbsp;
							<input type="button" id="buscarOrigen" name="buscarOrigen" value="Buscar Origen"/>
						</div>
						<div class="circuito">
							<label class="nombreItem">Circuito:</label>
							<label>Ida</label><input type="radio" disabled name="idaVuelta" id="ida" value="ida"/>
							<label>Ida/Vuelta</label><input type="radio" disabled name="idaVuelta" id="vuelta" value="vuelta"/>
						</div>
						<div class="fecha_partida">
							<label class="nombreItem">Fecha Partida:</label>&nbsp;<input type="text" disabled id="fechaPartida" name="fechaPartida" readonly />
						</div>	
						<div id="fecha_regreso">
							<label class="nombreItem">Fecha Regreso:</label>&nbsp;<input type="text" disabled id="fechaRegreso" name="fechaRegreso" readonly />
						</div>
						<br>
						<div class="boton">
							<div class="verifica"><input name="submit" type="submit" value="Verificar" /></div>
							<BR>
							<input id="logIn" type="button" value="Realizar Log-In"/>
						</div>
						<div>
							<input id="destino_hidden" name="destino_hidden" value="ABCD" type="hidden">
							<input id="origen_hidden" name="origen_hidden" value="ABCD" type="hidden">
						</div>
					</div>
				</div>
			</form>
			<div id="dialogBuscarAeropuerto" title="Seleccione ubicaci&oacute;n:">
				<form id="formBuscarAeropuerto">
					<div class="pcia">
						<label class="nombreItem">Provincia:</label>
						<select id="provincia" name="provincia">
							 <option value="" selected>Seleccione...</option>
							 <option>1</option>
							 <option>2</option>
							 <option>3</option>									 
						 </select>
					</div>
					<div class="ciudad">
						<label class="nombreItem">Ciudad:</label>
						<select disabled id="ciudad" name="ciudad">
							 <option value="" selected>Seleccione...</option>
							 <option>1</option>
							 <option>2</option>
							 <option>3</option>
						 </select>
					</div>
					<div class="aeropuerto">
						<label class="nombreItem">Aeropuerto:</label>
						<select disabled id="aeropuerto" name="aeropuerto">
							 <option value="" selected>Seleccione...</option>
							 <option>1</option>
							 <option>2</option>
							 <option>3</option>
						 </select>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>