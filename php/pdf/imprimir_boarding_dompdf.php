<?php
/*http://localhost/imprimir_boarding_dompdf.php*/

require_once("../dompdf/dompdf_config.inc.php");
require_once("../phpqrcode/qrlib.php");
require_once('../include/commonFunctions.php');

session_start();

$showMessages = false;
$stringQuery = '';
$conexion = checkDatabaseAccess();

$stringQuery = "
	SELECT
		po.nombre AS nombre_pasajero,
		p.id_pasaje AS codigo_reserva,
		p.posicion,
		c.nombre AS ciudad_origen,
		cc.nombre AS ciudad_destino,
		pr.nombre AS provincia_origen,
		ppr.nombre AS provincia_destino,
		a.nombre AS aeropuerto_origen,
		aa.nombre AS aeropuerto_destino,
		p.fecha_partida,
		nc.nombre AS nombre_clase,
		v.numero_vuelo
	FROM
		pasaje p
	INNER JOIN
		pasajero po ON
		p.dni = po.dni
	INNER JOIN
		clase_vuelo cv ON
		p.id_clase_vuelo = cv.id_clase_vuelo
	INNER JOIN
		vuelo v ON
		cv.numero_vuelo = v.numero_vuelo
	INNER JOIN
		nombre_clase nc ON
		cv.id_nombre_clase = nc.id_nombre_clase
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
		provincia pr ON
		c.id_provincia = pr.id_provincia
	INNER JOIN
		provincia ppr ON
		cc.id_provincia = ppr.id_provincia
	WHERE
		p.id_pasaje = ".$_SESSION['codigoReserva']
;

$resultadoQuery = executeQuery($conexion, $stringQuery, $showMessages);
$resultadoQuery = json_decode($resultadoQuery);
$resultadoQuery = $resultadoQuery->respuesta[0];
		
$nombre = 			$resultadoQuery->nombre_pasajero;
$pasaje = 			$resultadoQuery->codigo_reserva;
$vuelo = 			$resultadoQuery->numero_vuelo;
$fecha_part = 		formatUTCDateToBSAS($resultadoQuery->fecha_partida);
$asiento = 			$resultadoQuery->posicion;
$clase =			$resultadoQuery->nombre_clase;

QRcode::png(json_encode($resultadoQuery), './codigoQR.png', QR_ECLEVEL_H, 3);

$html =
  '<html>
	<head>
		<title>Boarding Pass</title>
	</head>
	<body>
		<table align = "center"  border = "1" bordercolor = "#DDDFFFF" width="70%" height="100%">
			<tr>
				<td>
					<table align = "center" border = "1" width="100%" height="100%">			
						<tr>
							<td bgcolor="#A9D0F5" align="center">Boarding Pass</td>
						</tr>			
					</table>					
					<table border = "0" align = "center"><tr><td><img src="./codigoQR.png"/></td></tr></table>
					<table align = "center" border = "1" width="70%" height="100%">
						<tr>
							<td>Apellido y Nombre:</td>
							<td>'.$nombre.'</td>
						</tr>		
						<tr>
							<td>Nro. de Pasaje</td>
							<td>'.$pasaje.'</td>
						</tr>
						<tr>
							<td>Nro. de vuelo:</td>
							<td>'.$vuelo.'</td>
						</tr>			
						<tr>
							<td>Fecha de Partida es:</td>
							<td>'.$fecha_part.'</td>
						</tr>			
						<tr>
							<td>Nro. de asiento:</td>
							<td bgcolor="#A9D0F5">'.$asiento.'</td>
						</tr>
						<tr>
							<td>Clase:</td>
							<td>'.$clase.'</td>
						</tr>
					</table>
				</td>
			</tr>	
		</table>	
	</body>
</html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("a4", $orientation = "landscape");
$dompdf->render();
$dompdf->stream("Boarding Pass.pdf");

?>