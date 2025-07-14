-- Active: 1742219108388@@127.0.0.1@3306@pf_v1_data
CREATE DATABASE pf_v1_data;

----MEMBRE----
CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre ENUM('H', 'F'),
    email VARCHAR(200),
    ville VARCHAR(100),
    mdp VARCHAR(300),
    image_profil VARCHAR(300)
);

----CATEGORIE---
CREATE TABLE categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

----OBJET----
CREATE TABLE objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(200),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet (id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre (id_membre)
);

----IMAGE OBJET----
CREATE TABLE images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(300),
    FOREIGN KEY (id_objet) REFERENCES objet (id_objet)
);

----EMPRINT----
CREATE TABLE emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet (id_objet),
    FOREIGN KEY (id_membre) REFERENCES membre (id_membre)
);

SELECT * from membre;