<html>
	<head>
		<title>.:: Registrar Usuario ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
		<script src="../js/formRegistroUsuario.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/registrarUsuario.php" id="formRegistroUsuario" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Registrar Usuario</div>
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
						<BR><BR>
						<div class="pass">
							<label class="nombreItem">Contrase&ntilde;a:</label>&nbsp;<input type="password" id="password" maxlength="32" name="password"/>
						</div>
						<div class="confpass">
							<label class="nombreItem">Confirme Contrase&ntilde;a:</label>&nbsp;<input type="password" id="confPassword" maxlength="32" name="confPassword"/>
						</div>
						<BR>
						<div>
							Se utilizar&aacute;n ambos DNI y contrase&ntilde;a para identificarlo en el sistema en pasos posteriores.
						</div>
						<BR>
						<div class="boton">
							<div class="reserva"><input name="submit" type="submit" value="Registrar Usuario"/><input type="reset" value="Borrar Datos"/></div>
						</div>							
					</div>
				</div>
			</form>	
		</div>
	</body>
</html>