<?php
include("./connection.php");



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
    return $rqst_sql;
}


/////////////////////User//////////////////////
function get_user($id_membre)
{
    $request = sprintf("select * from membre where id_membre=%s", $id_membre);
    $result = mysqli_query(dbconnect(), $request);
    $result = mysqli_fetch_assoc($result);
    return $result;
}
