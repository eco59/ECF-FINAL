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
            <a href="../accueil/accueil.php">
                <img src="../asset/logo.png" alt="logo">
            </a>
        </div>
        <div class="menu">
            <nav>
                <label for="toggle"><img src="../asset/menu.png" alt="menu"></label>
                <input type="checkbox" id="toggle">
                <div class="main_pages">
                <a href="../accueil/accueil.php">Accueil</a>
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
    <section class="condition comptes">
        <p>Infos comptes</p>
    </section>
    <section class="affichage_compte derniere_section">
        <?php
        //connexion bdd
            include '../connexion_bdd/connexion_bdd.php';
            // Démarrer la session sur chaque page où vous en avez besoin
            session_start();
            // afficher tous les membres
            $recupManager = $bdd->query('SELECT * FROM manager');
            while($manager = $recupManager->fetch()){
                // use htmlentities to prevent XSS
            echo '<p class="affichage_manager">' . htmlentities($manager['email'], ENT_QUOTES, 'UTF-8') . 
            '<a href="modifier_mdp_manager.php?id=' . htmlentities($manager['id'], ENT_QUOTES, 'UTF-8') . '"><button class="button_modif">Modifier le mot de passe</button></a>
            <a href="bannir_manager.php?id=' . htmlentities($manager['id'], ENT_QUOTES, 'UTF-8') . '"><button class="button_bannir">Bannir le manager</button></a></p>';
            }
            $recupProducteurs = $bdd->query('SELECT * FROM producteurs');
            while($producteurs = $recupProducteurs->fetch()){
                echo '
                <p class="affichage_producteur">' . htmlentities($producteurs['email'], ENT_QUOTES, 'UTF-8') . 
                '<a href="modifier_mdp_producteurs.php?id=' . htmlentities($producteurs['id'], ENT_QUOTES, 'UTF-8') . '"><button class="button_modif">Modifier le mot de passe</button></a>
                <a href="bannir_producteur.php?id=' . htmlentities($producteurs['id'], ENT_QUOTES, 'UTF-8') . '"><button class="button_bannir">Bannir le producteur</button></a></p>';
                
            }
            ?>
            <!--Fin d'afficher tous les membres -->
        </section>
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