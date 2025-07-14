<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Inscription</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body class="bg-light d-flex justify-content-center align-items-center">

    <div class="card shadow p-4" style="width: 100%; max-width: 420px;">
        <div class="text-center mb-3">
            <i class="bi bi-person-circle text-primary" style="font-size: 3rem;"></i>
            <h4 class="mt-2">Création de compte</h4>
        </div>

        <form action="./action/inscrire.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" required>
                <label for="nom"><i class="bi bi-person-fill me-2"></i>Nom</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                <label for="email"><i class="bi bi-envelope-fill me-2"></i>Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="ddn" id="ddn" placeholder="Date de naissance" required>
                <label for="ddn"><i class="bi bi-calendar-date-fill me-2"></i>Date de naissance</label>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label"><i class="bi bi-gender-ambiguous me-2"></i>Genre</label>
                <select class="form-select" name="genre" id="genre" required>
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" required>
                <label for="ville"><i class="bi bi-geo-alt-fill me-2"></i>Ville</label>
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
            <a href="login.php" class="text-decoration-none">
                <i class="bi bi-box-arrow-in-right me-1"></i>Déjà inscrit ? Se connecter
            </a>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>