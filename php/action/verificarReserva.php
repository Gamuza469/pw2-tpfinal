<?php
	require_once('../include/commonFunctions.php');
	
	$error = false;
	$mensajeError = '';
	
	$codigoReserva = '';
	
	if (isset($_POST['submit'])) {
		if (!empty($_POST["reserva"])) {
			$codigoReserva = $_POST["reserva"];
			if (preg_match('/\d{8,8}/', $codigoReserva) === 0) {
				$error = true;
			}
		} else {
			$error = true;
		}
		
		if ($error == true) {
			$mensajeError = $mensajeError.'C&oacute;digo de reserva inv&aacute;lido.<br>'."\n";
			$error = false;
		}
	} else {
	}
	
	if ($mensajeError != '') {
		$error = true;
	}
	
	if ($error == false) {
		session_start();
		$_SESSION['codigoReserva'] = $codigoReserva;
		
		header("Location: ../formEstadoReserva.php");
	} else {
		header("Location: ../formVerificarReserva.php");
	}
?>