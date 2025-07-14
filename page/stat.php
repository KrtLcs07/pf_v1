<?php
$statistiques = get_stat();
?>

<main class="container py-4">
    <section class="mb-4">
        <h2 class="text-center text-primary border-bottom pb-2">
            <i class="bi bi-clipboard-data me-2"></i>Statistiques des retours d’objets
        </h2>
    </section>

    <section class="row justify-content-center">
        <?php foreach ($statistiques as $statut => $total) { ?>
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php if (strtolower($statut) === 'ok') { ?>
                                <i class="bi bi-check-circle-fill text-success me-1"></i>
                            <?php } elseif (strtolower($statut) === 'abime') { ?>
                                <i class="bi bi-exclamation-triangle-fill text-danger me-1"></i>
                            <?php } else { ?>
                                <i class="bi bi-question-circle-fill text-secondary me-1"></i>
                            <?php } ?>
                            <?= $statut ?>
                        </h5>
                        <p class="card-text fs-4 fw-bold"><?= $total ?> emprunt(s)</p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
</main>