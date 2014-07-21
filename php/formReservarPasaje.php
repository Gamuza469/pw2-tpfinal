<html>
	<head>
		<title>.:: Reservar Pasaje ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/reservarPasaje.php" id="formReservarPasaje" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Reservar pasaje</div>
					<div class="busca_vue">
						<div class="nombre">
							<label class="nombreItem">Nombre:</label>&nbsp;<input type="text" id="nombre" maxlength="256" name="nombre"/>
						</div>	
						<div class="apellido">
							<label class="nombreItem">Apellido:</label>&nbsp;<input type="text" id="apellido" maxlength="255" name="apellido"/>
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
							<div class="reserva"><input name="submit" type="submit" value="Reservar Pasaje"/></div>
						</div>							
					</div>
				</div>
			</form>	
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#formReservarPasaje').validate({
					rules: {
						nombre: {
							required: true
						},
						apellido: {
							required: true
						},
						dni: {
							digits: true,
							minlength: 8,
							required: true
						},
						fechaNacimiento: {
							required: true
						},
						email: {
							email: true,
							required: true
						},
						password: {
							minlength: 4,
							maxlength: 32,
							required: true
						},
						confPassword: {
							minlength: 4,
							maxlength: 32,
							required: true
						}
					},
					messages: {
						nombre:				'Ingrese su nombre.',
						apellido:			'Ingrese su apellido',
						dni:				'Ingrese su DNI.',
						fechaNacimiento:	'Ingrese su fecha de nacimiento.',
						email:				'Ingrese su direcci&oacute;n de E-Mail.',
						password:			'Especifique una contrase&ntilde;a, m&iacute;nimo 4 caracteres.',
						confPassword:		'Las contrase&ntilde;as no coinciden.'
					}
				});
			});
		</script>
	</body>
</html>