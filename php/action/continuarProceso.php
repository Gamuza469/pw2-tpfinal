<?php
	require_once('../include/commonFunctions.php');
	
	$showMessages = false;
	$stringQuery = '';
	$jsonString = '{"respuesta": [';
	
	$stringQuery = "
		SELECT
			*
		FROM
			pasaje p
	";
?>