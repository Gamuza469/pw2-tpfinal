<?php
/*http://localhost/imprimir_boarding_dompdf.php*/

require_once("dompdf/dompdf_config.inc.php");

include("phpqrcode/qrlib.php"); 
		QRcode::png('example_001_simple_png_output.php');
		
$nombre = "Damian";
$apellido = "Berruezo";
$pasaje = "2230";
$vuelo = "245";
$fecha_part = "04/08/2014";
$asiento = "24";

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
					<table border = "0" align = "center"><tr><td><img src="example_001_simple_png_output.php" /></td></tr></table>
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
							<td>Su nro. de Pasaje</td>
							<td>'.$pasaje.'</td>
						</tr>
						<tr>
							<td>Su nro. de vuelo:</td>
							<td>'.$vuelo.'</td>
						</tr>			
						<tr>
							<td>Su Fecha de Partida es:</td>
							<td>'.$fecha_part.'</td>
						</tr>			
						<tr>
							<td>Su nro. de asiento:</td>
							<td bgcolor="#A9D0F5">'.$asiento.'</td>
						</tr>			
					</table>
				</td>
			</tr>	
		</table>	
	</body>
</html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("letter", $orientation = "landscape");
$dompdf->render();
$dompdf->stream("Imprimir Boarding Pass.pdf");

?>