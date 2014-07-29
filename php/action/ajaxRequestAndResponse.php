<?php
	require_once('../include/commonFunctions.php');
	
	if (isset($_POST['hola'])) {
		$conexion = checkDatabaseAccess();
		$showMessages = true;
		
		$stringQuery = "
			SELECT 
				c.nombre AS 'asd', p.nombre 
			FROM 
				ciudad c
			INNER JOIN
				provincia p
				ON
				c.id_provincia = p.id_provincia
		";
		
		echo executeQuery($conexion, $stringQuery, $showMessages);
	}
?>