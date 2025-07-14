<?php
$liste = get_All_object();
?>


<style>
    .property-card img {
        object-fit: cover;
        height: 200px;
        width: 100%;
        transition: 1s all ease;

    }

    .property-card:hover {
        transform: translateY(-5px);
    }

    .badge-featured {
        background-color: purple;
    }

    .badge-sale {
        background-color: red;
    }

    .property-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .property-info i {
        margin-right: 5px;
    }
</style>


<main>


    <!-- Title -->
    <section class="container text-center mb-4">
        <h2>Liste des objects</h2>
        <p>Voici les objets disponibles.</p>
    </section>

    <section class="container">
        <div class="row">
            <!-- Property Card -->
            <?php foreach ($liste as $object) { ?>


                <article class="col-md-3">
                    <div class="property-card">
                        <div class="position-relative">
                            <a href="model.php?page=fiche.php&prop=<?= $object['id_objet'] ?>">
                                <img src="../assets/image/tank.jpg" alt="Property">
                            </a>

                            <?php if (is_empruter($object['id_objet'])) { ?>
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge badge-sale text-white">En emprunt</span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="p-3">
                            <h5></h5>
                            <p class="text-muted mb-2">
                                <i class="bi bi-info"></i> <?= $object['nom_objet'] ?>, de <?= get_user($object['id_membre'])['nom'] ?>
                            </p>
                            <div class="property-info d-flex justify-content-between mb-2">

                            </div>
                        </div>
                    </div>
                </article>
            <?php } ?>


        </div>
    </section>

    <script src="../asset/bootstrap/js/bootstrap.bundle.min.js"></script>
</main>