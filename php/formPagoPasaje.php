<html>
	<head>
		<title>.:: Pagar Pasaje ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
		<script src="../js/formPagoPasaje.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/pagandoPasaje.php" id="formPagoPasaje" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Pagar Pasaje</div>
					<div class="busca_vue">
						<div id="medio_pago"><label class="nombreItem">Medio de Pago:</label>
							<select id="medioPago" name="medioPago">
								 <option value="" selected>Seleccione...</option>
							 </select>
						</div>
						<div id="bancos"><label class="nombreItem">Banco:</label>
							<select id="banco" name="banco">
								 <option value="" selected>Seleccione...</option>					 
							 </select>
						</div>
						<div id="cia_emisora"><label class="nombreItem">Compa&ntilde&iacute;a Emisora:</label>
							<select id="emisor" name="emisor">
								 <option value="" selected>Seleccione...</option>				 
							 </select>
						</div>
						<div id="servicios"><label class="nombreItem">Servicio de Pagos:</label>
							<select id="servicio" name="servicio">
								 <option value="" selected>Seleccione...</option>					 
							 </select>
						</div>
						<div id="formas_pago"><label class="nombreItem">Forma de Pago:</label>
							<select id="formaPago" name="formaPago">
								 <option value="" selected>Seleccione...</option>
							 </select>
						</div>	
						<div id="nro_tarj">
							<label class="nombreItem">Nro. de Tarjeta:</label>&nbsp;<input type="text" id="nroTarjeta" maxlength="16" name="nroTarjeta"/>
						</div>	
						<div id="nro_ident">
							<label class="nombreItem">Nro. Identificador:</label>&nbsp;<input type="text" id="nroIdentificador" maxlength="3" name="nroIdentificador"/>
						</div>		
						<div id="nro_cuenta">
							<label class="nombreItem">Nro. Cuenta (C.B.U.):</label>&nbsp;<input type="text" id="nroCuenta" maxlength="22" name="nroCuenta"/>
						</div><br>
						<div class="monto">
							<label class="nombreItem">Monto a Pagar:</label>&nbsp;<input type="text" id="monto" name="monto" readonly />
						</div>	
						<div id="efect">
							Deber&aacute; acercarse a nuestras oficinas con el fin de abonar el monto requerido.
						</div>
						<div>
							<input type="hidden" id="codigoReserva" name="codigoReserva" value=""/>
							<input type="hidden" id="montoOriginal" name="montoOriginal" value=""/>
							<input type="hidden" id="formaPagoComun" name="formaPagoComun" value=""/>
						</div>
						<BR>
						<div class="boton">
							<div class="opcion">
								<input name="submit" type="submit" value="Pagar" />
								<input type="reset" value="Borrar Datos" />
							</div>
						</div>							
					</div>
				</div>
			</form>
		</div>
	</body>
</html>