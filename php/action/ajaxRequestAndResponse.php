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
			} else if ($_POST['requestType'] == 'vuelosByOrigenDestinoSelect') {
				$stringQuery = "
					SELECT v.codigo_oaci_origen, v.codigo_oaci_destino,
						v.frecuencia,
						v.numero_vuelo,
						c.nombre AS ciudad_origen,
						cc.nombre AS ciudad_destino,
						p.nombre AS provincia_origen,
						pp.nombre AS provincia_destino,
						a.nombre AS aeropuerto_origen,
						aa.nombre AS aeropuerto_destino
					FROM
						vuelo v
					INNER JOIN
						aeropuerto a ON
						v.codigo_oaci_origen = a.codigo_oaci
					INNER JOIN
						aeropuerto aa ON
						v.codigo_oaci_destino = aa.codigo_oaci
					INNER JOIN
						ciudad c ON
						a.id_ciudad = c.id_ciudad
					INNER JOIN
						ciudad cc ON
						aa.id_ciudad = cc.id_ciudad
					INNER JOIN
						provincia p ON
						c.id_provincia = p.id_provincia
					INNER JOIN
						provincia pp ON
						cc.id_provincia = pp.id_provincia
					WHERE
						c.id_ciudad = ".$_POST['origen']."
					AND
						cc.id_ciudad = ".$_POST['destino']
				;
				executeQuery($conexion, $stringQuery, $showMessages);
			} else if ($_POST['requestType'] == 'clasesByVueloSelect') {
				$stringQuery = "
					SELECT
						cv.id_clase_vuelo,
						nc.nombre,
						cv.precio
					FROM
						clase_vuelo cv
					INNER JOIN
						vuelo v ON
						cv.numero_vuelo = v.numero_vuelo
					INNER JOIN
						nombre_clase nc ON
						cv.id_nombre_clase = nc.id_nombre_clase
					WHERE
						cv.numero_vuelo = ".$_POST['numeroVuelo']
				;
				executeQuery($conexion, $stringQuery, $showMessages);
			}
		}
	}
?>