<?php
	function formatDateARToUTC ($fecha) {
		$arrayFecha = explode('/', $fecha);
		$fechaFormatoUTC = $arrayFecha[2].'/'.$arrayFecha[1].'/'.$arrayFecha[0];
		return $fechaFormatoUTC;
	}
?>