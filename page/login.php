<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-3">
            <i class="bi bi-box-arrow-in-right text-success" style="font-size: 3rem;"></i>
            <h4 class="mt-2">Connexion</h4>
        </div>

        <form action="./action/traitement_log.php" method="post">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                <label for="email"><i class="bi bi-envelope-fill me-2"></i>Email</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe" required>
                <label for="mdp"><i class="bi bi-lock-fill me-2"></i>Mot de passe</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-2"></i>Valider
                </button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <a href="inscription.php" class="text-decoration-none">
                <i class="bi bi-person-plus me-1"></i>Pas encore de compte ?
            </a>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>