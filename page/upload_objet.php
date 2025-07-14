<?php
$categories = get_All_categorie();
?>

<div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <div class="text-center mb-3">
        <i class="bi bi-box-seam text-primary" style="font-size: 3rem;"></i>
        <h4 class="mt-2">Nouvel Objet</h4>
    </div>

    <form action="./action/insert_object.php" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="nom_objet" id="nom_objet" placeholder="Nom de l'objet" required>
            <label for="nom_objet"><i class="bi bi-tag-fill me-2"></i>Nom de l'objet</label>
        </div>

        <div class="form-floating mb-3">
            <select name="id_categorie" class="form-select" id="id_categorie" required>
                <option value="" disabled selected>Choisir une catégorie</option>
                <?php foreach ($categories as $cat) { ?>
                    <option value="<?= $cat['id_categorie'] ?>">
                        <?= htmlspecialchars($cat['nom_categorie']) ?>
                    </option>
                <?php } ?>
            </select>
            <label for="id_categorie"><i class="bi bi-tags-fill me-2"></i>Catégorie</label>
        </div>

        <!-- Image principale -->
        <div class="mb-3">
            <label for="image_objet" class="form-label">
                <i class="bi bi-upload me-2"></i>Image principale (obligatoire)
            </label>
            <input class="form-control" type="file" name="image_objet[]" id="image_objet" required>
        </div>

        <!-- Image optionnelle 1 -->
        <div class="mb-3">
            <label for="image_objet_opt1" class="form-label">
                <i class="bi bi-upload me-2"></i>Image optionnelle 1
            </label>
            <input class="form-control" type="file" name="image_objet[]" id="image_objet_opt1">
        </div>

        <!-- Image optionnelle 2 -->
        <div class="mb-3">
            <label for="image_objet_opt2" class="form-label">
                <i class="bi bi-upload me-2"></i>Image optionnelle 2
            </label>
            <input class="form-control" type="file" name="image_objet[]" id="image_objet_opt2">
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Ajouter l'objet
            </button>
        </div>
    </form>

    <div class="mt-3 text-center">
        <a href="liste_objets.php" class="text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>Retour à la liste
        </a>
    </div>
</div>
