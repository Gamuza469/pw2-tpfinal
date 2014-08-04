<?php
	function formatDateARToUTC ($fecha) {
		$arrayFecha = explode('/', $fecha);
		$fechaFormatoUTC = $arrayFecha[2].'-'.$arrayFecha[1].'-'.$arrayFecha[0];
		return $fechaFormatoUTC;
	}
	
	function formatUTCDateToBSAS ($fecha) {
		$arrayFecha = explode('-', $fecha);
		$fechaFormatoBSAS = $arrayFecha[2].'/'.$arrayFecha[1].'/'.$arrayFecha[0];
		return $fechaFormatoBSAS;
	}
	
	function checkDatabaseAccess () {
		$conexion = mysql_connect('localhost', 'root', '');
		
		if ($conexion !== false) {
			$conexionExitosa = mysql_select_db('pw2-tpfinal', $conexion);
			
			if ($conexionExitosa !== false) {
				mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $conexion);
				return $conexion;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	function printDatabaseAccessStatus ($conexion) {
		if ($conexion !== false) {
			echo('La conexion a la base de datos devolvio: '."$conexion<br>\n");
			$desconexion = mysql_close($conexion);
		
			if ($desconexion === true) {
				echo('La desconexion se realizo correctamente.');
			} else {
				echo('Hubo un error en la desconexion.');
			}
		} else {
			echo('La conexion a la base de datos ha fallado.');
		}
	}
	
	function executeQuery ($conexion, $stringQuery, $showMessages) {
		$jsonString = '{"respuesta": [';
	
		if ($conexion !== false) {
			
			if (!empty($stringQuery)) {
				$stringQuery = strtolower($stringQuery);
			} else {
				echo('La query ingresada es nula!');
				return false;
			}
			
			if ($showMessages === true) {
				echo('El comando ingresado es: '.$stringQuery."<br>\n");
			}

			if (strpos($stringQuery, 'select') !== false) {
				$consultaCorrecta = mysql_query($stringQuery, $conexion);
				
				if ($consultaCorrecta !== false) {
					$resultadoConsulta = mysql_query($stringQuery, $conexion);
					$cantidadFilas = mysql_num_rows($consultaCorrecta);

					if ($showMessages === true) {
						echo('La consulta: '.$stringQuery.' devolvio el/los siguiente(s) registro(s):<br>'."\n");
					}
					
					for ($i = 0; $i < $cantidadFilas; $i++){
						$registro = mysql_fetch_assoc($consultaCorrecta);
						if ($showMessages === true) {
							echo var_dump($registro);
						}
						if ($jsonString != '{"respuesta": [') {
							$jsonString = $jsonString.',';
						}
						$jsonString = $jsonString.json_encode($registro);
					}
					$jsonString = $jsonString.']}';
					echo $jsonString;
				} else {
					echo('La consulta a la base de datos ha fallado.<br>'."\n");
					return false;
				}
			} else if (strpos($stringQuery, 'insert') !== false || strpos($stringQuery, 'update') !== false || strpos($stringQuery, 'delete') !== false) {
				$comandoCorrecto = mysql_query($stringQuery, $conexion);
				
				if ($comandoCorrecto !== false) {
					if ($showMessages === true) {
						echo('Se ha(n) afectado '.mysql_affected_rows($conexion).' filas.');
					}
					return true;
				} else {
					echo('El comando ha fallado.');
					return false;
				}
			} else {
				echo('Comando no reconocido.');
				return false;
			}
		} else {
			printDatabaseAccessStatus($conexion);
			return false;
		}
	}
?>