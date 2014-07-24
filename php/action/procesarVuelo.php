<?php
	require_once('../include/commonFunctions.php');
	
	$error = false;
	$destino = '';
	$origen = '';
	$fechaPartida = '';
	$fechaRegreso = '';
	$idaVuelta = '';
	$mensajeError = '';
	
	if (isset($_POST["submit"])) {
		if (!empty($_POST["destino_hidden"])) {
			$destino = $_POST["destino_hidden"];
			if (preg_match('/[A-Z]{4,4}/', $destino) === 0) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Destino inv&aacute;lido.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["origen_hidden"])) {
			$origen = $_POST["origen_hidden"];
			if (preg_match('/[A-Z]{4,4}/', $origen) === 0) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Origen inv&aacute;lido.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["fechaPartida"])) {
			$fechaPartida = $_POST["fechaPartida"];
			if (preg_match('/\d{2,2}\/\d{2,2}\/\d{4,4}/', $fechaPartida) === 0) {
				$error = true;
			} else {
				$fechaPartida = formatDateARToUTC($fechaPartida);
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Fecha de partida inv&aacute;lida.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["idaVuelta"])) {
			$idaVuelta = $_POST["idaVuelta"];
			if ($idaVuelta != 'ida' && $idaVuelta != 'vuelta') {
				$error = true;
			} else {
				if ($idaVuelta == 'vuelta') {
					$idaVuelta = true;
					/*---------------------------------------------------------------------------------*/
					if (!empty($_POST["fechaRegreso"])) {
						$fechaRegreso = $_POST["fechaRegreso"];
						if (preg_match('/\d{2,2}\/\d{2,2}\/\d{4,4}/', $fechaRegreso) === 0) {
							$error = true;
						} else {
							$fechaRegreso = formatDateARToUTC($fechaRegreso);
						}
					} else {
						$error = true;
					}
					
					if ($error == true) {
						$mensajeError = $mensajeError.'Fecha de regreso inv&aacute;lida.<br>'."\n";
						$error = false;
					}
					/*---------------------------------------------------------------------------------*/
				} else {
					$idaVuelta = false;
				}
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Circuito inv&aacute;lido.<br>'."\n";
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
		//Revisar ruta en base de datos
		//Revisar formato fecha y disponibilidad contra frecuencia en base de datos
		//Revisar formato fecha y disponibilidad contra frecuencia en base de datos
		//conectar a la base, verificar y salvar
		
		//Persistir datos de usuario en sesión
		//Persistir datos del sistema en cookies
		header("Location: ../formLogIn.php");
	} else {
		//Enviar mensaje de error mediante sesión
		var_dump($_POST);
		echo $mensajeError;
		//header("Location: ../formBuscadorVuelo.php");
	}
?>