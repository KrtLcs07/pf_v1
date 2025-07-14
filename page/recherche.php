<?php

$nom_objet = $_POST['nom_objet'] ?? '';
$id_categorie = $_POST['id_categorie'] ?? '';
$dispo = isset($_POST['disponible']);

$conn = dbconnect();
$sql = build_object_search_query($nom_objet, $id_categorie, $dispo);
$res = mysqli_query($conn, $sql);
$categories = get_All_categorie();

?>

<h3 class="mb-4">Rechercher un objet</h3>

<form action="model.php?page=recherche.php" method="post" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="text" name="nom_objet" class="form-control" placeholder="Nom de l'objet" value="<?= ($nom_objet) ?>">
    </div>

    <div class="col-md-3">
        <select name="id_categorie" class="form-select">
            <?php foreach ($categories as $cat) { ?>
                <option value="<?= $cat['id_categorie'] ?>" <?= ($cat['id_categorie'] == $id_categorie) ? 'selected' : '' ?>>
                    <?= ($cat['nom_categorie']) ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-2 form-check pt-2">
        <input type="checkbox" name="disponible" class="form-check-input" id="dispo" <?= $dispo ? 'checked' : '' ?>>
        <label for="dispo" class="form-check-label">Disponible</label>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100" type="submit">Rechercher</button>
    </div>
</form>

<div class="row">
    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <a href="model.php?page=ficheObjet.php&obj=<?= $row['id_objet'] ?>">
                    <?php if (!empty($row['image_objet'])) { ?>
                        <img src="../uploads/<?= ($row['image_objet']) ?>" class="card-img-top" style="object-fit: cover; height: 200px;">
                    <?php } else { ?>
                        <img src="../assets/image/placeholder.svg" class="card-img-top" style="object-fit: cover; height: 200px;">
                    <?php } ?>
                </a>
                <div class="card-body">
                    <h5 class="card-title"><?= ($row['nom_objet']) ?></h5>
                    <p class="card-text">
                        <strong>Catégorie:</strong> <?= ($row['nom_categorie']) ?><br>
                        <strong>Propriétaire:</strong> <?= ($row['proprietaire']) ?><br>
                        <strong>Status:</strong>
                        <?= $row['date_emprunt'] ? '<span class="text-danger">Emprunté</span>' : '<span class="text-success">Disponible</span>' ?>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>