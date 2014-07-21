<?php
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
		} else {
			$error = true;
			$mensajeError += 'Nombre inv&aacute;lido.<br>\b';
		}
		
		if (!empty($_POST["apellido"])) {
			$apellido = $_POST["apellido"];
		} else {
			$error = true;
			$mensajeError += 'Destino inv&aacute;lido.<br>\b';
		}
		
		if (!empty($_POST["dni"])) {
			$dni = $_POST["dni"];
		} else {
			$error = true;
			$mensajeError += 'Destino inv&aacute;lido.<br>\b';
		}
		
		if (!empty($_POST["fechaNacimiento"])) {
			$fechaNacimiento = $_POST["fechaNacimiento"];
		} else {
			$error = true;
			$mensajeError += 'Destino inv&aacute;lido.<br>\b';
		}
		
		if (!empty($_POST["email"])) {
			$email = $_POST["email"];
		} else {
			$error = true;
			$mensajeError += 'Destino inv&aacute;lido.<br>\b';
		}
		
		if (!empty($_POST["password"])) {
			$password = $_POST["password"];
		} else {
			$error = true;
			$mensajeError += 'Destino inv&aacute;lido.<br>\b';
		}
		
		if (!empty($_POST["confPassword"])) {
			$confPassword = $_POST["confPassword"];
		} else {
			$error = true;
			$mensajeError += 'Destino inv&aacute;lido.<br>\b';
		}
		
		if ($password != $confPassword) {
			$error = true;
			$mensajeError += 'Destino inv&aacute;lido.<br>\b';
		}
	} else {
		$error = true;
		$mensajeError += 'Destino inv&aacute;lido.<br>\b';
	}
	
	if ($error == false) {
		//conectar a la base, verificar y salvar
		header("Location: ../formPromptPago.php");		
	} else {
		//Enviar mensaje de error mediante sesión
		header("Location: ../formReservarPasaje.php");
	}
?>