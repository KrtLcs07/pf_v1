<?php
session_start();
include("../../inc/sql_function.php");
include("../../inc/upload.php");


$nom_objet = $_POST['nom_objet'] ?? null;
$id_categorie = $_POST['id_categorie'] ?? null;
$id_membre = $_SESSION['id'] ?? null;



$image_path = upload2($_FILES['image_objet'], "uploads/");

if ($image_path === null) {
    echo "Erreur lors de l'upload de l'image.";
    exit;
}


$id_objet = insert_object($nom_objet, $id_categorie, $id_membre);

if (!$id_objet) {
    echo "Erreur lors de l'insertion de l'objet.";
    exit;
}


$nom_image = basename($image_path);
insert_image_object($id_objet, $nom_image);

header("location:../model.php?page=upload_objet.php");

?>
