<html>
	<head>
		<?php
			session_start();
			session_destroy();
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
						<div class="origen">
							<label class="nombreItem">Origen:</label><br><input type="text" id="origen" name="origen" maxlength="128" readonly></textarea>&nbsp;
							<input type="button" id="buscarOrigen" name="buscarOrigen" value="Buscar Origen"/>
						</div>
						<div class="destino">
							<label class="nombreItem">Destino:</label><br><input type="text" id="destino" name="destino" maxlength="128" readonly></textarea>&nbsp;
							<input type="button" id="buscarDestino" name="buscarDestino" value="Buscar Destino"/>
						</div>
						<br>
						<div id="divRuta">
							<table id="tablaVuelos">
								<thead>
									<tr>
										<th class="columnaVuelo">Lugar de Partida</th>
										<th class="columnaVuelo">Lugar de Arrivo</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div id="divClase">
							<label class="nombreItem">Clase:</label>
							<select id="clase">
								<option value="" selected>Seleccione...</option>
							</select>
						</div>
						<div id="circuito">
							<label class="nombreItem">Circuito:</label>
							<label>Ida</label><input type="radio" disabled name="idaVuelta" id="ida" value="ida"/>
							<label>Ida/Vuelta</label><input type="radio" disabled name="idaVuelta" id="vuelta" value="vuelta"/>
						</div>
						<div id="fecha_partida">
							<label class="nombreItem">Fecha Partida:</label>&nbsp;<input type="text" disabled id="fechaPartida" name="fechaPartida" readonly />
						</div>	
						<div id="fecha_regreso">
							<label class="nombreItem">Fecha Regreso:</label>&nbsp;<input type="text" disabled id="fechaRegreso" name="fechaRegreso" readonly />
						</div>
						<br>
						<div class="boton">
							<div id="botonVerifica"><input name="submit" type="submit" value="Verificar" /></div>
							<BR><hr>
							<input id="logIn" type="button" value="Consultar Reserva"/>
						</div>
						<div id="divCancelarBusqueda" title="Cancelar busqueda">
							&iquest;Desea cancelar la b&uacute;squeda?
						</div>
						<div>
							<input id="destino_hidden" name="destino_hidden" value="" type="hidden">
							<input id="origen_hidden" name="origen_hidden" value="" type="hidden">
							<input id="vuelo" name="vuelo" value="" type="hidden">
							<input id="claseHidden" name="claseHidden" value="" type="hidden">
						</div>
					</div>
				</div>
			</form>
			<div id="dialogBuscarAeropuerto" title="Seleccione ubicaci&oacute;n:">
				<form id="formBuscarAeropuerto">
					<div id="filtroBusqueda">
						<label class="nombreItem">Filtrar por ciudad:</label><input checked type="radio" name="filtro" id="filtroCiudad" value="ciudad"/><br>
						<label class="nombreItem">Filtrar por provincia:</label><input type="radio" name="filtro" id="filtroProvincia" value="provincia"/>
						<hr>
					</div>
					<div id="divPcia">
						<label class="nombreItem">Provincia:</label>
						<select id="provincia" name="provincia">
							 <option value="" selected>Seleccione...</option>							 
						 </select>
					</div>
					<div class="ciudad">
						<label class="nombreItem">Ciudad:</label>
						<select disabled id="ciudad" name="ciudad">
							 <option value="" selected>Seleccione...</option>
						 </select>
					</div>
				</form>
			</div>
			<div id="cargando" title="Cargando...">
				Espere por favor...
			</div>
		</div>
	</body>
</html>