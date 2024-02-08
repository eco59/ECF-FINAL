<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/media_query.css">
    <title>GameSoft</title>
</head>
<body>
    <section class="haut_de_page">
        <div class="logo">
            <a href="../../index.php">
                <img src="../asset/logo.png" alt="logo">
            </a>
        </div>
        <div class="menu">
            <nav>
                <label for="toggle"><img src="../asset/menu.png" alt="menu"></label>
                <input type="checkbox" id="toggle">
                <div class="main_pages">
                <a href="../../index.php">Accueil</a>
                    <a href="../connexion_visiteurs/connexion.php">Mon espace</a>
                    <a href="../global/global_jeux.php">Tous les jeux vidéo</a>
                    <a href="../global/global_articles.php">Tous les articles</a>
                    <a href="../espace_admin/connexion_administrateurs.php">Espace administrateurs</a>
                    <a href="../espace_managers/connexion_managers.php">Espace managers</a>
                    <a href="../espace_producteurs/connexion_producteurs.php">Espace producteurs</a>
                </div>
            </nav>
        </div>
    </section>
    <section class="condition">
        <p>modifier un budget
        </p>
    </section>
    <<article class="publier_jeux derniere_section">
        <form  class="publier_jeux_form" action="" method="POST">
            <label class="input_description" for="titre">Titre du jeu :</label>
            <input type="text" name="titre" required><br>
            <label class="input_description" for="budget">Nouveau budget :</label>
            <input type="number" name="budget" step="0.01" required><br>
            <label class="input_description" for="commentaire">Commentaire :</label>
            <textarea name="commentaire" rows="4" cols="50"></textarea><br>
            <input class="button_creation" type="submit" value="Modifier le budget">
        </form>
        <?php
            //connexion bdd
            include '../connexion_bdd/connexion_bdd.php';
            // Démarrer la session sur chaque page où vous en avez besoin
            session_start();

                // Récupération des données du formulaire
                $titre = isset($_POST['titre']) ? trim($_POST['titre']) : '';
                $nouveauBudget = isset($_POST['budget']) ? $_POST['budget'] : '';
                $commentaire = isset($_POST['commentaire']) ? $_POST['commentaire'] : '';


                // Obtenez l'ancien budget pour l'enregistrement dans l'historique
                $requeteAncienBudget = "SELECT budget FROM jeux_videos WHERE LOWER(titre) = LOWER(?)";
                $stmtAncienBudget = $bdd->prepare($requeteAncienBudget);
                $stmtAncienBudget->execute([$titre]);
                $ancienBudget = $stmtAncienBudget->fetchColumn();


                // Requête SQL pour mettre à jour le budget
                $requeteMiseAJour = "UPDATE jeux_videos SET budget = ?, commentaire = ? WHERE titre = ?";
                $stmtMiseAJour = $bdd->prepare($requeteMiseAJour);
                $stmtMiseAJour->execute([$nouveauBudget, $commentaire, $titre]);

                $success = false; // Déclaration initiale de la variable $success

                $requeteHistorique = "INSERT INTO modification (id_jeux_videos, ancien_budget, nouveau_budget, commentaire)
                                    VALUES ((SELECT id FROM jeux_videos WHERE titre = ? LIMIT 1), ?, ?, ?)";
                $stmtHistorique = $bdd->prepare($requeteHistorique);

                $success = $stmtHistorique->execute([$titre, $ancienBudget, $nouveauBudget, $commentaire]);
            
            // Fermer la connexion
            $bdd = null;
        ?>
        </div>
    </article>
    <footer>
    <div class="mentions_obligatoire">
            <a href="../page_obligatoire/nous_contacter.php">NOUS CONTACTER</a>
            <a href="../page_obligatoire/mentions_legales.html">MENTIONS LEGALES</a>
            <a href="../page_obligatoire/politique_de_confidentialite.html">POLITIQUE DE CONFIDENTALITE</a>
        </div>
        <div class="logo_reseaux">
            <img src="../asset/facebook-min.jpg" alt="faceboook">
            <img src="../asset/TIKTOK-min.jpg" alt="tiktok">
            <img src="../asset/twitter-min.jpg" alt="twitter">
            <img src="../asset/youtube-min.jpg" alt="youtube">
            <img src="../asset/linkedin-min.jpg" alt="linkedin">
        </div>
    </footer>
</body>
</html>