<?php
	require_once('../include/commonFunctions.php');

	$error = false;
	$mensajeError = '';
	$nombre = '';
	$apellido = '';
	$dni = '';
	$fechaNacimiento = '';
	$email = '';
	$posicionEspera = '';
	
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
	} else {
		$error = true;
		$mensajeError = $mensajeError.'Acceso ilegal<br>'."\n";
	}
	
	if ($mensajeError != '') {
		$error = true;
	}
	
	if ($error == false) {
		session_start();
		$conexion = checkDatabaseAccess();
		$showMessages = false;
		$stringQuery = "
			INSERT INTO
				pasajero
					(dni, nombre, fecha_nacimiento, email)
			VALUES
				('".$_POST['dni']."', '".$_POST['apellido'].", ".$_POST['nombre']."', '".formatDateARToUTC($_POST['fechaNacimiento'])."', '".$_POST['email']."')
		";
		executeQuery($conexion, $stringQuery, $showMessages);
		$fechaHoy = date("Y-m-d");
		
		if (isset($_POST['posicion_espera'])) {
			$posicionEspera = $_POST['posicion_espera'];
		} else {
			$posicionEspera = 0;
		}
		
		$stringQuery = "
			INSERT INTO
				pasaje
					(dni, id_clase_vuelo, id_forma_pago, vuelta, fecha_reserva, fecha_partida, fecha_regreso, pagado, checked_in, numero_excedente)
			VALUES
				('".$_POST['dni']."', ".$_SESSION['clase'].", 1, ".$_SESSION['idaVuelta'].",'".$fechaHoy."', '".formatDateARToUTC($_SESSION['fechaPartida'])."', '".formatDateARToUTC($_SESSION['fechaRegreso'])."', 0, 0, ".$posicionEspera.")
		";
		executeQuery($conexion, $stringQuery, $showMessages);
		
		$_SESSION['dni'] = $_POST['dni'];
		$_SESSION['fechaReserva'] = formatUTCDateToBSAS($fechaHoy);
		
		header("Location: ../formPromptPago.php");
	} else {
		//Enviar mensaje de error mediante sesión
		//header("Location: ../formReservarPasaje.php");
		//var_dump($_POST);
		//echo $mensajeError;
		header("Location: ../formRegistroUsuario.php");
	}
?>