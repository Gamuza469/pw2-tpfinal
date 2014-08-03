<?php
	require_once('../include/commonFunctions.php');
	
	$error = false;
	
	$clase = '';
	$vuelo = '';
	$fechaPartida = '';
	$fechaRegreso = '';
	$idaVuelta = '';
	$mensajeError = '';
	
	if (isset($_POST["submit"])) {
		
		if (!empty($_POST["vuelo"])) {
			$vuelo = $_POST["vuelo"];
			if (preg_match('/\d+/', $vuelo) === 0) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Vuelo inv&aacute;lido.<br>'."\n";
			$error = false;
		}
		
		/*---------------------------------------------------------------------------------*/
		
		if (!empty($_POST["claseHidden"])) {
			$clase = $_POST["claseHidden"];
			if (preg_match('/\d+/', $clase) === 0) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'Clase inv&aacute;lida.<br>'."\n";
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
					$idaVuelta = 1;
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
					$idaVuelta = 0;
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
		session_start();
		$_SESSION['vuelo'] = $vuelo;
		$_SESSION['clase'] = $clase;
		$_SESSION['fechaPartida'] = $fechaPartida;
		$_SESSION['fechaRegreso'] = $fechaRegreso;
		$_SESSION['idaVuelta'] = $idaVuelta;
		
		header("Location: ../formRegistroUsuario.php");
	} else {
		//Enviar mensaje de error mediante sesión
		//var_dump($_POST);
		//echo $mensajeError;
		header("Location: ../formBuscadorVuelo.php");
	}
?>