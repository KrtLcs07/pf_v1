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
    $request = "Select * from v_liste_objets";
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


    $request = "SELECT * FROM v_liste_objets WHERE id_categorie = $id_categ";
    $result = mysqli_query(dbconnect(), $request);

    $retour = [];
    while ($donne = mysqli_fetch_assoc($result)) {
        $retour[] = $donne;
    }

    return $retour;
}
function insert_object($nom_objet, $id_categorie, $id_membre) {
    $requete = "INSERT INTO objet (nom_objet, id_categorie, id_membre) 
                VALUES ('$nom_objet', $id_categorie, $id_membre)";

    mysqli_query(dbconnect(), $requete);

    echo $requete;
}


