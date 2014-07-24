<html>
	<head>
		<title>.:: Log-In ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/verificarUsuario.php" id="formLogIn" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Log-In</div>
					<div class="busca_vue">
						<div class="usuario">
							<label class="nombreItem">DNI:</label>&nbsp;<input type="text" id="dni" maxlength="8" name="dni"/>
						</div>							
						<div class="clave">
							<label class="nombreItem">Contrase&ntilde;a:</label>&nbsp;<input type="password" maxlength="32" id="password" name="password"/>
						</div>	
						<BR>
						<div class="recordar">
							<label class="nombreItem">Recordar Usuario:</label>&nbsp;<input type="checkbox" id="recordar" name="recordar"/>
						</div>	
						<BR>
						<div class="boton">
							<div class="imprime">
								<input type="submit" name="submit" value="Log-In"/>
								<input type="reset" value="Borrar Datos"/><BR>
								<input id="newUser" type="button" value="No tengo Usuario"/>
							</div>
						</div>							
					</div>
				</div>
			</form>	
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#formLogIn').validate({
					rules: {
						dni: {
							digits: true,
							minlength: 8,
							required: true
						},
						password: {
							minlength: 4,
							maxlength: 32,
							required: true
						}
					},
					messages: {
						dni:				'Ingrese su DNI.',
						password:			'Especifique una contrase&ntilde;a, m&iacute;nimo 4 caracteres alfanum&eacute;ricos.'
					}
				});
				
				$('#newUser').click(function(){
					window.location.href = './formRegistroUsuario.php';
				});
			});
		</script>
	</body>
</html>