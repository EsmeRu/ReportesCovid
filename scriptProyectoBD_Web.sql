DROP DATABASE IF EXISTS ReportesCOVID;
CREATE DATABASE IF NOT EXISTS ReportesCOVID;
USE ReportesCOVID;

CREATE TABLE IF NOT EXISTS Usuarios(
	idUsuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Email VARCHAR(60) NOT NULL UNIQUE,
    Contraseña BLOB NOT NULL
);

CREATE TABLE IF NOT EXISTS Administradores(
	idAdministrador INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Email VARCHAR(60) NOT NULL UNIQUE,
    Contraseña BLOB NOT NULL
);

INSERT INTO Administradores VALUES (0,'Esmeralda Rubin Fausto','rubin.esmef@gmail.com',AES_ENCRYPT('pass123','esme'));
INSERT INTO Administradores VALUES (0,'Christian Alejandro Salas Inzunza','chsa_18@alu.uabcs.mx',AES_ENCRYPT('contra123','chris'));
INSERT INTO Administradores VALUES (0,'Jesus Antonio Zuñiga Arce','	jzuniga@uabcs.mx',AES_ENCRYPT('ponganos10porfa','profe'));

CREATE TABLE IF NOT EXISTS Municipios(
	idMunicipio INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(30) NOT NULL
);

INSERT INTO Municipios VALUES(0,'Mulegé');
INSERT INTO Municipios VALUES(0,'Comondú');
INSERT INTO Municipios VALUES(0,'Loreto');
INSERT INTO Municipios VALUES(0,'La Paz');
INSERT INTO Municipios VALUES(0,'Los Cabos');

CREATE TABLE IF NOT EXISTS Ciudades(
	idCiudad INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(30) NOT NULL,
    idMunicipio INT NOT NULL,
    CONSTRAINT FK_Ciudad_Municipio FOREIGN KEY (idMunicipio) REFERENCES Municipios(idMunicipio) ON DELETE RESTRICT ON UPDATE RESTRICT
);

-- Ciudades Mulegé
INSERT INTO Ciudades VALUES(0,'Guerrero Negro',1);
INSERT INTO Ciudades VALUES(0,'Santa Rosalía',1);

-- Ciudades Comondú
INSERT INTO Ciudades VALUES(0,'Ciudad Constitución',2);
INSERT INTO Ciudades VALUES(0,'Ciudad Insurgentes',2);

-- Ciudades Loreto
INSERT INTO Ciudades VALUES(0,'Loreto',3);
INSERT INTO Ciudades VALUES(0,'San Javier',3);

-- Ciudades La Paz
INSERT INTO Ciudades VALUES(0,'La Paz',4);
INSERT INTO Ciudades VALUES(0,'Todos Santos',4);

-- Ciudades Los Cabos
INSERT INTO Ciudades VALUES(0,'San José del Cabo',5);
INSERT INTO Ciudades VALUES(0,'Cabo San Lucas',5);

CREATE TABLE IF NOT EXISTS Reportes(
	idReporte INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idUsuario INT NOT NULL,
    NombreUsuario VARCHAR(100) NOT NULL,
    idMunicipio INT NOT NULL,
    NombreMunicipio VARCHAR(30) NOT NULL,
    idCiudad INT NOT NULL,
    NombreCiudad VARCHAR(30) NOT NULL,
    Dirección VARCHAR(100) NOT NULL,
    Fecha DATE NOT NULL,
    StatusRepo ENUM('En proceso','Confirmado','Rechazado','Pendiente') DEFAULT ('Pendiente'),
    Descripcion VARCHAR(500) NOT NULL,
    CONSTRAINT FK_Reportes_Clientes FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT FK_Reportes_Municipio FOREIGN KEY (idMunicipio) REFERENCES Municipios(idMunicipio) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT FK_ReportesCiudad FOREIGN KEY (idCiudad) REFERENCES Ciudades(idCiudad) ON DELETE RESTRICT ON UPDATE CASCADE
);

DELIMITER $$
CREATE PROCEDURE RegistrarUsuario(IN paramNombre VARCHAR(100), IN paramEmail VARCHAR(60), IN paramContraseña VARCHAR(20))
BEGIN
	IF paramNombre IS NOT NULL THEN
		IF paramEmail IS NOT NULL THEN
			IF paramContraseña IS NOT NULL THEN
				START TRANSACTION;
					INSERT INTO Usuarios VALUES (0,paramNombre,paramEmail,AES_ENCRYPT(paramContraseña,'usuario'));
				COMMIT;
			END IF;
        END IF;
    END IF;
END $$

DROP PROCEDURE ActualizarUsuario;
DELIMITER &&
CREATE PROCEDURE ActualizarUsuario(IN paramIdUsuario INT,IN paramNombre VARCHAR(100), IN paramEmail VARCHAR(60), IN paramContraseña VARCHAR(20))
BEGIN
	UPDATE Usuarios SET Nombre = paramNombre, Email = paramEmail, Contraseña = AES_ENCRYPT(paramContraseña,'usuario') WHERE idUsuario = paramIdUsuario;
END &&

DELIMITER %%
CREATE TRIGGER Before_Update_Usuario BEFORE UPDATE ON Usuarios FOR EACH ROW
BEGIN
	IF NEW.Nombre IS NULL THEN
		SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'El nombre no puede quedar vacío';
    ELSE
		IF NEW.Email IS NULL THEN
			SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'El correo no puede quedar vacío';
		ELSE
			IF NEW.Contraseña IS NULL THEN
				SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'La contraseña no puede quedar vacía';               
			END IF;
		END IF;
    END IF;
END %%

DROP PROCEDURE NuevoReporte;
DELIMITER &&
CREATE PROCEDURE NuevoReporte(IN paramidUsuario INT, paramidMunicipio INT, IN paramidCiudad INT, IN paramDireccion VARCHAR(100),IN paramDescripcion VARCHAR(200))
BEGIN
	DECLARE varNombreUsuario VARCHAR(100);
    DECLARE varNombreMunicipio VARCHAR(30);
    DECLARE varNombreCiudad VARCHAR(30);
	IF paramidUsuario IS NOT NULL THEN
		IF paramidMunicipio IS NOT NULL THEN
			IF paramidCiudad IS NOT NULL THEN
				IF paramDireccion IS NOT NULL THEN 
					IF paramDescripcion IS NOT NULL THEN
						START TRANSACTION;
							SELECT Nombre INTO varNombreMunicipio FROM Municipios WHERE idMunicipio = paramidMunicipio;
							SELECT Nombre INTO varNombreCiudad FROM Ciudades WHERE idCiudad = paramidCiudad;
							SELECT Nombre INTO varNombreUsuario FROM Usuarios WHERE idUsuario = paramidUsuario;
							INSERT INTO Reportes VALUES(0,paramidUsuario,varNombreUsuario,paramidMunicipio,varNombreMunicipio,paramidCiudad,varNombreCiudad,paramDireccion,CURDATE(),'Pendiente',paramDescripcion);
						COMMIT;
					END IF;
                END IF;
            END IF;
        END IF;
    END IF;
END &&

DROP PROCEDURE ActualizarReporte;
DELIMITER $$
CREATE PROCEDURE ActualizarReporte(IN paramIdReporte INT, IN paramidMunicipio INT, IN paramidCiudad INT, IN paramDireccion VARCHAR(100), IN paramDescripcion VARCHAR(200))
BEGIN
	DECLARE varNombreMunicipio VARCHAR(30) DEFAULT (SELECT Nombre FROM Municipios WHERE idMunicipio = paramidMunicipio);
    DECLARE varNombreCiudad VARCHAR(30) DEFAULT (SELECT Nombre FROM Ciudades WHERE idCiudad = paramidCiudad);
    UPDATE Reportes SET idMunicipio = paramidMunicipio, NombreMunicipio = varNombreMunicipio, idCiudad = paramidCiudad, NombreCiudad = varNombreCiudad, Dirección = paramDireccion, Descripcion = paramDescripcion WHERE idReporte = paramIdReporte;
END $$