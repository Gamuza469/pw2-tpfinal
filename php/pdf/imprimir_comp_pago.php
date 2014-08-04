<?php
/*http://localhost/imprimir_compr_pago.php*/

require_once("../dompdf/dompdf_config.inc.php");
require_once('../include/commonFunctions.php');

session_start();

$showMessages = false;
$stringQuery = '';
$conexion = checkDatabaseAccess();

$stringQuery = "
	SELECT
		p.id_pasaje AS codigo_reserva,
		mp.codigo_medio_pago,
		mp.nombre AS nombre_medio_pago,
		emp.nombre AS nombre_empresa,
		tp.nombre AS nombre_tipo_pago,
		p.cbu,
		p.numero_tarjeta,
		p.identificador_tarjeta,
		cv.precio,
		b.nombre AS nombre_banco
	FROM
		pasaje p
	INNER JOIN
		forma_pago fp ON
		p.id_forma_pago = fp.id_forma_pago
	INNER JOIN
		medio_pago mp ON
		fp.codigo_medio_pago = mp.codigo_medio_pago
	INNER JOIN
		empresa_medio_pago emp ON
		fp.id_empresa_medio_pago = emp.id_empresa_medio_pago
	INNER JOIN
		tipo_pago tp ON
		fp.id_tipo_pago = tp.id_tipo_pago
	INNER JOIN
		banco b ON
		fp.id_banco = b.id_banco
	INNER JOIN
		clase_vuelo cv ON
		p.id_clase_vuelo = cv.id_clase_vuelo
	WHERE
		p.id_pasaje = ".$_SESSION['codigoReserva']
;

$resultadoQuery = executeQuery($conexion, $stringQuery, $showMessages);
$resultadoQuery = json_decode($resultadoQuery);
$resultadoQuery = $resultadoQuery->respuesta[0];

$codReserva = 			$resultadoQuery->codigo_reserva;
$cia_emisora = 			$resultadoQuery->nombre_empresa;
$medio_pago = 			$resultadoQuery->nombre_medio_pago;
$cod_medio_pago = 		$resultadoQuery->codigo_medio_pago;
$modo_pago = 			$resultadoQuery->nombre_tipo_pago;
$nro_tarjeta = 			$resultadoQuery->numero_tarjeta;
$nro_identificador = 	$resultadoQuery->identificador_tarjeta;
$cbu = 					$resultadoQuery->cbu;
$precio =				'$ '.$resultadoQuery->precio;
$banco = 				$resultadoQuery->nombre_banco;

$html =
  '<html>
	<head>
		<title>Pago Realizado</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<body>
		<table align = "center"  border = "1" bordercolor = "#DDDFFFF" width="70%" height="100%">
			<tr>
				<td>
					<table align = "center" border = "1" width="100%" height="100%">			
						<tr>
							<td bgcolor="#A9D0F5" align="center">Comprobante de Pago Realizado</td>
						</tr>			
					</table>					
					<table align = "center" border = "1" width="70%" height="100%">
						<tr>
							<td>C&oacute;digo de reserva:</td>
							<td>'.$codReserva.'</td>
						</tr>
						<tr>
							<td>Medio de Pago:</td>
							<td>'.$medio_pago.'</td>
						</tr>';
						
						if ($cod_medio_pago == 'EFEC') {
							$html = $html.'<tr>
								<td>Monto a abonar:</td>
								<td>'.$precio.'</td>
							</tr>';
						} else if ($cod_medio_pago == 'TARC' || $cod_medio_pago == 'TARD') {
							$html = $html.'<tr>
								<td>Banco:</td>
								<td>'.$banco.'</td>
							</tr>	
							<tr>
								<td>Compa&ntilde;ia Emisora:</td>
								<td>'.$cia_emisora.'</td>
							</tr>	
							<tr>
								<td>Forma de Pago:</td>
								<td>'.$modo_pago.'</td>
							</tr>
							<tr>
								<td>Nro. de Tarjeta:</td>
								<td>'.$nro_tarjeta.'</td>
							</tr>
							<tr>
								<td>Nro. Identificador:</td>
								<td>'.$nro_identificador.'</td>
							</tr>	
							<tr>
								<td>Monto a abonar:</td>
								<td>'.$precio.'</td>
							</tr>';
						} else if ($cod_medio_pago == 'PAGT' || $cod_medio_pago == 'PAGE') {
							$html = $html.'<tr>
								<td>Compa&ntilde;ia de servicios:</td>
								<td>'.$cia_emisora.'</td>
							</tr>	
							<tr>
								<td>Forma de Pago:</td>
								<td>'.$modo_pago.'</td>
							</tr>	
							<tr>
								<td>Monto a abonar:</td>
								<td>'.$precio.'</td>
							</tr>';
						} else if ($cod_medio_pago == 'TRAB') {
							$html = $html.'<tr>
								<td>Banco:</td>
								<td>'.$banco.'</td>
							</tr>
							<tr>
								<td>Nro. CBU:</td>
								<td>'.$cbu.'</td>
							</tr>
							<tr>
								<td>Monto a abonar:</td>
								<td>'.$precio.'</td>
							</tr>';
						}
						
						$html = $html.'
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
$dompdf->stream("Comprobante de Pago Realizado.pdf");

?>