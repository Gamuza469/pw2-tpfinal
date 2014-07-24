<html>
	<head>
		<title>.:: Check-In ::.</title>
		<?php
			require_once('./include/includeStylesheetAndScript.php');
		?>
	</head>
	<body>
		<div id="contenedor">
			<form action="./action/elegirAsientos.php" id="formCheckIn" method="post">
				<div class="encabezado">
					<div class="busca_vuelo">Check-In (Selecci&oacute;n de Asiento)</div>
					<div class="busca_vue">
						<div class="asientos">
							<table id="vistaAsientos" style="margin: auto">
								<thead>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="asientoSeleccionado">
							Asiento seleccionado: <input id="asientoSeleccionado" type="text"/>
						</div>
						<div class="boton">
							<div class="asiento_seleccion"><input name="submit" type="submit" value="Elegir Asiento" />
							<input type="button" value="Borrar Selecci&oacute;n" /></div>
						</div>							
					</div>
				</div>
			</form>	
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				var cantidadFilasEconomy = 10;
				var cantidadColumnasEconomy = 9;
				var cantidadFilasPrimera = 0;
				var cantidadColumnasPrimera = 0;

				var maxCantidadColumnasEconomy = 3;
				var maxCantidadFilasEconomy = 30;
				var maxCantidadColumnasPrimera = 2;
				var maxCantidadFilasPrimera = 10;

				var anchoTotalEconomy = 0;
				var largoTotalEconomy = 0;
				var anchoTotalPrimera = 0;
				var largoTotalPrimera = 0;

				var largoTotal = 0;
				var anchoTotal = 0;

				var cantidadAsientosEconomy = cantidadFilasEconomy * cantidadColumnasEconomy;
				var cantidadAsientosPrimera = cantidadFilasPrimera * cantidadColumnasPrimera;
				var cantidadTotal = cantidadAsientosEconomy + cantidadAsientosPrimera;

				var divisionesFilasEconomy = 0;
				var divisionesColumnasEconomy = 0;
				var divisionesFilasPrimera = 0;
				var divisionesColumnasPrimera = 0;

				var anchoGrupoColumnaEconomy = 0;
				var anchoGrupoColumnaEconomyResto = 0;
				var cantidadGrupoColumnasEconomy = 0;
				var largoGrupoFilaEconomy = 0;
				var largoGrupoFilaEconomyResto = 0;
				var cantidadGrupoFilasEconomy = 0;
				
				var anchoGrupoColumnaPrimera = 0;
				var anchoGrupoColumnaPrimeraResto = 0;
				var cantidadGrupoColumnasPrimera = 0;
				var largoGrupoFilaPrimera = 0;
				var largoGrupoFilaPrimeraResto = 0;
				var cantidadGrupoFilasPrimera = 0;

				var objetoCuerpoTabla;
				var filaActual;
				var columnaActual;
				var ubicacionColumna = 1;
				var ubicacionFila = 1;

				var asientosPintados = 0;
				var divisionesPintadas = 0;
				//__________________________________________________________________________________________________________
				// Fin declaracion de variables
				// Inicio calculos iniciales
				//__________________________________________________________________________________________________________

				if (cantidadFilasEconomy >= maxCantidadFilasEconomy) {
					largoGrupoFilaEconomy = maxCantidadFilasEconomy;
					cantidadGrupoFilasEconomy = parseInt((cantidadFilasEconomy / maxCantidadFilasEconomy), 10);
					largoGrupoFilaEconomyResto = cantidadFilasEconomy % maxCantidadFilasEconomy;
					divisionesFilasEconomy = cantidadGrupoFilasEconomy - 1;
					if (largoGrupoFilaEconomyResto > 0) {
						divisionesFilasEconomy++;
					}
				} else {
					largoGrupoFilaEconomy = cantidadFilasEconomy;
					cantidadGrupoFilasEconomy = 1;
				}

				if (cantidadColumnasEconomy > maxCantidadColumnasEconomy) {
					if (cantidadColumnasEconomy >= (maxCantidadColumnasEconomy * 2)) {
						anchoGrupoColumnaEconomy = maxCantidadColumnasEconomy;
						cantidadGrupoColumnasEconomy = parseInt((cantidadColumnasEconomy / maxCantidadColumnasEconomy), 10);
						anchoGrupoColumnaEconomyResto = cantidadColumnasEconomy % maxCantidadColumnasEconomy;
						divisionesColumnasEconomy = cantidadGrupoColumnasEconomy - 1;
						if (anchoGrupoColumnaEconomyResto > 0) {
							divisionesColumnasEconomy++;
						}
					} else {
						maxCantidadColumnasEconomy--;
						anchoGrupoColumnaEconomy = maxCantidadColumnasEconomy;
						cantidadGrupoColumnasEconomy = parseInt((cantidadColumnasEconomy / maxCantidadColumnasEconomy), 10);
						anchoGrupoColumnaEconomyResto = cantidadColumnasEconomy % maxCantidadColumnasEconomy;
						divisionesColumnasEconomy = cantidadGrupoColumnasEconomy - 1;
						if (anchoGrupoColumnaEconomyResto > 0) {
							divisionesColumnasEconomy++;
						}
					}
				} else {
					if (parseInt(maxCantidadColumnasEconomy / cantidadColumnasEconomy, 10) == 1) {
						anchoGrupoColumnaEconomyResto = 1;
					}
					maxCantidadColumnasEconomy = 1;
					anchoGrupoColumnaEconomy = 1;
					cantidadGrupoColumnasEconomy = cantidadColumnasEconomy - anchoGrupoColumnaEconomyResto;
					divisionesColumnasEconomy = cantidadColumnasEconomy - 1;
				}

				largoTotalEconomy = (cantidadGrupoFilasEconomy * largoGrupoFilaEconomy) + largoGrupoFilaEconomyResto + divisionesFilasEconomy;
				anchoTotalEconomy = (cantidadGrupoColumnasEconomy * anchoGrupoColumnaEconomy) + anchoGrupoColumnaEconomyResto + divisionesColumnasEconomy;

				if (cantidadFilasPrimera >= maxCantidadFilasPrimera) {
					largoGrupoFilaPrimera = maxCantidadFilasPrimera;
					cantidadGrupoFilasPrimera = parseInt((cantidadFilasPrimera / maxCantidadFilasPrimera), 10);
					largoGrupoFilaPrimeraResto = cantidadFilasPrimera % maxCantidadFilasPrimera;
					divisionesFilasPrimera = cantidadGrupoFilasPrimera - 1;
					if (largoGrupoFilaPrimeraResto > 0) {
						divisionesFilasPrimera++;
					}
				} else {
					largoGrupoFilaPrimera = cantidadFilasPrimera;
					cantidadGrupoFilasPrimera = 1;
				}

				if (cantidadColumnasPrimera > maxCantidadColumnasPrimera) {
					if (cantidadColumnasPrimera >= (maxCantidadColumnasPrimera * 2)) {
						anchoGrupoColumnaPrimera = maxCantidadColumnasPrimera;
						cantidadGrupoColumnasPrimera = parseInt((cantidadColumnasPrimera / maxCantidadColumnasPrimera), 10);
						anchoGrupoColumnaPrimeraResto = cantidadColumnasPrimera % maxCantidadColumnasPrimera;
						divisionesColumnasPrimera = cantidadGrupoColumnasPrimera - 1;
						if (anchoGrupoColumnaPrimeraResto > 0) {
							divisionesColumnasPrimera++;
						}
					} else {
						maxCantidadColumnasPrimera--;
						anchoGrupoColumnaPrimera = maxCantidadColumnasPrimera;
						cantidadGrupoColumnasPrimera = parseInt((cantidadColumnasPrimera / maxCantidadColumnasPrimera), 10);
						anchoGrupoColumnaPrimeraResto = cantidadColumnasPrimera % maxCantidadColumnasPrimera;
						divisionesColumnasPrimera = cantidadGrupoColumnasPrimera - 1;
						if (anchoGrupoColumnaPrimeraResto > 0) {
							divisionesColumnasPrimera++;
						}
					}
				} else {
					if (parseInt(maxCantidadColumnasPrimera / cantidadColumnasPrimera, 10) == 1) {
						anchoGrupoColumnaPrimeraResto = 1;
					}
					maxCantidadColumnasPrimera = 1;
					anchoGrupoColumnaPrimera = 1;
					cantidadGrupoColumnasPrimera = cantidadColumnasPrimera - anchoGrupoColumnaPrimeraResto;
					divisionesColumnasPrimera = cantidadColumnasPrimera - 1;
				}

				largoTotalPrimera = (cantidadGrupoFilasPrimera * largoGrupoFilaPrimera) + largoGrupoFilaPrimeraResto + divisionesFilasPrimera;
				anchoTotalPrimera = (cantidadGrupoColumnasPrimera * anchoGrupoColumnaPrimera) + anchoGrupoColumnaPrimeraResto + divisionesColumnasPrimera;

				largoTotal = largoTotalEconomy + largoTotalPrimera;
				anchoTotal = anchoTotalEconomy + anchoTotalPrimera;

				//__________________________________________________________________________________________________________
				// Fin calculos iniciales
				// Inicio generacion cuadricula asientos
				//__________________________________________________________________________________________________________

				objetoCuerpoTabla = $('#vistaAsientos tbody');

				for (ubicacionFila = 1; ubicacionFila <= largoTotalEconomy; ubicacionFila++) {
					objetoCuerpoTabla.append('<tr></tr>');
					filaActual = objetoCuerpoTabla.children('tr').eq(ubicacionFila - 1);
					for (ubicacionColumna = 1; ubicacionColumna <= anchoTotalEconomy; ubicacionColumna++) {
						filaActual.append('<td class="asiento" id="F' + ubicacionFila + 'C' + ubicacionColumna + '"></td>');
						columnaActual = filaActual.children('td').eq(ubicacionColumna - 1);
					}
				}
				
				//__________________________________________________________________________________________________________
				// Fin generacion cuadricula asientos
				// Inicio colocacion asientos disponibles
				//__________________________________________________________________________________________________________
				
				for (ubicacionFila = 1; ubicacionFila <= largoTotalEconomy; ubicacionFila++) {
					filaActual = objetoCuerpoTabla.children('tr').eq(ubicacionFila - 1);
					divisionesPintadas = 0;
					for (ubicacionColumna = 1; ubicacionColumna <= anchoTotalEconomy; ubicacionColumna++) {
						columnaActual = filaActual.children('td').eq(ubicacionColumna - 1);
						if (ubicacionColumna <= maxCantidadColumnasEconomy) {
							columnaActual.css('background-color', 'blue');
						} else if (ubicacionColumna <= (maxCantidadColumnasEconomy + anchoGrupoColumnaEconomyResto + divisionesPintadas) && divisionesPintadas == 1) {
							columnaActual.css('background-color', 'blue');
						} else if (ubicacionColumna <= (maxCantidadColumnasEconomy + anchoGrupoColumnaEconomy + divisionesPintadas) && divisionesPintadas == 1 && (anchoTotalEconomy - (cantidadGrupoColumnasEconomy * maxCantidadColumnasEconomy)  == 1 || anchoTotalEconomy - (cantidadGrupoColumnasEconomy * maxCantidadColumnasEconomy)  == 2)) {
							columnaActual.css('background-color', 'blue');
						} else if (ubicacionColumna >= (maxCantidadColumnasEconomy + anchoGrupoColumnaEconomyResto + divisionesPintadas) && divisionesPintadas == 2) {
							columnaActual.css('background-color', 'blue');
						} else {
							divisionesPintadas++;
						}
					}
				}
				
				//REESCRIBIR
				//Primero que dibuje todos los cuadros en azul en la funcion de arriba
				//Luego agregue columnas divisorias
				//Repetir para separacion de filas
				
				//__________________________________________________________________________________________________________
				// Fin colocacion asientos disponibles
				// Inicio separacion de filas
				//__________________________________________________________________________________________________________
				
				$('.asiento').click(function(){
					$(this).css('background-color', 'red');
					$('#asientoSeleccionado').val($(this).prop('id'));
				});
			});
		</script>
	</body>
</html>