<?php
include("../../inc/sql_function.php");

inscrire_personne($_POST["email"], $_POST["mdp"], $_POST["nom"], $_POST["ddn"], $_POST["ville"], $_POST["genre"]);

$id = identifier_personne($_POST["email"], $_POST["mdp"]);
session_start();
$_SESSION["id"] = $id;
echo $id;

header("location:../model.php?page=liste.php");
