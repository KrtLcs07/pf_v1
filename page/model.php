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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen model</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <!-- ===== Navbar ===== -->
    <nav class="navbar navbar-expand-lg shadow-sm mb-4" style="background-color:aliceblue;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-box-seam-fill text-success me-2"></i> ShareBox
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item "><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Recherche</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pages</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Uploads</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Deconnexion</a></li>
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