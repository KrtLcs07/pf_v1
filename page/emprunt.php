<?php
$objet = getObjet($_GET['obj']);
?>

<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    main {
        max-width: 500px;
        margin: 50px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #198754;
        margin-bottom: 20px;
        font-size: 24px;
    }

    p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    input[type="number"] {
        width: 100%;
        padding: 8px 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    input[type="submit"] {
        background-color: #198754;
        color: white;
        border: none;
        padding: 10px 20px;
        margin-top: 15px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #146c43;
    }

    .objet-label {
        font-weight: bold;
        color: #333;
    }
</style>

<main>
    <h2>Emprunter un objet</h2>
    <p class="objet-label">Objet : <?= htmlspecialchars($objet['nom_objet']) ?></p>

    <form action="./action/emprundre.php" method="POST">
        <label for="jour">Combien de jours ?</label>
        <input type="number" id="jour" name="jour" min="1" required>

        <input type="hidden" name="id_obj" value="<?= htmlspecialchars($_GET['obj']) ?>">

        <input type="submit" value="Valider">
    </form>
</main>