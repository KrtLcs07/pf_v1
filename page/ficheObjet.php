<?php
if (!isset($_GET['obj'])) header("location:model.php?page=liste.php");

$id = $_GET['obj'];

function getObjet($id)
{
    $request = "SELECT * FROM v_liste_objets WHERE id_objet = $id";
    $result = mysqli_query(dbconnect(), $request);
    return mysqli_fetch_assoc($result);
}

function get_All_image_Objet($id)
{
    $request = "SELECT nom_image FROM images_objet WHERE id_objet = $id";
    $result = mysqli_query(dbconnect(), $request);
    $images = [];
    while ($donne = mysqli_fetch_assoc($result)) {
        $images[] = $donne['nom_image'];
    }
    return $images;
}

function getHistoriqueEmprunt($id_objet)
{
    $sql = "SELECT e.date_emprunt, e.date_retour, m.nom AS emprunteur
            FROM emprunt e
            JOIN membre m ON m.id_membre = e.id_membre
            WHERE e.id_objet = $id_objet
            ORDER BY e.date_emprunt DESC";
    $result = mysqli_query(dbconnect(), $sql);
    $historique = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $historique[] = $row;
    }
    return $historique;
}


$images = get_All_image_Objet($id);

$objet = getObjet($id);
?>

<style>
    .gallery-img {
        width: 70%;
        height: auto;
        border-radius: 8px;
        border: black solid 1px;
        object-fit: cover;
    }

    .badge-status {
        background-color: crimson;
        font-size: 0.9rem;
    }

    .section-title {
        font-weight: bold;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .property-details {
        background-color: #f9f9f9;
        padding: 1.5rem;
        border-radius: 8px;
    }
</style>

<main>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-8">
                <h2 class="mb-0">
                    <i class="bi bi-box-seam-fill text-success me-2"></i>
                    <?= ($objet['nom_objet']) ?>
                </h2>
                <p class="text-muted">
                    Catégorie : <strong><?= ($objet['nom_categorie']) ?></strong>
                </p>
            </div>
            <div class="col-md-4 text-end">
                <?php if ($objet['date_emprunt']) { ?>
                    <span class="badge badge-status text-white">
                        <i class="bi bi-clock-history me-1"></i> Emprunté (retour : <?= $objet['date_retour'] ?? 'inconnu' ?>)
                    </span>
                <?php } else { ?>
                    <span class="badge bg-success text-white">
                        <i class="bi bi-check2-circle me-1"></i> Disponible
                    </span>
                <?php } ?>
            </div>
        </div>

        <!-- Image -->
        <div class="row">
            <div class="col-md-6">
                <?php if (count($images) > 0) { ?>
                    <div id="carouselImagesObjet" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($images as $index => $img) { ?>
                                <div class="carousel-item <?= ($index === 0) ? 'active' : '' ?>">
                                    <img src="../uploads/<?= ($img) ?>" class="d-block w-100 gallery-img" alt="Objet image <?= $index + 1 ?>">
                                </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImagesObjet" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Précédent</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImagesObjet" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Suivant</span>
                        </button>
                    </div>
                <?php } else { ?>
                    <img src="../assets/image/placeholder.svg" class="gallery-img shadow-sm" alt="Aucune image disponible">
                <?php } ?>
            </div>

            <div class="col-md-6">
                <div class="property-details">
                    <h5><i class="bi bi-person-fill me-2"></i>Propriétaire</h5>
                    <p class="mb-1">Nom : <strong><?= ($objet['proprietaire']) ?></strong></p>
                    <p>Email : <i><?= get_user($objet['id_membre'])['email'] ?></i></p>
                    <p><a href="model.php?page=fichePersonne.php&id=<?= $objet['id_membre'] ?>" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-50-hover"> Voir plus sur la personne</a></p>
                    <?php if ($objet['date_emprunt']) { ?>
                        <hr>
                        <h6 class="mt-3"><i class="bi bi-calendar-event me-1"></i>Emprunt en cours</h6>
                        <p>Date d'emprunt : <?= $objet['date_emprunt'] ?></p>
                        <p>Date de retour prévue : <?= $objet['date_retour'] ?? 'Non spécifiée' ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <section class="mt-4">
            <h3 class="mb-3 text-info">
                <i class="bi clock-history me-2"></i>Historique des emprunts
            </h3>
            <div class="list-group">
                <?php foreach (getHistoriqueEmprunt($id) as $emp) { ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><i class="bi bi-person-fill"></i> <?= ($emp['emprunteur']) ?></strong>
                            <br>
                            <small class="text-muted">
                                <i class="bi bi-calendar-check me-1"></i>
                                Du <?= date("d/m/Y", strtotime($emp['date_emprunt'])) ?>
                                <?php if ($emp['date_retour']) { ?>
                                    au <?= date("d/m/Y", strtotime($emp['date_retour'])) ?>
                                <?php } else { ?>
                                    <span class="text-danger"> (En cours)</span>
                                <?php } ?>
                            </small>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

    </div>
</main>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>