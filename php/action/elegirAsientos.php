<?php
	$error = false;
	
	if (isset($_POST["submit"])) {
		if ($error == false) {
			//conectar a la base, verificar y salvar
			header("Location: ../formImprimirBoletos.php");		
		} else {
			//Enviar mensaje de error mediante sesión
			header("Location: ../formCheckIn.php");
		}
	}
?>