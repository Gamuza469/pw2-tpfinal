<html>
	<head>
		<title>.:: Reservar Pasaje ::.</title>
		<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery.validate.js"></script>
		<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/reservarPasaje.php" id="formReservarPasaje" method="POST" enctype="text/plain">
				<div class="encabezado">
					<div class="busca_vuelo">Reservar pasaje</div>
					<div class="busca_vue">
						<div class="nombre">
							<label class="nombreItem">Nombre:</label>&nbsp;<input type="text" id="nombre" name="nombre"/>
						</div>	
						<div class="apellido">
							<label class="nombreItem">Apellido:</label>&nbsp;<input type="text" id="apellido" name="apellido"/>
						</div>	
						<div class="dni">
							<label class="nombreItem">DNI:</label>&nbsp;<input type="text" id="dni" maxlength="8" name="dni"/>
						</div>								
						<div class="origen">
							<label class="nombreItem">Fecha de Nacimiento:</label>&nbsp;<input type="text" id="fecha_nacimiento" name="fecha_nacimiento"/>
						</div>
						<div class="email">
							<label class="nombreItem">E-Mail:</label>&nbsp;<input type="text" id="email" name="email"/>
						</div>	
						<div class="pass">
							<label class="nombreItem">Contrase&ntilde;a:</label>&nbsp;<input type="password" id="password" maxlength="32" name="password"/>
						</div>
						<div>
							Se utilizar&aacute;n ambos DNI y contrase&ntilde;a para identificarlo en el sistema en pasos posteriores.
						</div>
						<BR>
						<div class="boton">
							<div class="reserva"><input type="submit" value="Reservar Pasaje"/></div>
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
						fecha_nacimiento: {
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
						}
					},
					messages: {
						nombre:				'Ingrese su nombre.',
						apellido:			'Ingrese su apellido',
						dni:				'Ingrese su DNI.',
						fecha_nacimiento:	'Ingrese su fecha de nacimiento.',
						email:				'Ingrese su direcci&oacute;n de E-Mail.',
						password:			'Especifique una contrase&ntilde;a, m&iacute;nimo 4 caracteres.'
					}
				});
			});
		</script>
	</body>
</html>