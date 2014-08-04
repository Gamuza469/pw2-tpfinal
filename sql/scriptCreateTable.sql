CREATE DATABASE `pw2-tpfinal`;

USE `pw2-tpfinal`;

/* Nivel 1 */
CREATE TABLE provincia (
	id_provincia 		INTEGER 		AUTO_INCREMENT,
	nombre				VARCHAR(19),
	PRIMARY KEY (`id_provincia`)
);

CREATE TABLE marca_avion (
	id_marca_avion		INTEGER			AUTO_INCREMENT,
	descripcion			VARCHAR(64),
	PRIMARY KEY (`id_marca_avion`)
);

/* Nivel 2 */
CREATE TABLE ciudad (
	id_ciudad			INTEGER			AUTO_INCREMENT,
	id_provincia		INTEGER,
	nombre				VARCHAR(128),
	PRIMARY KEY (`id_ciudad`, `id_provincia`),
	FOREIGN KEY (`id_provincia`) 		REFERENCES `provincia` (`id_provincia`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE modelo_avion (
	id_modelo_avion		INTEGER			AUTO_INCREMENT,
	id_marca_avion		INTEGER,
	nombre			VARCHAR(64),
	PRIMARY KEY (`id_modelo_avion`),
	FOREIGN KEY (`id_marca_avion`) 	REFERENCES `marca_avion` (`id_marca_avion`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

/* Nivel 3 */
CREATE TABLE aeropuerto (
	codigo_oaci			VARCHAR(4),
	id_ciudad			INTEGER,
	nombre				VARCHAR(128),
	PRIMARY KEY (`codigo_oaci`, `id_ciudad`),
	FOREIGN KEY (`id_ciudad`) 		REFERENCES `ciudad` (`id_ciudad`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE avion (
	codigo_avion		INTEGER			AUTO_INCREMENT,
	id_modelo_avion		INTEGER,
	cantidad_filas_primera		INTEGER,
	cantidad_columnas_primera	INTEGER,
	cantidad_filas_economy		INTEGER,
	cantidad_columnas_economy	INTEGER,
	PRIMARY KEY (`codigo_avion`, `id_modelo_avion`),
	FOREIGN KEY (`id_modelo_avion`) 	REFERENCES `modelo_avion` (`id_modelo_avion`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

/* Nivel 4 */
CREATE TABLE nombre_clase (
	id_nombre_clase		INTEGER			AUTO_INCREMENT,
	nombre				VARCHAR(64),
	PRIMARY KEY (`id_nombre_clase`)
);

CREATE TABLE vuelo (
	numero_vuelo				INTEGER			AUTO_INCREMENT,
	codigo_oaci_origen			VARCHAR(4),
	codigo_oaci_destino			VARCHAR(4),
	codigo_avion				INTEGER,
	frecuencia					VARCHAR(7),
	PRIMARY KEY (`numero_vuelo`, `codigo_oaci_origen`, `codigo_oaci_destino`, `codigo_avion`),
	FOREIGN KEY (`codigo_oaci_origen`)	REFERENCES `aeropuerto` (`codigo_oaci`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`codigo_oaci_destino`)	REFERENCES `aeropuerto` (`codigo_oaci`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`codigo_avion`)			REFERENCES `avion` (`codigo_avion`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE banco (
	id_banco			INTEGER			AUTO_INCREMENT,
	nombre				VARCHAR(64),
	PRIMARY KEY (`id_banco`)
);

CREATE TABLE empresa_medio_pago (
	id_empresa_medio_pago	INTEGER		AUTO_INCREMENT,
	nombre					VARCHAR(64),
	PRIMARY KEY (`id_empresa_medio_pago`)
);

CREATE TABLE medio_pago (
	codigo_medio_pago			VARCHAR(4),
	nombre						VARCHAR(64),
	PRIMARY KEY (`codigo_medio_pago`)
);

CREATE TABLE tipo_pago (
	id_tipo_pago				INTEGER		AUTO_INCREMENT,
	nombre						VARCHAR(32),
	cuotas						INTEGER,
	interes						INTEGER,
	PRIMARY KEY (`id_tipo_pago`)
);

/* Nivel 5 */
CREATE TABLE pasajero (
	dni					VARCHAR(8),
	nombre				VARCHAR(512),
	fecha_nacimiento	DATE,
	email				VARCHAR(256),
	PRIMARY KEY (`dni`)
);

CREATE TABLE clase_vuelo (
	id_clase_vuelo	INTEGER					AUTO_INCREMENT,
	numero_vuelo		INTEGER,
	id_nombre_clase		INTEGER,
	precio				INTEGER,
	PRIMARY KEY (`id_clase_vuelo`, `numero_vuelo`, `id_nombre_clase`),
	FOREIGN KEY (`numero_vuelo`)		REFERENCES `vuelo` (`numero_vuelo`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`id_nombre_clase`)	REFERENCES	 `nombre_clase` (`id_nombre_clase`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE forma_pago (
	id_forma_pago				INTEGER			AUTO_INCREMENT,
	id_banco					INTEGER,
	id_empresa_medio_pago		INTEGER,
	codigo_medio_pago			VARCHAR(4),
	id_tipo_pago				INTEGER,
	PRIMARY KEY (`id_forma_pago`, `id_banco`, `id_empresa_medio_pago`, `codigo_medio_pago`, `id_tipo_pago`),
	FOREIGN KEY (`id_banco`)			REFERENCES `banco` (`id_banco`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`id_empresa_medio_pago`)			REFERENCES `empresa_medio_pago` (`id_empresa_medio_pago`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`codigo_medio_pago`)			REFERENCES `medio_pago` (`codigo_medio_pago`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`id_tipo_pago`)			REFERENCES `tipo_pago` (`id_tipo_pago`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

/* Nivel 6 */
CREATE TABLE pasaje (
	id_pasaje			INTEGER			AUTO_INCREMENT,
	dni					VARCHAR(8),
	id_clase_vuelo		INTEGER,
	id_forma_pago		INTEGER,
	vuelta				BOOLEAN,
	pagado				BOOLEAN,
	checked_in			BOOLEAN,
	fecha_reserva		DATE,
	fecha_partida		DATE,
	fecha_regreso		DATE,
	numero_excedente	INTEGER,
	posicion			VARCHAR(6),
	cbu					VARCHAR(22),
	numero_tarjeta		VARCHAR(16),
	identificador_tarjeta	VARCHAR(3),
	PRIMARY KEY (`id_pasaje`, `dni`, `id_clase_vuelo`, `id_forma_pago`),
	FOREIGN KEY (`dni`)					REFERENCES `pasajero` (`dni`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`id_clase_vuelo`)		REFERENCES `clase_vuelo` (`id_clase_vuelo`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`id_forma_pago`)			REFERENCES `forma_pago` (`id_forma_pago`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

ALTER TABLE
	pasaje
	AUTO_INCREMENT=10000000
;
