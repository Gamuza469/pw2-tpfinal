<?php
	$error = false;
	$destino = '';
	$origen = '';
	$fechaPartida = '';
	$fechaRegreso = '';
	$idaVuelta = '';
	$mensajeError = '';
	
	if (isset($_POST["submit"])) {
		//Revisar largo de datos
		//Revisar validez ruta origen y destino
		if (!empty($_POST["destino_hidden"])) {
			$destino = $_POST["destino"];
		} else {
			$error = true;
			$mensajeError = $mensajeError.'Destino inv&aacute;lido.<br>'."\n";
		}
		
		if (!empty($_POST["origen_hidden"])) {
			$origen = $_POST["origen"];
		} else {
			$error = true;
			$mensajeError = $mensajeError.'Origen inv&aacute;lido.<br>'."\n";
		}
		
		if (!empty($_POST["fechaPartida"])) {
			$fechaPartida = $_POST["fechaPartida"];
		} else {
			$error = true;
			$mensajeError = $mensajeError.'Fecha de partida inv&aacute;lida.<br>'."\n";
		}
		
		if (!empty($_POST["fechaRegreso"])) {
			$fechaRegreso = $_POST["fechaRegreso"];
		} else {
			$error = true;
			$mensajeError = $mensajeError.'Fecha de regreso inv&aacute;lida.<br>'."\n";
		}
		// if vuelta, $vuelta = true;
		if (!empty($_POST["idaVuelta"]) || ($idaVuelta == 'ida' || idaVuelta == 'vuelta')) {
			$idaVuelta = $_POST["idaVuelta"];
		} else {
			$error = true;
			$mensajeError = $mensajeError.'Circuito inv&aacute;lido.<br>'."\n";
		}
	} else {
		$error = true;
		$mensajeError = $mensajeError.'Acceso ilegal<br>'."\n";
	}
	
	if ($error == false) {
		//Revisar ruta en base de datos
		//Revisar formato fecha y disponibilidad contra frecuencia en base de datos
		//Revisar formato fecha y disponibilidad contra frecuencia en base de datos
		//conectar a la base, verificar y salvar
		
		//Persistir datos de usuario en sesión
		//Persistir datos del sistema en cookies
		
		header("Location: ../formReservarPasaje.php");
	} else {
		//Enviar mensaje de error mediante sesión
		echo("$mensajeError");
		//header("Location: ../formBuscadorVuelos.php");
	}
?>