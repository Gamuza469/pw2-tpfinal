<?php
/*http://localhost/imprimir_reserva.php*/

require_once("dompdf/dompdf_config.inc.php");
		
$nombre = "Damian";
$apellido = "Berruezo";
$dni = "29546789";
$pasaje = "2230";
$vuelo = "245";
$lugar_part = "CABA"; 
$lugar_dest = "Mendoza"; 
$fecha_part = "04/08/2014"; 
$fecha_regr = "14/08/2014";
$cod_res = "16";
$clase = "A";
$precio = "320";

$html =
  '<html>
	<head>
		<title>Reserva del Pasaje</title>
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
							<td>Nombre:</td>
							<td>'.$nombre.'</td>
						</tr>			
						<tr>
							<td>Apellido:</td>
							<td>'.$apellido.'</td>
						</tr>			
						<tr>
							<td>DNI:</td>
							<td>'.$dni.'</td>
						</tr>
						<tr>
							<td>Su nro. de Pasaje</td>
							<td bgcolor="#A9D0F5">'.$pasaje.'</td>
						</tr>
						<tr>
							<td>Su nro. de vuelo:</td>
							<td>'.$vuelo.'</td>
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
						</tr>
						<tr>
							<td>Su Fecha de Regreso es:</td>
							<td>'.$fecha_regr.'</td>
						</tr>
						<tr>
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