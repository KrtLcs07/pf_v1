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

-------------------------EXEMPLE DE DONNEE--------------------------------------

---Membre---
INSERT INTO
    membre (
        nom,
        date_naissance,
        genre,
        email,
        ville,
        mdp,
        image_profil
    )
VALUES (
        'Alice',
        '1995-06-10',
        'F',
        'alice@example.com',
        'Antananarivo',
        'alice123',
        'alice.jpg'
    ),
    (
        'Bob',
        '1990-09-15',
        'H',
        'bob@example.com',
        'Majunga',
        'bob123',
        'bob.jpg'
    ),
    (
        'Claire',
        '2000-01-25',
        'F',
        'claire@example.com',
        'Toamasina',
        'claire123',
        'claire.jpg'
    ),
    (
        'David',
        '1988-12-05',
        'H',
        'david@example.com',
        'Fianarantsoa',
        'david123',
        'david.jpg'
    );

---Categorie---
INSERT INTO
    categorie_objet (nom_categorie)
VALUES ('Esthétique'),
    ('Bricolage'),
    ('Mécanique'),
    ('Cuisine');

-- Pour Alice (id_membre = 1)
INSERT INTO
    objet (
        nom_objet,
        id_categorie,
        id_membre
    )
VALUES ('Sèche-cheveux', 1, 1),
    ('Perceuse', 2, 1),
    ('Tournevis', 2, 1),
    ('Casserole', 4, 1),
    ('Lisseur', 1, 1),
    ('Mixer', 4, 1),
    ('Clé à molette', 3, 1),
    ('Friteuse', 4, 1),
    ('Crème visage', 1, 1),
    ('Ponceuse', 2, 1);

-- Pour Bob (id_membre = 2)
INSERT INTO
    objet (
        nom_objet,
        id_categorie,
        id_membre
    )
VALUES ('Rasoir électrique', 1, 2),
    ('Tournevis électrique', 2, 2),
    ('Pompe à vélo', 3, 2),
    ('Four électrique', 4, 2),
    ('Grille-pain', 4, 2),
    ('Boîte à outils', 2, 2),
    ('Gel coiffant', 1, 2),
    ('Nettoyeur vapeur', 2, 2),
    ('Casque de soudeur', 3, 2),
    ('Tondeuse', 1, 2);

-- Pour Claire (id_membre = 3)
INSERT INTO
    objet (
        nom_objet,
        id_categorie,
        id_membre
    )
VALUES ('Batteur', 4, 3),
    ('Fer à boucler', 1, 3),
    ('Moteur électrique', 3, 3),
    ('Spatule', 4, 3),
    ('Scie sauteuse', 2, 3),
    ('Blender', 4, 3),
    ('Écrouseuse', 3, 3),
    ('Palette de maquillage', 1, 3),
    ('Visseuse', 2, 3),
    ('Clé dynamométrique', 3, 3);

-- Pour David (id_membre = 4)
INSERT INTO
    objet (
        nom_objet,
        id_categorie,
        id_membre
    )
VALUES ('Micro-onde', 4, 4),
    ('Peigne', 1, 4),
    ('Perceuse murale', 2, 4),
    ('Pompe hydraulique', 3, 4),
    ('Tasse mesureuse', 4, 4),
    ('Épilateur', 1, 4),
    ('Tournevis cruciforme', 2, 4),
    ('Marteau', 2, 4),
    ('Friteuse sans huile', 4, 4),
    ('Outil multifonction', 2, 4);

--emprint--
INSERT INTO
    emprunt (
        id_objet,
        id_membre,
        date_emprunt,
        date_retour
    )
VALUES (
        1,
        2,
        '2025-07-01',
        '2025-07-05'
    ),
    (
        5,
        3,
        '2025-06-28',
        '2025-07-02'
    ),
    (12, 1, '2025-07-03', NULL),
    (
        18,
        4,
        '2025-07-05',
        '2025-07-10'
    ),
    (7, 3, '2025-07-04', NULL),
    (
        25,
        2,
        '2025-06-30',
        '2025-07-03'
    ),
    (30, 1, '2025-07-01', NULL),
    (
        35,
        2,
        '2025-07-06',
        '2025-07-12'
    ),
    (40, 3, '2025-07-02', NULL),
    (
        15,
        4,
        '2025-07-04',
        '2025-07-06'
    );

SELECT * FROM objet;

---
CREATE OR REPLACE VIEW v_liste_objets AS
SELECT
    o.id_objet,
    o.nom_objet,
    c.nom_categorie,
    c.id_categorie,
    m.nom AS proprietaire,
    (
        SELECT io.nom_image
        FROM images_objet io
        WHERE
            io.id_objet = o.id_objet
        LIMIT 1
    ) AS image_objet,
    e.date_emprunt,
    e.date_retour
FROM
    objet o
    JOIN categorie_objet c ON o.id_categorie = c.id_categorie
    JOIN membre m ON o.id_membre = m.id_membre
    LEFT JOIN emprunt e ON e.id_objet = o.id_objet;

SELECT * FROM emprunt;

SELECT * from v_liste_objets;

SELECT * FROM objet