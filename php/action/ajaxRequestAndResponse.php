<?php
	require_once('../include/commonFunctions.php');
	
	$showMessages = false;
	$stringQuery = '';
	
	if (isset($_POST['verify']) && isset($_POST['requestType'])) {
		if ($_POST['verify'] == 'valid') {
			$conexion = checkDatabaseAccess();
			
			if ($_POST['requestType'] == 'ciudadSelect') {
				$stringQuery = "SELECT c.id_ciudad AS 'id_ciudad', c.nombre AS 'nombre_ciudad', p.nombre AS 'nombre_provincia' FROM ciudad c INNER JOIN provincia p ON c.id_provincia = p.id_provincia ORDER BY c.nombre";
			} else if ($_POST['requestType'] == 'provinciaSelect') {
				$stringQuery = "SELECT * FROM provincia ORDER BY nombre";
			} else if ($_POST['requestType'] == 'ciudadByProvinciaSelect') {
				$stringQuery = "SELECT * FROM ciudad WHERE id_provincia = ".$_POST['idProvincia']." ORDER BY nombre";
			} else if ($_POST['requestType'] == 'vuelosByOrigenDestinoSelect') {
				$stringQuery = "
					SELECT 
						v.codigo_oaci_origen, 
						v.codigo_oaci_destino,
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
			} else if ($_POST['requestType'] == 'clasesByVueloSelect') {
				$stringQuery = "SELECT cv.id_clase_vuelo, nc.nombre, cv.precio FROM clase_vuelo cv INNER JOIN vuelo v ON cv.numero_vuelo = v.numero_vuelo INNER JOIN nombre_clase nc ON 	cv.id_nombre_clase = nc.id_nombre_clase WHERE cv.numero_vuelo = ".$_POST['numeroVuelo'];
			} else if ($_POST['requestType'] == 'frecuenciaByVueloSelect') {
				$stringQuery = "SELECT v.frecuencia FROM vuelo v WHERE v.numero_vuelo = ".$_POST['numeroVuelo'];
			} else if ($_POST['requestType'] == 'medioPagoSelect') {
				$stringQuery = "SELECT * FROM medio_pago mp";
			} else if ($_POST['requestType'] == 'bancosByMedioPagoSelect') {
				$stringQuery = "
					SELECT DISTINCT
						b.id_banco,
						b.nombre AS nombre_banco
					FROM 
						banco b
					INNER JOIN
						forma_pago fp ON
						b.id_banco = fp.id_banco
					WHERE
						fp.codigo_medio_pago = '".$_POST['medioPago']."'"
				;
			} else if ($_POST['requestType'] == 'empresasByBancoAndMedioPagoSelect') {
				$stringQuery = "
					SELECT DISTINCT
						emp.id_empresa_medio_pago,
						emp.nombre AS nombre_empresa
					FROM 
						empresa_medio_pago emp
					INNER JOIN
						forma_pago fp ON
						emp.id_empresa_medio_pago = fp.id_empresa_medio_pago
					WHERE
						fp.codigo_medio_pago = '".$_POST['medioPago']."' AND
						fp.id_banco = ".$_POST['banco']
				;
			} else if ($_POST['requestType'] == 'tipoPagoByEmpresaAndBancoAndMedioPagoSelect') {
				$stringQuery = "
					SELECT
						fp.id_forma_pago,
						tp.id_tipo_pago,
						tp.nombre AS nombre_tipo
					FROM 
						tipo_pago tp
					INNER JOIN
						forma_pago fp ON
						tp.id_tipo_pago = fp.id_tipo_pago
					WHERE
						fp.codigo_medio_pago = '".$_POST['medioPago']."' AND
						fp.id_banco = ".$_POST['banco']." AND
						fp.id_empresa_medio_pago = ".$_POST['empresa']
				;
			} else if ($_POST['requestType'] == 'empresasByMedioPagoSelect') {
				$stringQuery = "
					SELECT DISTINCT
						emp.id_empresa_medio_pago,
						emp.nombre AS nombre_empresa
					FROM 
						empresa_medio_pago emp
					INNER JOIN
						forma_pago fp ON
						emp.id_empresa_medio_pago = fp.id_empresa_medio_pago
					WHERE
						fp.codigo_medio_pago = '".$_POST['medioPago']."'"
				;
			} else if ($_POST['requestType'] == 'tipoPagoByBancoSelect') {
				$stringQuery = "
					SELECT
						fp.id_forma_pago,
						tp.cuotas,
						tp.interes
					FROM 
						tipo_pago tp
					INNER JOIN
						forma_pago fp ON
						tp.id_tipo_pago = fp.id_tipo_pago
					WHERE
						fp.id_banco = ".$_POST['banco']." AND
						fp.codigo_medio_pago = '".$_POST['medioPago']."'"
				;
			} else if ($_POST['requestType'] == 'tipoPagoByEmpresaSelect') {
				$stringQuery = "
					SELECT
						fp.id_forma_pago,
						tp.cuotas,
						tp.interes
					FROM 
						tipo_pago tp
					INNER JOIN
						forma_pago fp ON
						tp.id_tipo_pago = fp.id_tipo_pago
					WHERE
						fp.id_empresa_medio_pago = ".$_POST['empresa']." AND
						fp.codigo_medio_pago = '".$_POST['medioPago']."'"
				;
			} else if ($_POST['requestType'] == 'formaPagoByMedioPagoBancoEmpresaTipoSelect') {
				$stringQuery = "
					SELECT
						tp.cuotas,
						tp.interes
					FROM 
						tipo_pago tp
					INNER JOIN
						forma_pago fp ON
						tp.id_tipo_pago = fp.id_tipo_pago
					WHERE
						fp.id_empresa_medio_pago = ".$_POST['empresa']." AND
						fp.codigo_medio_pago = '".$_POST['medioPago']."' AND
						fp.id_banco = ".$_POST['banco']." AND
						fp.id_tipo_pago = ".$_POST['tipoPago']
				;
			} else if ($_POST['requestType'] == 'tipoPagoEfectivoSelect') {
				$stringQuery = "
					SELECT
						fp.id_forma_pago,
						tp.cuotas,
						tp.interes
					FROM 
						tipo_pago tp
					INNER JOIN
						forma_pago fp ON
						tp.id_tipo_pago = fp.id_tipo_pago
					WHERE
						fp.codigo_medio_pago = '".$_POST['medioPago']."'"
				;
			} else if ($_POST['requestType'] == 'datosVueloSelect') {
				session_start();
				$stringQuery = "
					SELECT
						c.nombre AS ciudad_origen,
						cc.nombre AS ciudad_destino,
						p.nombre AS provincia_origen,
						pp.nombre AS provincia_destino,
						a.nombre AS aeropuerto_origen,
						aa.nombre AS aeropuerto_destino,
						cv.precio,
						nc.nombre AS nombre_clase
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
					INNER JOIN
						clase_vuelo cv ON
						v.numero_vuelo = cv.numero_vuelo
					INNER JOIN
						nombre_clase nc ON
						cv.id_nombre_clase = nc.id_nombre_clase
					WHERE
						v.numero_vuelo = ".$_SESSION['vuelo']." AND
						cv.id_clase_vuelo = ".$_SESSION['clase']
				;
			} else if ($_POST['requestType'] == 'fechaPartidaArrivo') {
				session_start();
				echo '{"respuesta": [{"fechaPartida": "'.$_SESSION['fechaPartida'].'", "fechaRegreso": "'.$_SESSION['fechaRegreso'].'", "idaVuelta": '.$_SESSION['idaVuelta'].'}]}';
			}
		}
		//echo $stringQuery;
		if ($stringQuery != '') {
			executeQuery($conexion, $stringQuery, $showMessages);
		}
	}
?>