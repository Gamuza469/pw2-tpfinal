<?php
	require_once('../include/commonFunctions.php');
	
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
			} 
			if ($medioPago == 'TARC' || $medioPago == 'TARD') {
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
					if (preg_match('/\d{3,3}/', $nroIdentificador) === 0) {
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
			}
			if ($medioPago == 'PAGT' || $medioPago == 'PAGE') {
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
			} 
			if ($medioPago == 'EFEC') {
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
			$mensajeError = $mensajeError.'Acceso ilegal.<br>'."\n";
		}
	}
	
	if ($mensajeError != '') {
		$error = true;
	}
	
	if ($error == false) {
		//conectar a la base, verificar y salvar
		$conexion = checkDatabaseAccess();
		$showMessages = false;
		$stringQuery = "
			UPDATE
				pasaje
			SET
				pagado = 1,
				id_forma_pago = ".$formaPago.",
				cbu = '".$nroCuenta."',
				numero_tarjeta = '".$nroTarjeta."',
				identificador_tarjeta = '".$nroIdentificador."'
			WHERE
				id_pasaje = ".$_POST['codigoReserva']
		;
		executeQuery($conexion, $stringQuery, $showMessages);
		
		session_start();
		
		if (isset($_SESSION['listaEspera'])) {
			$stringQuery = "
				UPDATE
					pasaje
				SET
					checked_in = -1
				WHERE
					id_pasaje = (
						SELECT
							p.id_pasaje
						FROM
							(
								SELECT
									p.id_pasaje
								FROM
									pasaje p
								WHERE
									p.id_clase_vuelo = ".$_SESSION['clase']." AND
									p.checked_in != -1 AND
									p.numero_excedente = 0 AND
									p.fecha_partida = '".formatDateARToUTC($_SESSION['fechaPartida'])."'
								ORDER BY
									p.id_pasaje
								LIMIT
									1
							) AS p
					)
			";
			executeQuery($conexion, $stringQuery, $showMessages);
		}
		
		//echo $stringQuery;
		//var_dump($_POST);
		header("Location: ../formPagoRealizado.php");
	} else {
		//var_dump($_POST);
		//echo $mensajeError;
		//Enviar mensaje de error mediante sesión
		header("Location: ../formPagoPasaje.php");
	}
?>