<html>
	<head>
		<title>.:: Pagar Pasaje ::.</title>
		<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/" id="formPagoPasaje" method="POST" enctype="text/plain">
				<div class="encabezado">
					<div class="busca_vuelo">Pagar Pasaje</div>
					<div class="busca_vue">
						<div class="medio_pago"><label class="nombreItem">Medio de Pago:</label>
							<select>
								 <option>Seleccione</option>
								 <option>1</option>
								 <option>2</option>
								 <option>3</option>
							 </select>
						</div>
						<div class="cia_emisora"><label class="nombreItem">Compa&ntilde&iacute;a Emisora:</label>
							<select>
								 <option>Seleccione</option>
								 <option>1</option>
								 <option>2</option>
								 <option>3</option>									 
							 </select>
						</div>
						<div class="tarjeta"><label class="nombreItem">Tipo de Tarjeta:</label>
							<select>
								 <option>Seleccione</option>
								 <option>1</option>
								 <option>2</option>
								 <option>3</option>
							 </select>
						</div>
						<div class="forma_pago"><label class="nombreItem">Forma de Pago:</label>
							<select>
								 <option>Seleccione</option>
								 <option>1</option>
								 <option>2</option>
								 <option>3</option>
							 </select>
						</div>	
						<div class="nro_tarj">
							<label class="nombreItem">Nro. de Tarjeta:</label>&nbsp;<input type="text" id="nro_tarjeta" name="nro_tarjeta"/>
						</div>	
						<div class="nro_Identificador">
							<label class="nombreItem">Nro. Identificador:</label>&nbsp;<input type="text" id="nro_identificador" name="nro_identificador"/>
						</div>		
						<BR>
						<div class="boton">
							<div class="opcion">
								<input type="submit" value="Pagar" />
								<input type="submit" value="Borrar Datos" />
							</div>
						</div>							
					</div>
				</div>
			</form>
		</div>
	</body>
</html>