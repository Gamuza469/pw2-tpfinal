<?php
	$error = false;
	$mensajeError = '';
	$medioPago = '';
	$banco = '';
	$emisor = '';
	$formaPago = '';
	$servicio = '';
	$nroTarjeta = '';
	$nroIdentificador = '';
	$nroCuenta = '';

	if (isset($_POST["submit"])) {
		if (!empty($_POST["medioPago"])) {
			$medioPago = $_POST["medioPago"];
		} else {
			$error = true;
			$mensajeError = $mensajeError.'Circuito inv&aacute;lido.<br>'."\n";
		}
		
		if ($medioPago != '') {
			if ($medioPago == 'TARC' || medioPago == 'TARD' || $medioPago == 'TRAB') {
				if (!empty($_POST["banco"])) {
					$banco = $_POST["banco"];
				} else {
					$error = true;
					$mensajeError = $mensajeError.'1111Circuito inv&aacute;lido.<br>'."\n";
				}
			} 
			
			if (medioPago == 'TARC' || medioPago == 'TARD') {
				if (!empty($_POST["emisor"])) {
					$emisor = $_POST["emisor"];
				} else {
					$error = true;
					$mensajeError = $mensajeError.'2222Circuito inv&aacute;lido.<br>'."\n";
				}
				
				if (!empty($_POST["formaPago"])) {
					$formaPago = $_POST["formaPago"];
				} else {
					$error = true;
					$mensajeError = $mensajeError.'3333Circuito inv&aacute;lido.<br>'."\n";
				}
				
				if (!empty($_POST["nroTarjeta"])) {
					$nroTarjeta = $_POST["nroTarjeta"];
				} else {
					$error = true;
					$mensajeError = $mensajeError.'4444Circuito inv&aacute;lido.<br>'."\n";
				}
				
				if (!empty($_POST["nroIdentificador"])) {
					$nroIdentificador = $_POST["nroIdentificador"];
				} else {
					$error = true;
					$mensajeError = $mensajeError.'5556Circuito inv&aacute;lido.<br>'."\n";
				}
			} 
			
			if (medioPago == 'PAGT' || medioPago == 'PAGE') {
				if (!empty($_POST["servicio"])) {
					$servicio = $_POST["servicio"];
				} else {
					$error = true;
					$mensajeError = $mensajeError.'666Circuito inv&aacute;lido.<br>'."\n";
				}
			} 
			
			if (medioPago == 'TRAB') {
				if (!empty($_POST["nroCuenta"])) {
					$nroCuenta = $_POST["nroCuenta"];
				} else {
					$error = true;
					$mensajeError = $mensajeError.'888Circuito inv&aacute;lido.<br>'."\n";
				}
			}
		} else {
			$error = true;
			$mensajeError = $mensajeError.'9999Circuito inv&aacute;lido.<br>'."\n";
		}
	} else {
		$error = true;
		$mensajeError = $mensajeError.'12121Circuito inv&aacute;lido.<br>'."\n";
	}
	
	if ($error == false) {
		//conectar a la base, verificar y salvar
		header("Location: ../formPagoRealizado.php");		
	} else {
		//Enviar mensaje de error mediante sesión
		//header("Location: ../formPagoPasaje.php");
		echo($mensajeError);
		var_dump($_POST);
	}
?>