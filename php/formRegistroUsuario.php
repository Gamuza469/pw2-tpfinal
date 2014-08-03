<html>
	<head>
		<title>.:: Registrar datos personales ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
		<script src="../js/formRegistroUsuario.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/registrarUsuario.php" id="formRegistroUsuario" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Registrar datos personales</div>
					<div class="busca_vue">
						<div class="nombre">
							<label class="nombreItem">Nombre:</label>&nbsp;<input type="text" id="nombre" maxlength="256" name="nombre"/>
						</div>	
						<div class="apellido">
							<label class="nombreItem">Apellido:</label>&nbsp;<input type="text" id="apellido" maxlength="254" name="apellido"/>
						</div>	
						<div class="dni">
							<label class="nombreItem">DNI:</label>&nbsp;<input type="text" id="dni" maxlength="8" name="dni"/>
						</div>								
						<div class="origen">
							<label class="nombreItem">Fecha de Nacimiento:</label>&nbsp;<input type="text" id="fechaNacimiento" name="fechaNacimiento"/>
						</div>
						<div class="email">
							<label class="nombreItem">E-Mail:</label>&nbsp;<input type="text" id="email" maxlength="256" name="email"/>
						</div>
						<BR>
						<div>
							Se utilizar&aacute;n su DNI y c&oacute;digo de reserva para identificarlo en el sistema en pasos posteriores.
						</div>
						<div>
							<table id="datosVuelo">
								<thead>
									<tr>
										<th colspan="2">Datos de su viaje</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<BR>
						<div class="boton">
							<div class="reserva"><input name="submit" type="submit" value="Registrar datos y reservar pasaje"/><input type="reset" value="Borrar Datos"/></div>
							<br><hr>
							<input id="cancelarReserva" type="button" value="Cancelar Reserva"/>
						</div>
						<div id="divCancelarReserva" title="Cancelar reserva">
							&iquest;Desea cancelar y descartar esta reserva?
						</div>
					</div>
				</div>
			</form>	
		</div>
	</body>
</html>