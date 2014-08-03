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
			if (preg_match('/[A-Z]{4,4}/', $medioPago) === 0) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Medio de pago inv&aacute;lido.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if ($medioPago != '') {
			if ($medioPago == 'TARC' || $medioPago == 'TARD' || $medioPago == 'TRAB') {
				if (!empty($_POST["banco"])) {
					$banco = $_POST["banco"];
				} else {
					$error = true;
				}
				
				if ($error == true) {
					$mensajeError = $mensajeError.'Banco inv&aacute;lido.<br>'."\n";
					$error = false;
				}
				
				/*---------------------------------------------------------------------------------*/
			} else if ($medioPago == 'TARC' || $medioPago == 'TARD') {
				if (!empty($_POST["emisor"])) {
					$emisor = $_POST["emisor"];
				} else {
					$error = true;
				}
				
				if ($error == true) {
					$mensajeError = $mensajeError.'Emisor inv&aacute;lido.<br>'."\n";
					$error = false;
				}
				
				/*---------------------------------------------------------------------------------*/
				
				if (!empty($_POST["formaPagoComun"])) {
					$formaPago = $_POST["formaPagoComun"];
				} else {
					$error = true;
				}
				
				if ($error == true) {
					$mensajeError = $mensajeError.'Forma de pago inv&aacute;lida.<br>'."\n";
					$error = false;
				}
				
				/*---------------------------------------------------------------------------------*/
				
				if (!empty($_POST["nroTarjeta"])) {
					$nroTarjeta = $_POST["nroTarjeta"];
					if (preg_match('/\d+/', $nroTarjeta) === 0) {
						$error = true;
					}
					if (strlen($nroTarjeta) > 16) {
						$error = true;
					}
				} else {
					$error = true;
				}
				
				if ($error == true) {
					$mensajeError = $mensajeError.'N&uacute;mero de tarjeta inv&aacute;lida.<br>'."\n";
					$error = false;
				}
				
				/*---------------------------------------------------------------------------------*/
				
				if (!empty($_POST["nroIdentificador"])) {
					$nroIdentificador = $_POST["nroIdentificador"];
					if (preg_match('/\d+/', $nroIdentificador) === 0) {
						$error = true;
					}
					if (strlen($nroTarjeta) > 3) {
						$error = true;
					}
				} else {
					$error = true;
				}
				
				if ($error == true) {
					$mensajeError = $mensajeError.'N&uacute;mero identificador inv&aacute;lido.<br>'."\n";
					$error = false;
				}
				
				/*---------------------------------------------------------------------------------*/
			} else if ($medioPago == 'PAGT' || $medioPago == 'PAGE') {
				if (!empty($_POST["servicio"])) {
					$servicio = $_POST["servicio"];
				} else {
					$error = true;
				}
				
				if ($error == true) {
					$mensajeError = $mensajeError.'Servicio no puede ser nulo.<br>'."\n";
					$error = false;
				}
			} else if ($medioPago == 'TRAB') {
				if (!empty($_POST["nroCuenta"])) {
					$nroCuenta = $_POST["nroCuenta"];
				} else {
					$error = true;
				}
				
				if ($error == true) {
					$mensajeError = $mensajeError.'N&uacute;mero de cuenta inv&aacute;lido.<br>'."\n";
					$error = false;
				}
			} else if ($medioPago == 'EFEC') {
			} else {
				$error = true;
				
				if ($error == true) {
					$mensajeError = $mensajeError.'Medio de pago inv&aacute;lido.<br>'."\n";
					$error = false;
				}
			}
		} else {
			$error = true;
			
			if ($error == true) {
				$mensajeError = $mensajeError.'888Circuito inv&aacute;lido.<br>'."\n";
				$error = false;
			}
		}
	} else {
		$error = true;
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Acceso ilegal.<br>'."\n";
		}
	}
	
	if ($mensajeError != '') {
		$error = true;
	}
	
	if ($error == false) {
		//conectar a la base, verificar y salvar
		header("Location: ../formPagoRealizado.php");
		//Redirige a reserva vencida
		//header("Location: ../formReservaVencida.php");
	} else {
		//Enviar mensaje de error mediante sesión
		header("Location: ../formPagoPasaje.php");
	}
?>