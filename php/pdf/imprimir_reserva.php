<?php
/*http://localhost/imprimir_reserva.php*/

require_once("../dompdf/dompdf_config.inc.php");
require_once('../include/commonFunctions.php');

session_start();

$showMessages = false;
$stringQuery = '';
$conexion = checkDatabaseAccess();

$stringQuery = "
	SELECT
		po.nombre AS nombre_pasajero,
		po.dni,
		po.fecha_nacimiento,
		po.email,
		p.id_pasaje AS codigo_reserva,
		p.vuelta AS ida_vuelta,
		c.nombre AS ciudad_origen,
		cc.nombre AS ciudad_destino,
		pr.nombre AS provincia_origen,
		ppr.nombre AS provincia_destino,
		a.nombre AS aeropuerto_origen,
		aa.nombre AS aeropuerto_destino,
		p.fecha_reserva,
		p.fecha_partida,
		p.fecha_regreso,
		nc.nombre AS nombre_clase,
		cv.precio,
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
$dni = 				$resultadoQuery->dni;
$fecha_nac = 		formatUTCDateToBSAS($resultadoQuery->fecha_nacimiento);
$email = 			$resultadoQuery->email;
$vuelo = 			$resultadoQuery->numero_vuelo;
$ida_vuelta = 		$resultadoQuery->ida_vuelta;
$lugar_part = 		$resultadoQuery->aeropuerto_origen.', '.$resultadoQuery->ciudad_origen.' ('.$resultadoQuery->provincia_origen.')'; 
$lugar_dest = 		$resultadoQuery->aeropuerto_destino.', '.$resultadoQuery->ciudad_destino.' ('.$resultadoQuery->provincia_destino.')'; 
$fecha_part = 		formatUTCDateToBSAS($resultadoQuery->fecha_partida); 
$fecha_regr = 		formatUTCDateToBSAS($resultadoQuery->fecha_regreso);
$cod_res = 			$resultadoQuery->codigo_reserva;
$clase = 			$resultadoQuery->nombre_clase;
$precio = 			'$ '.$resultadoQuery->precio;

if ($ida_vuelta == 0) {
	$ida_vuelta = 'Ida solamente.';
} else {
	$ida_vuelta = 'Ida y vuelta.';
}

$html =
  '<html>
	<head>
		<title>Reserva del Pasaje</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		<table align = "center"  border = "1" bordercolor = "#DDDFFFF" width="70%" height="100%">
			<tr>
				<td>
					<table align = "center" border = "1" width="100%" height="100%">			
						<tr>
							<td bgcolor="#A9D0F5" align="center">Reserva</td>
						</tr>			
					</table>					
					<table align = "center" border = "1" width="70%" height="100%">
						<tr>
							<td>Apellido y Nombre:</td>
							<td>'.$nombre.'</td>
						</tr>			
						<tr>
							<td>DNI:</td>
							<td>'.$dni.'</td>
						</tr>
						<tr>
							<td>Fecha de Nacimiento:</td>
							<td>'.$fecha_nac.'</td>
						</tr>
						<tr>
							<td>E-mail:</td>
							<td>'.$email.'</td>
						</tr>
						<tr>
							<td>Su nro. de vuelo:</td>
							<td>'.$vuelo.'</td>
						</tr>			
						<tr>
							<td>Ida/Vuelta:</td>
							<td>'.$ida_vuelta.'</td>
						</tr>			
						<tr>
							<td>Su Lugar de Partida es:</td>
							<td>'.$lugar_part.'</td>
						</tr>			
						<tr>
							<td>Su Lugar de Regreso es:</td>
							<td>'.$lugar_dest.'</td>
						</tr>
						<tr>
							<td>Su Fecha de Partida es:</td>
							<td>'.$fecha_part.'</td>
						</tr>';
						
						if ($fecha_regr != '00/00/0000') {
							$html = $html.'<tr>
								<td>Su Fecha de Regreso es:</td>
								<td>'.$fecha_regr.'</td>
							</tr>'; 
						}
						
						$html = $html.'<tr>
							<td>Su Codigo de Reserva es:</td>
							<td bgcolor="#A9D0F5">'.$cod_res.'</td>
						</tr>
						<tr>
							<td>Clase:</td>
							<td>'.$clase.'</td>
						</tr>						
						<tr>
							<td>Valor del pasaje:</td>
							<td>'.$precio.'</td>
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
$dompdf->stream("Reserva.pdf");

?>