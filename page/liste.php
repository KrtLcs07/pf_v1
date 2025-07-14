<?php
$liste = get_All_object();
?>


<main>
    <section class="container text-center mb-4">
        <h2><i class="bi bi-box-seam-fill text-success me-2"></i>Liste des objets</h2>
        <p class="text-muted">Objets disponibles ou en cours d'emprunt</p>
    </section>

    <section class="container">
        <div class="row">
            <?php foreach ($liste as $object) { ?>
                <article class="col-md-3 col-sm-6">
                    <div class="property-card d-flex flex-column h-100">
                        <div class="position-relative">
                            <a href="model.php?page=ficheObjet.php&obj=<?= $object['id_objet'] ?>">
                                <img src="../uploads/<?= $object['image_objet'] ?? '../assets/image/placeholder.svg' ?>" alt="Objet" class="img-fluid" style="height: 200px; object-fit: cover;">
                            </a>

                            <?php if ($object['date_emprunt']) { ?>
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge badge-sale text-white">
                                        <i class="bi bi-clock-history me-1"></i> Emprunté
                                    </span>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="p-3 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h6 class="mb-1"><?= ($object['nom_objet']) ?></h6>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-person-fill me-1"></i>Propriétaire : <?= ($object['proprietaire']) ?>
                                </p>
                                <span class="badge badge-cat text-white mb-2"><?= ($object['nom_categorie']) ?></span>

                                <?php if ($object['date_emprunt']) { ?>
                                    <p class="text-danger small mb-0">
                                        Retour prévu : <?= ($object['date_retour'] ?? 'non défini') ?>
                                    </p>
                                <?php } else { ?>
                                    <p class="text-success small mb-2">Disponible</p>
                                <?php } ?>
                            </div>

                            <?php if (!$object['date_emprunt']) { ?>
                                <div class="text-end mt-2">
                                    <a href="model.php?page=emprunt.php&obj=<?= $object['id_objet'] ?>" class="btn btn-success btn-sm">
                                        <i class="bi bi-arrow-right-circle"></i> Emprunter
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </article>

            <?php } ?>
        </div>
    </section>
</main>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>