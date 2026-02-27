CREATE DATABASE IF NOT EXISTS raumbuchung;
USE raumbuchung;

CREATE TABLE benutzer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    benutzername VARCHAR(50) NOT NULL,
    passwort VARCHAR(50) NOT NULL,
    rolle ENUM('mitarbeiter','admin') NOT NULL
);

CREATE TABLE raeume (
    id INT AUTO_INCREMENT PRIMARY KEY,
    raumname VARCHAR(50) NOT NULL,
    kapazitaet INT,
    aktiv BOOLEAN DEFAULT TRUE
);

CREATE TABLE buchungen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    raum_id INT,
    benutzer_id INT,
    datum DATE,
    start_block INT,
    block_anzahl INT,
    kursname VARCHAR(100),
    beschreibung TEXT,
    status ENUM('beantragt','bestätigt','abgelehnt') DEFAULT 'beantragt',
    FOREIGN KEY (raum_id) REFERENCES raeume(id),
    FOREIGN KEY (benutzer_id) REFERENCES benutzer(id)
);

INSERT INTO benutzer (benutzername, passwort, rolle)
VALUES 
('admin','admin123','admin'),
('max','1234','mitarbeiter');

INSERT INTO raeume (raumname, kapazitaet)
VALUES
('Raum A',20),
('Raum B',15);
