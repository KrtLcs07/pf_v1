<?php
include("../../inc/sql_function.php");

session_start();
rendre($_POST["id_emprunt"], $_POST["statut"]);

$id = $_SESSION["id"];
header("location:../model.php?page=ficheMembre.php&id=$id");
