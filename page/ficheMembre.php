<?php
if (!isset($_GET['id'])) {
    header("location:liste.php?noset");
    exit;
}

$id = $_GET['id'];
$membre = get_user($id);

if ($membre == null) {
    header("location:model.php?page=liste.php");
    exit;
}



$mesObjets = get_objets_Membre($id);
?>


<style>
    .member-info img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #ccc;
    }

    .info-section {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .info-section p {
        font-size: 1rem;
        margin-bottom: 10px;
    }
</style>

<main class="container py-4">
    <section class="mb-4">
        <h2 class="text-center text-success border-bottom pb-2">
            <i class="bi bi-person-circle me-2"></i>Profil du membre
        </h2>
    </section>

    <section class="d-flex align-items-center member-info p-3 mb-4 bg-white rounded-2 shadow-sm">
        <img src="../uploads/<?= $membre['image_profil'] ?? '../assets/image/profile_icon.png' ?>" alt="Photo de profil">
        <div class="ms-3">
            <h5 class="mb-1"><?= ($membre['nom']) ?></h5>
            <p class="mb-0 text-muted"><i class="bi bi-envelope-fill me-1"></i> <?= ($membre['email']) ?></p>
        </div>
    </section>

    <section class="info-section">
        <div class="row gy-3">
            <div class="col-md-6">
                <p><i class="bi bi-gender-ambiguous me-1"></i> <strong>Genre :</strong>
                    <?= $membre['genre'] === "H" ? "Homme" : "Femme" ?>
                    <i class="bi bi-gender-<?= $membre['genre'] === "H" ? "male" : "female" ?>"></i>
                </p>
            </div>
            <div class="col-md-6">
                <p><i class="bi bi-calendar-date me-1"></i> <strong>Date de naissance :</strong>
                    <?= date("d/M/Y", strtotime($membre['date_naissance'])) ?>
                </p>
            </div>
            <div class="col-md-6">
                <p><i class="bi bi-geo-alt-fill me-1"></i> <strong>Ville :</strong> <?= ($membre['ville']) ?></p>
            </div>
        </div>
    </section>

    <section class="mt-5">
        <h4 class="text-primary mb-4"><i class="bi bi-box2-heart me-2"></i>Objets partagés</h4>

        <?php if (count($mesObjets) === 0) { ?>
            <div class="alert alert-warning">Ce membre n'a encore ajouté aucun objet.</div>
        <?php } else { ?>
            <?php foreach ($mesObjets as $categorie => $objets) { ?>
                <h5 class="mt-4 text-success">
                    <i class="bi bi-tags-fill me-1"></i><?= $categorie ?>
                </h5>
                <div class="row mb-3">
                    <?php foreach ($objets as $o) { ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="card shadow-sm mb-3">
                                <a href="model.php?page=ficheObjet.php&obj=<?= $o['id_objet'] ?>">
                                    <img src="../uploads/<?= $o['nom_image'] ?? '../assets/image/placeholder.svg' ?>" class="card-img-top" alt="<?= $o['nom_objet'] ?>" style="object-fit:cover; height:160px;">
                                </a>
                                <div class="card-body text-center p-2">
                                    <h6 class="card-title mb-0"><?= htmlspecialchars($o['nom_objet']) ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } ?>
    </section>

</main>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>