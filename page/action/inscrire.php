<?php
include("../../inc/sql_function.php");

inscrire_personne($_POST["email"], $_POST["mdp"], $_POST["nom"], $_POST["ddn"], $_POST["ville"], $_POST["genre"]);
