<?php

include("../inc/sql_function.php");

session_start();
$id = $_SESSION['id'];
$user = get_user($id);
if (!isset($_GET["page"])) {
    header("Location: ?page=liste.php");
    exit();
}

$page = $_GET["page"];

?>

<!DOCTYPE html>
<html lang="fr">

<style>
    .property-card img {
        object-fit: cover;
        height: 200px;
        width: 100%;
        transition: 0.5s ease;
    }

    .property-card:hover {
        transform: translateY(-5px);
    }

    .property-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        background-color: white;
    }

    .badge-sale {
        background-color: crimson;
    }

    .badge-cat {
        background-color: #0d6efd;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>V1 model</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg shadow-sm mb-4" style="background-color:aliceblue;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-box-seam-fill text-success me-2"></i> ShareBox
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="./model.php?page=liste.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./model.php?page=categorie_list.php">Catégorie</a></li>
                    <li class="nav-item"><a class="nav-link" href="./model.php?page=upload_objet.php">Nouveau</a></li>
                    <li class="nav-item"><a class="nav-link" href="./model.php?page=recherche.php">Recherche</a></li>
                    <li class="nav-item"><a class="nav-link" href="./model.php?page=stat.php">Statistique</a></li>




                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-info" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <?= $user['nom'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item " href="./model.php?page=ficheMembre.php&id=<?= $id ?>">
                                    <i class="bi bi-person me-1"></i> Profile
                                </a></li>
                            <li><a class="dropdown-item text-danger" href="./action/deconnect.php">
                                    <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                                </a></li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- ===== Contenu ===== -->
    <main class="container mb-5">

        <?php include($page); ?>
    </main>

    <!-- ===== Footer ===== -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-1">&copy; 2025 - Examen Final web S2. Tous droits réservés.</p>
            <small><i class="bi bi-layers"></i> ETU003916 && ETU003948 </small>
        </div>
    </footer>

    <script src="../asset/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>