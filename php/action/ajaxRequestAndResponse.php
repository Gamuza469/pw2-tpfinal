<?php
	require_once('../include/commonFunctions.php');
	
	$showMessages = false;
	
	if (isset($_POST['verify']) && isset($_POST['requestType'])) {
		if ($_POST['verify'] == 'valid') {
			$conexion = checkDatabaseAccess();
			
			if ($_POST['requestType'] == 'ciudadSelect') {
				$stringQuery = "SELECT c.id_ciudad AS 'id_ciudad', c.nombre AS 'nombre_ciudad', p.nombre AS 'nombre_provincia' FROM ciudad c INNER JOIN provincia p ON c.id_provincia = p.id_provincia ORDER BY c.nombre";
				executeQuery($conexion, $stringQuery, $showMessages);
			} else if ($_POST['requestType'] == 'provinciaSelect') {
				$stringQuery = "SELECT * FROM provincia ORDER BY nombre";
				executeQuery($conexion, $stringQuery, $showMessages);
			} else if ($_POST['requestType'] == 'ciudadByProvinciaSelect') {
				$stringQuery = "SELECT * FROM ciudad WHERE id_provincia = ".$_POST['idProvincia']." ORDER BY nombre";
				executeQuery($conexion, $stringQuery, $showMessages);
			} 
		}
	}
?>