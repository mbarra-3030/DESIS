DROP 
  TABLE IF EXISTS comunas;
DROP 
  TABLE IF EXISTS regiones;
CREATE TABLE regiones (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
  nombre VARCHAR(100) NOT NULL, 
  PRIMARY KEY (id)
);
INSERT INTO regiones (nombre) 
VALUES 
  ('Arica y Parinacota'), 
  ('Tarapacá'), 
  ('Antofagasta'), 
  ('Atacama'), 
  ('Coquimbo'), 
  ('Valparaíso'), 
  ('Metropolitana de Santiago'), 
  (
    'Libertador General Bernardo O''Higgins'
  ), 
  ('Maule'), 
  ('Ñuble'), 
  ('Biobío'), 
  ('Araucanía'), 
  ('Los Ríos'), 
  ('Los Lagos'), 
  (
    'Aysén del General Carlos Ibáñez del Campo'
  ), 
  (
    'Magallanes y de la Antártica Chilena'
  );
-- Crear tabla de comunas
CREATE TABLE comunas (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
  nombre VARCHAR(100) NOT NULL, 
  region_id INT(11) UNSIGNED NOT NULL, 
  PRIMARY KEY (id), 
  FOREIGN KEY (region_id) REFERENCES regiones (id)
);
-- Insertar datos en la tabla de comunas
INSERT INTO comunas (nombre, region_id) 
VALUES 
  ('Arica', 1), 
  ('Camarones', 1), 
  ('Iquique', 2), 
  ('Alto Hospicio', 2), 
  ('Antofagasta', 3), 
  ('Calama', 3), 
  ('Copiapó', 4), 
  ('Chañaral', 4), 
  ('La Serena', 5), 
  ('Coquimbo', 5), 
  ('Valparaíso', 6), 
  ('Viña del Mar', 6), 
  ('Santiago', 7), 
  ('Puente Alto', 7), 
  ('Rancagua', 8), 
  ('Machalí', 8), 
  ('Talca', 9), 
  ('Curicó', 9), 
  ('Chillán', 10), 
  ('Cobquecura', 10), 
  ('Concepción', 11), 
  ('Talcahuano', 11), 
  ('Temuco', 12), 
  ('Padre Las Casas', 12), 
  ('Valdivia', 13), 
  ('La Unión', 13), 
  ('Puerto Montt', 14), 
  ('Castro', 14), 
  ('Coyhaique', 15), 
  ('Puerto Aysén', 15), 
  ('Punta Arenas', 16), 
  ('Porvenir', 16);
DROP 
  TABLE IF EXISTS votacion;
CREATE TABLE IF NOT EXISTS `desis`.`votacion` (
  `Id` INT NOT NULL AUTO_INCREMENT, 
  `NombreApellido` VARCHAR(50) NOT NULL, 
  `Alias` VARCHAR(50) NOT NULL, 
  `Rut` VARCHAR(50) NOT NULL, 
  `Email` VARCHAR(100) NOT NULL,
  `Region` VARCHAR(50) NOT NULL, 
  `Comuna` VARCHAR(50) NOT NULL, 
  `Candidato` VARCHAR(100) NOT NULL, 
  `OpcionWeb` BIT NOT NULL, 
  `OpcionTV` BIT NOT NULL, 
  `OpcionRedesSociales` BIT NOT NULL, 
  `OpcionAmigo` BIT NOT NULL, 
  PRIMARY KEY (`Id`)
) ENGINE = InnoDB;
DROP 
  TABLE IF EXISTS candidatos;
CREATE TABLE IF NOT EXISTS `desis`.`candidatos` (
  `id` INT NOT NULL AUTO_INCREMENT, 
  `NombreApellido` VARCHAR(100) NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;
INSERT INTO candidatos (NombreApellido) 
VALUES 
  ('José Antonio Kast'), 
  ('Gabriel Boric'), 
  ('Yasna Provoste'), 
  ('Sebastián Sichel'), 
  ('Eduardo Artés'), 
  ('Marco Enríquez-Ominami'), 
  ('Franco Parisi');
