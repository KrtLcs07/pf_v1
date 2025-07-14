<?php include("../../inc/sql_function.php");

$nom_objet = $_GET['nom_objet'] ?? '';
$id_categorie = $_GET['id_categorie'] ?? '';
$dispo = isset($_GET['disponible']);

$conn = dbconnect();
$sql = build_object_search_query($nom_objet, $id_categorie, $dispo);
$res = mysqli_query($conn, $sql);

?>

 <h3 class="mb-4">Rechercher un objet</h3>

    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="nom_objet" class="form-control" placeholder="Nom de l'objet" value="<?= htmlspecialchars($nom_objet) ?>">
        </div>

        <div class="col-md-3">
            <select name="id_categorie" class="form-select">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $cat) { ?>
                    <option value="<?= $cat['id_categorie'] ?>" <?= ($cat['id_categorie'] == $id_categorie) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nom_categorie']) ?>
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
                    <?php if (!empty($row['image_objet'])) { ?>
                        <img src="../../uploads/<?= htmlspecialchars($row['image_objet']) ?>" class="card-img-top" style="object-fit: cover; height: 200px;">
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['nom_objet']) ?></h5>
                        <p class="card-text">
                            <strong>Catégorie:</strong> <?= htmlspecialchars($row['nom_categorie']) ?><br>
                            <strong>Propriétaire:</strong> <?= htmlspecialchars($row['proprietaire']) ?><br>
                            <strong>Status:</strong>
                            <?= $row['date_emprunt'] ? '<span class="text-danger">Emprunté</span>' : '<span class="text-success">Disponible</span>' ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
