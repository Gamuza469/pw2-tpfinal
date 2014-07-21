<html>
	<head>
		<?php
			//Lógica principal
			//Lógica de sesión
			//Manejo de errores
		?>
		<title>.:: Buscador de Vuelo ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/procesarVuelo.php" id="formBuscadorVuelo" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Buscador de Vuelo</div>
					<div class="busca_vue">
						<div class="destino">
							<label class="nombreItem">Destino:</label>&nbsp;<textarea id="destino" name="destino" maxlength="128" readonly>aa</textarea>&nbsp;
							<input type="button" id="buscarDestino" name="buscarDestino" value="Buscar Destino"/>
						</div>
						<div class="origen">
							<label class="nombreItem">Origen:</label>&nbsp;<textarea id="origen" name="origen" maxlength="128" readonly>aa</textarea>&nbsp;
							<input type="button" id="buscarOrigen" name="buscarOrigen" value="Buscar Origen"/>
						</div>
						<div class="fecha_partida">
							<label class="nombreItem">Fecha Partida:</label>&nbsp;<input type="text" id="fechaPartida" name="fechaPartida" readonly />
						</div>	
						<div class="fecha_regreso">
							<label class="nombreItem">Fecha Regreso:</label>&nbsp;<input type="text" id="fechaRegreso" name="fechaRegreso" readonly />
						</div>
						<div class="circuito">
							<label class="nombreItem">Circuito:</label>
							<label>Ida</label><input type="radio" name="idaVuelta" id="ida" value="ida"/>
							<label>Ida/Vuelta</label><input type="radio" name="idaVuelta" id="vuelta" value="vuelta"/>
						</div>
						<br>
						<div class="boton">
							<div class="verifica"><input name="submit" type="submit" value="Verificar" /></div>
						</div>
						<?php
							echo('<input id="destino_hidden" name="destino_hidden" value="'."ABCD".'" type="hidden">');
							echo('<input id="origen_hidden" name="origen_hidden" value="'."ABCD".'" type="hidden">');
						?>						
					</div>
				</div>
			</form>
			<div id="dialogBuscarAeropuerto">
				asda
			</div
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#formBuscadorVuelo').validate({
					rules: {
						destino: {
							required: true
						},
						origen: {
							required: true
						},
						fechaPartida: {
							required: true
						},
						fechaRegreso: {
							required: true
						},
						idaVuelta: {
							required: true
						}
					},
					messages: {
						destino: 'Ingrese el destino.',
						origen:	'Ingrese el origen.',
						fechaPartida: 'Especifique la fecha de partida.',
						fechaRegreso: 'Especifique la fecha de regreso.',
						idaVuelta: 'Especifique la ruta del vuelo.'
					},
					submitHandler: function(form) {
						//Reformatea fechas
						form.submit();
					}
				});
				
				$('#buscarDestino, #buscarOrigen').click(function(){
					$('#dialogBuscarAeropuerto').dialog({
						buttons: [{
							text: 'Aceptar',
							click: function(){
								$(this).dialog('close');
							}
						},{
							text: 'Cancelar',
							click: function(){
								$(this).dialog('close');
							}
						}],
						modal: true
					});
				});
				
				$('#fechaPartida, #fechaRegreso').datepicker({
					beforeShowDay: function(fecha) {
						var dia = fecha.getDay();
						var habilitarDia = [(dia != 1 && dia != 2)];
						return habilitarDia;
					},
					buttonImage: '../css/images/calendar.gif',
					buttonImageOnly: true,
					changeMonth: true,
					changeYear: true,
					dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
					dateFormat: 'dd/mm/yy',
					minDate: '+3d',
					monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
					showOn: "button",
					showWeek: true,
					weekHeader: ''
				});
			});
		</script>
	</body>
</html>