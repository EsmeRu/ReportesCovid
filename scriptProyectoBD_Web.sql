DROP DATABASE IF EXISTS ReportesCOVID;
CREATE DATABASE IF NOT EXISTS ReportesCOVID;
USE ReportesCOVID;

CREATE TABLE IF NOT EXISTS Clientes(
	idCliente INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    PrimerNombre VARCHAR(30) NOT NULL,
    SegundoNombre VARCHAR(30),
    PrimerApellido VARCHAR(30) NOT NULL,
    SegundoApellido VARCHAR(30),
    Email VARCHAR(60) NOT NULL UNIQUE,
    Contraseña BLOB NOT NULL
);

CREATE TABLE IF NOT EXISTS Administradores(
	idAdministrador INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    PrimerNombre VARCHAR(30) NOT NULL,
    SegundoNombre VARCHAR(30),
    PrimerApellido VARCHAR(30) NOT NULL,
    SegundoApellido VARCHAR(30),
    Email VARCHAR(60) NOT NULL UNIQUE,
    Contraseña BLOB NOT NULL
);

INSERT INTO Administradores VALUES (0,'Esmeralda', NULL ,'Rubin','Fausto','rubin.esmef@gmail.com',AES_ENCRYPT('pass123','esme'));
INSERT INTO Administradores VALUES (0,'Christian', 'Alejandro','Salas','Inzunza','chsa_18@alu.uabcs.mx',AES_ENCRYPT('contra123','chris'));
INSERT INTO Administradores VALUES (0,'Jesus', 'Antonio','Zuñiga','Arce','	jzuniga@uabcs.mx',AES_ENCRYPT('ponganos10porfa','profe'));

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
    idCliente INT NOT NULL,
    NombreCliente VARCHAR(120) NOT NULL,
    idMunicipio INT NOT NULL,
    NombreMunicipio VARCHAR(30) NOT NULL,
    idCiudad INT NOT NULL,
    NombreCiudad VARCHAR(30) NOT NULL,
    Dirección VARCHAR(100) NOT NULL,
    Fecha DATE NOT NULL,
    StatusRepo ENUM('En proceso','Confirmado','Rechazado','Pendiente') DEFAULT ('Pendiente'),
    CONSTRAINT FK_Reportes_Clientes FOREIGN KEY (idCliente) REFERENCES Clientes(idCliente) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT FK_Reportes_Municipio FOREIGN KEY (idMunicipio) REFERENCES Municipios(idMunicipio) ON DELETE RESTRICT ON UPDATE RESTRICT,
    CONSTRAINT FK_ReportesCiudad FOREIGN KEY (idCiudad) REFERENCES Ciudades(idCiudad) ON DELETE RESTRICT ON UPDATE CASCADE
);

DELIMITER $$
CREATE PROCEDURE RegistrarCliente(IN paramPrimerNombre VARCHAR(30), IN paramSegundoNombre VARCHAR(30), IN paramPrimerApellido VARCHAR(30), 
								  IN paramSegundoApellido VARCHAR(30), IN paramEmail VARCHAR(60), IN paramContraseña VARCHAR(20))
BEGIN
	IF paramPrimerNombre IS NOT NULL THEN
		IF paramPrimerApellido IS NOT NULL THEN
			IF paramEmail IS NOT NULL THEN
				IF paramContraseña IS NOT NULL THEN
					START TRANSACTION;
						INSERT INTO Clientes VALUES (0,paramPrimerNombre,paramSegundoNombre,paramPrimerApellido,paramSegundoApellido,paramEmail,AES_ENCRYPT(paramContraseña,'cliente'));
					COMMIT;
                END IF;
            END IF;
        END IF;
    END IF;
END $$

DELIMITER %%
CREATE TRIGGER Before_Update_Clientes BEFORE UPDATE ON Clientes FOR EACH ROW
BEGIN
	IF NEW.PrimerNombre IS NULL THEN
		SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'El primer nombre no puede quedar vacío';
    ELSE
		IF NEW.PrimerApellido IS NULL THEN
			SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'El primer apellido no puede quedar vacío';
        ELSE
			IF NEW.Email IS NULL THEN
				SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'El correo no puede quedar vacío';
            ELSE
				IF NEW.Contraseña IS NULL THEN
					SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'La contraseña no puede quedar vacía';               
                END IF;
            END IF;
        END IF;
    END IF;
END %%

DELIMITER &&
CREATE PROCEDURE NuevoReporte(IN paramidCliente INT, paramidMunicipio INT, IN paramidCiudad INT, IN paramDireccion VARCHAR(100))
BEGIN
	DECLARE varNombreCliente VARCHAR(120);
    DECLARE varSegundoNombre VARCHAR(30);
    DECLARE varSegundoApellido VARCHAR(30);
    DECLARE varNombreMunicipio VARCHAR(30);
    DECLARE varNombreCiudad VARCHAR(30);
	IF paramidCliente IS NOT NULL THEN
		IF paramidMunicipio IS NOT NULL THEN
			IF paramidCiudad IS NOT NULL THEN
				IF paramDireccion IS NOT NULL THEN 
					START TRANSACTION;
						SELECT SegundoNombre INTO varSegundoNombre FROM Clientes WHERE idCliente = paramidCliente;
                        SELECT SegundoApellido INTO varSegundoApellido FROM Clientes WHERE idCliente = paramidCliente;
                        SELECT Nombre INTO varNombreMunicipio FROM Municipios WHERE idMunicipio = paramidMunicipio;
                        SELECT Nombre INTO varNombreCiudad FROM Ciudades WHERE idCiudad = paramidCiudad;
                        IF varSegundoNombre IS NULL THEN
							SET varSegundoNombre = '';
                        END IF;
                        IF varSegundoApellido IS NULL THEN
							SET varSegundoApellido = '';
						END IF;
						SET varNombreCliente = CONCAT((SELECT PrimerNombre FROM Clientes WHERE idCliente = paramidCliente),(varSegundoNombre),(SELECT PrimerApellido FROM Clientes WHERE idCliente = paramidCliente),(varSegundoApellido));
						INSERT INTO Reportes VALUES(0,paramidCliente,varNombreCliente,paramidMunicipio,varNombreMunicipio,paramidCiudad,varNombreCiudad,paramDireccion,CURDATE(),'Pendiente');
                    COMMIT;
                END IF;
            END IF;
        END IF;
    END IF;
END &&