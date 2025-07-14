<?php
session_start();
include("../../inc/sql_function.php");
include("../../inc/upload.php");

// Récupération des données
$nom_objet = $_POST['nom_objet'] ?? null;
$id_categorie = $_POST['id_categorie'] ?? null;
$id_membre = $_SESSION['id'] ?? null;

if (!$nom_objet || !$id_categorie || !$id_membre || !isset($_FILES['image_objet'])) {
    echo "Données manquantes.";
    exit;
}

// Insertion de l'objet
$id_objet = insert_object($nom_objet, $id_categorie, $id_membre);
if (!$id_objet) {
    echo "Erreur lors de l'insertion de l'objet.";
    exit;
}

// Traitement de toutes les images
$images = $_FILES['image_objet'];
for ($i = 0; $i < count($images['name']); $i++) {
    // Créer un sous-tableau pour chaque image
    $file = [
        'name' => $images['name'][$i],
        'type' => $images['type'][$i],
        'tmp_name' => $images['tmp_name'][$i],
        'error' => $images['error'][$i],
        'size' => $images['size'][$i]
    ];

    // Upload
    $chemin = upload2($file, "uploads/");
    if ($chemin !== null) {
        $nom_image = basename($chemin);
        insert_image_object($id_objet, $nom_image);
    }
}

// Redirection
header("location:../model.php?page=upload_objet.php");
exit;
?>
