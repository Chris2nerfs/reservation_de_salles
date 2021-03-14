/*
 
 Coded by Chris2nerfS [ Web Developer ]
 chris2nerfs@swissonline.ch
 
 */
CREATE DATABASE Reservation_de_salles;
USE Reservation_de_salles;
CREATE USER 'AdminRdS' @'%' IDENTIFIED BY 'Admin789';
GRANT SELECT,
    INSERT,
    UPDATE,
    DELETE,
    CREATE,
    DROP,
    FILE,
    INDEX,
    ALTER,
    CREATE TEMPORARY TABLES,
    EXECUTE,
    CREATE VIEW,
    SHOW VIEW,
    CREATE ROUTINE,
    ALTER ROUTINE,
    EVENT,
    TRIGGER ON *.* TO 'AdminRdS' @'%';
CREATE TABLE salles (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    numero INT,
    etage INT,
    secteur VARCHAR(100),
    batiment VARCHAR(100),
    nbPlaces INT,
    projecteur BOOLEAN,
    tableau BOOLEAN,
    tele BOOLEAN
);
CREATE TABLE reservations (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    salle_id BIGINT,
    user_id BIGINT,
    dateJour DATE,
    heureDepart TIME,
    heureFin TIME,
    message VARCHAR(255),
    recurrence_id BIGINT
);
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    admin BOOLEAN,
    actif BOOLEAN,
    token VARCHAR(255),
    code VARCHAR(255)
);
CREATE TABLE reservations_reccurentes (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    dateDebut DATE,
    dateFin DATE,
    type INT,
    user_id BIGINT
);
INSERT INTO `users` (
        `id`,
        `nom`,
        `prenom`,
        `email`,
        `password`,
        `admin`,
        `actif`,
        `token`,
        `code`
    )
VALUES (
        1,
        'Admin',
        'Admin',
        'admin@realise.ch',
        'Admin2web',
        1,
        1,
        '*',
        'AA'
    );
/*  Création "users"*/
INSERT INTO `users`
SET `nom` = 'Krueger',
    `prenom` = 'Freddy',
    `email` = 'freddy.krueger@realise.ch',
    `password` = 'Freddy2web';
INSERT INTO `users`
SET `nom` = 'Voorhees',
    `prenom` = 'Jason',
    `email` = 'jason.voorhees@realise.ch',
    `password` = 'Jason2web';
INSERT INTO `users`
SET `nom` = 'Brutsch',
    `prenom` = 'Zazou',
    `email` = 'zazou.brutsch@realise.ch',
    `password` = 'Zazou2web';
INSERT INTO `users`
SET `nom` = 'Brutsch',
    `prenom` = 'Sibelle',
    `email` = 'sibelle.brutsch@realise.ch',
    `password` = 'Sibelle2web';
INSERT INTO `users`
SET `nom` = 'Brutsch',
    `prenom` = 'Stella',
    `email` = 'stella.brutsch@realise.ch',
    `password` = 'Stella2web';
/* Création "salle"*/
INSERT INTO `salles`
SET `numero` = '306',
    `etage` = '3',
    `secteur` = 'IEmploi',
    `batiment` = 'Marziano',
    `nbPlaces` = '8',
    `projecteur` = '0',
    `tableau` = '1';
INSERT INTO `salles`
SET `numero` = '405',
    `etage` = '4',
    `secteur` = 'IEmploi',
    `batiment` = 'Marziano',
    `nbPlaces` = '8',
    `projecteur` = '0',
    `tableau` = '0';
INSERT INTO `salles`
SET `id` = '4',
    `numero` = '305',
    `etage` = '3',
    `secteur` = 'IEmploi',
    `batiment` = 'Marziano',
    `nbPlaces` = '8',
    `projecteur` = '1',
    `tableau` = '0';
INSERT INTO `salles`
SET `id` = '8',
    `numero` = '406',
    `etage` = '4',
    `secteur` = 'IEmploi',
    `batiment` = 'Marziano',
    `nbPlaces` = '9',
    `projecteur` = '0',
    `tableau` = '1'
