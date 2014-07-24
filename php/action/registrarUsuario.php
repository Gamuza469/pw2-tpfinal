<?php
	require_once('../include/commonFunctions.php');

	$error = false;
	$mensajeError = '';
	$nombre = '';
	$apellido = '';
	$dni = '';
	$fechaNacimiento = '';
	$email = '';
	$password = '';
	$confPassword = '';
	
	if (isset ($_POST["submit"])) {
		if (!empty($_POST["nombre"])) {
			$nombre = $_POST["nombre"];
			if (preg_match('/[A-Z]+/i', $nombre) === 0) {
				$error = true;
			}
			if (strlen($nombre) > 256) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Nombre inv&aacute;lido.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["apellido"])) {
			$apellido = $_POST["apellido"];
			if (preg_match('/[A-Z]+/i', $apellido) === 0) {
				$error = true;
			}
			if (strlen($nombre) > 254) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Apellido inv&aacute;lido.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["dni"])) {
			$dni = $_POST["dni"];
			if (preg_match('/\d{8,8}/', $dni) === 0) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'DNI inv&aacute;lido.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["fechaNacimiento"])) {
			$fechaNacimiento = $_POST["fechaNacimiento"];
			if (preg_match('/\d{2,2}\/\d{2,2}\/\d{4,4}/', $fechaNacimiento) === 0) {
				$error = true;
			} else {
				$fechaPartida = formatDateARToUTC($fechaNacimiento);
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Fecha de Nacimiento inv&aacute;lida.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["email"])) {
			$email = $_POST["email"];
			if (preg_match('/^[A-Z0-9._%+-]+\@[A-Z0-9.-]+\.[A-Z]{2,4}/i', $email) === 0) {
				$error = true;
			}
			if (strlen($email) > 256) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'E-Mail inv&aacute;lido.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["password"])) {
			$password = $_POST["password"];
			if (preg_match('/[A-Za-z0-9]+/', $password) === 0) {
				$error = true;
			}
			if (strlen($password) > 32) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Contrase&ntilde;a  inv&aacute;lida.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["confPassword"])) {
			$confPassword = $_POST["confPassword"];
			if ($confPassword != $password) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Las contrase&ntilde;as no coinciden.<br>'."\n";
			$error = false;
		}
				
		/*---------------------------------------------------------------------------------*/
	} else {
		$error = true;
		$mensajeError = $mensajeError.'Acceso ilegal<br>'."\n";
	}
	
	if ($mensajeError != '') {
		$error = true;
	}
	
	if ($error == false) {
		//conectar a la base, verificar y salvar
		header("Location: ../formPromptPago.php");		
	} else {
		//Enviar mensaje de error mediante sesión
		//header("Location: ../formReservarPasaje.php");
		var_dump($_POST);
		echo $mensajeError;
		//header("Location: ../formRegistroUsuario.php");
	}
?>