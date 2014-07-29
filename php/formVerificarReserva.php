<html>
	<head>
		<title>.:: Estado de reserva ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/verificarUsuario.php" id="formLogIn" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Estado de reserva</div>
					<div class="busca_vue">
						<div class="usuario">
							<label class="nombreItem">DNI:</label>&nbsp;<input type="text" id="dni" maxlength="8" name="dni"/>
						</div>							
						<div class="reserva">
							<label class="nombreItem">C&oacute;digo reserva:</label>&nbsp;<input type="text" maxlength="32" id="reserva" name="reserva"/>
						</div>
						<BR>
						<div class="boton">
							<div class="imprime">
								<input type="submit" name="submit" value="Verificar de estado reserva"/>
								<input type="reset" value="Borrar Datos"/>
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