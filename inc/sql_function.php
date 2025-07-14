<?php

require('connection.php');
///////////////Signin et login/////////////////
function inscrire_personne($email, $mdp, $nom, $dns, $ville, $genre)
{
    $requete = sprintf("INSERT INTO membre( email , mdp, nom ,date_naissance,ville,genre ) values ( '%s' , '%s' ,'%s' , '%s','%s','%s')", $email, $mdp, $nom, $dns, $ville, $genre);
    mysqli_query(dbconnect(), $requete);
    echo  $requete;
}

function identifier_personne($email, $mdp)
{
    $requete = sprintf("SELECT * FROM membre WHERE email ='%s' and mdp='%s'", $email, $mdp);
    echo $requete;
    $rqst_sql = mysqli_query(dbconnect(), $requete);
    if (mysqli_num_rows($rqst_sql) == 0) {
        return null;
    } else {
        return mysqli_fetch_assoc($rqst_sql)["id_membre"];
    }
}


/////////////////////User//////////////////////
function get_user($id_membre)
{
    $request = sprintf("select * from membre where id_membre=%s", $id_membre);
    $result = mysqli_query(dbconnect(), $request);
    $result = mysqli_fetch_assoc($result);
    return $result;
}

//////////////////Objet//////////////////////
function get_All_object()
{
    $request = "Select * from v_liste_objets order by date_emprunt DESC";
    $result = mysqli_query(dbconnect(), $request);
    $retour = [];
    while ($donne = mysqli_fetch_assoc($result)) {
        $retour[] = $donne;
    }
    return $retour;
}

function is_empruter($id)
{
    return true;
}

function get_All_categorie()
{
    $request = "Select * from categorie_objet";
    $result = mysqli_query(dbconnect(), $request);
    $retour = [];
    while ($donne = mysqli_fetch_assoc($result)) {
        $retour[] = $donne;
    }
    return $retour;
}

function get_All_object_categ($id_categ)
{


    $request = "SELECT * FROM v_liste_objets WHERE id_categorie = $id_categ  order by date_emprunt DESC";
    $result = mysqli_query(dbconnect(), $request);

    $retour = [];
    while ($donne = mysqli_fetch_assoc($result)) {
        $retour[] = $donne;
    }

    return $retour;
}
function insert_object($nom_objet, $id_categorie, $id_membre)
{

    $requete = "INSERT INTO objet (nom_objet, id_categorie, id_membre) 
                VALUES ('$nom_objet', $id_categorie, $id_membre)";


    mysqli_query(dbconnect(), $requete);


    $id_insere = mysqli_insert_id(dbconnect());

    return $id_insere;
}

function insert_image_object($id_objet, $nom_image)
{
    $conn = dbconnect();

    $requete = "INSERT INTO images_objet (id_objet, nom_image) VALUES ($id_objet, '$nom_image')";
    mysqli_query($conn, $requete);
}

function build_object_search_query($nom_objet = '', $id_categorie = '', $dispo = false)
{
    $conditions = [];

    if (!empty($nom_objet)) {
        $nom_objet = addslashes($nom_objet);
        $conditions[] = "v.nom_objet LIKE '%$nom_objet%'";
    }

    if (!empty($id_categorie)) {
        $id_categorie = intval($id_categorie);
        $conditions[] = "v.id_categorie = $id_categorie";
    }

    if ($dispo) {
        $conditions[] = "v.date_emprunt IS NULL";
    }

    $where = count($conditions) > 0 ? "WHERE " . implode(" AND ", $conditions) : "";
    return "SELECT * FROM v_liste_objets v $where";
}

function get_objets_Membre($id_membre)
{
    $request = "SELECT o.id_objet,o.nom_objet, c.nom_categorie, io.nom_image
                FROM objet o
                JOIN categorie_objet c ON o.id_categorie = c.id_categorie
                LEFT JOIN (
                    SELECT id_objet, MIN(nom_image) AS nom_image
                    FROM images_objet
                    GROUP BY id_objet
                ) io ON io.id_objet = o.id_objet
                WHERE o.id_membre = $id_membre
                ORDER BY c.nom_categorie";
    $result = mysqli_query(dbconnect(), $request);

    $grouped = [];
    while ($donne = mysqli_fetch_assoc($result)) {
        $grouped[$donne['nom_categorie']][] = $donne;
    }
    return $grouped;
}

function getObjet($id)
{
    $request = "SELECT * FROM v_liste_objets WHERE id_objet = $id";
    $result = mysqli_query(dbconnect(), $request);
    return mysqli_fetch_assoc($result);
}

function get_All_image_Objet($id)
{
    $request = "SELECT nom_image FROM images_objet WHERE id_objet = $id";
    $result = mysqli_query(dbconnect(), $request);
    $images = [];
    while ($donne = mysqli_fetch_assoc($result)) {
        $images[] = $donne['nom_image'];
    }
    return $images;
}

function getHistoriqueEmprunt($id_objet)
{
    $sql = "SELECT e.date_emprunt, e.date_retour, m.nom AS emprunteur
            FROM emprunt e
            JOIN membre m ON m.id_membre = e.id_membre
            WHERE e.id_objet = $id_objet
            ORDER BY e.date_emprunt DESC";
    $result = mysqli_query(dbconnect(), $sql);
    $historique = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $historique[] = $row;
    }
    return $historique;
}

function set_emprunt($id_objet, $id_membre, $nbjour)
{
    $conn = dbconnect();


    $requete = "INSERT INTO emprunt (
        id_objet,
        id_membre,
        date_emprunt,
        date_retour
    ) VALUES (
        $id_objet,
        $id_membre,
        NOW(),
        DATE_ADD(NOW(), INTERVAL $nbjour DAY)
    )";

    mysqli_query($conn, $requete);
}
