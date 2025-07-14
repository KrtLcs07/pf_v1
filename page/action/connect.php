<?php
include("../../inc/sql_function.php");

$id = identifier_personne($_POST["email"], $_POST["mdp"]);

if ($id == null) {
    header("location:../login.php?err=1");
} else {
    session_start();
    $_SESSION["id"] = $id;
    echo $id;
    header("location:../model.php?page=liste.php");
}
