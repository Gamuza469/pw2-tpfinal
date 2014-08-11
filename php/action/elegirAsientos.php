<?php	
	require_once('../include/commonFunctions.php');
	$error = false;
	
	$showMessages = false;
	$stringQuery = '';
	$resultadoQuery = '';
	$conexion = checkDatabaseAccess();
	if (isset($_POST["submit"])) {
		if ($error == false) {
			session_start();
			$stringQuery = "
				UPDATE
					pasaje
				SET
					checked_in = 1,
					posicion = '".$_POST['asientoSeleccionado']."'
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
									p.id_pasaje = ".$_SESSION['codigoReserva']."
							) AS p
					)
			";
			//var_dump($_SESSION);
			$resultadoQuery = executeQuery($conexion, $stringQuery, $showMessages);
			//conectar a la base, verificar y salvar
			header("Location: ../formImprimirBoletos.php");		
		} else {
			//Enviar mensaje de error mediante sesión
			header("Location: ../formCheckIn.php");
		}
	}
?>