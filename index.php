<?php
     //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';

    // Démarrage de la session
    session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../web/css/style.css">
    <link rel="stylesheet" href="../web/css/media_query.css">
    <title>GameSoft</title>
</head>
<body>
    <section class="haut_de_page">
        <div class="logo">
            <a href="../index.php">
                <img src="../asset/logo.png" alt="logo">
            </a>
        </div>
        <div class="menu">
            <nav>
                <label for="toggle"><img src="../asset/menu.png" alt="menu"></label>
                <input type="checkbox" id="toggle">
                <div class="main_pages">
                    <a href="../index.php">Accueil</a>
                    <?php
                        if(isset($_SESSION['pseudo'])) {
                            // L'utilisateur est connecté, affichez le lien du tableau de bord et le bouton de déconnexion
                            echo '<a href="../web/connexion_visiteurs/dashboard_visiteurs.php">Dashboard</a>';
                            echo '<a href="../web/deconnexion/logout.php">Déconnexion</a>';
                        } else {
                            // L'utilisateur n'est pas connecté, affichez le lien de connexion
                            echo '<a href="../web/connexion_visiteurs/connexion.php">Mon espace</a>';
                        }
                    ?>
                    <a href="../web/global/global_jeux.php">Tous les jeux vidéo</a>
                    <a href="../web/global/global_articles.php">Tous les articles</a>
                    <a href="../web/espace_admin/connexion_administrateurs.php">Espace administrateurs</a>
                    <a href="../web/espace_managers/connexion_managers.php">Espace managers</a>
                    <a href="../web/espace_producteurs/connexion_producteurs.php">Espace producteurs</a>
                </div>
            </nav>
        </div>
    </section>
    <section class="description_de_la_page">
        <p>Nous sommes une entreprise française de jeu vidéo.Avec principalement <br>
        des jeux de type RPG sur PC et a moindre sur console. <br>
        Nous vous proposons de participer à l'évolution du jeu video.<br>
        En effet, sur cette application vous avez le pouvoir de choisir<br>
        la priorité du jeu en développement ! Et comment faire ? <br>
        Et ben juste en mettant vos jeux préféré et attendu dans vos favori !<br>
        Plus le jeu sera dans vos favoris, sa note de priorité augmentera ! <br>
        Gamers a vos click, partez !
        </p>
    </section>
    <section class="articles">
        <div class="titre_articles">
            <p>« Super Mario RPG »,<br>
            la légende de la Super Nintendo s’essaye enfin au français
            </p>
            <img src="../asset/super-mario-rpg-0-min.jpg" alt="mario">
        </div>
        <article class="auteur_article">
            <p>
                Publié le 15 novembre 2023 à 15h14,<br> 
                modifié le 16 novembre 2023 à 09h17 Corentin Benoit-Gonin
            </p>
        </article>
        <div class="button_voir_plus">
            <a href="../web/global/global_articles.php">
                <button>VOIR PLUS D'ARTICLES</button>
            </a>
        </div>
    </section>
    <section class="jeux">
        <div class="titre_jeux">
            <p>Final Fantasy VII: Rebirth</p>
            <img src="../asset/FF7-min.jpg" alt="FF7">
        </div>
        <article class="description_jeux">
            <p>Seconde partie du remake de Final
            Fantasy VII, se déroulant aprés
            Midgar....
            </p>
        </article>
        <div class="button_voir_plus">
            <a href="../web/global/global_jeux.php">
                <button>VOIR TOUS LES JEUX</button>
            </a>
        </div>
    </section>
    <footer>
        <div class="mentions_obligatoire">
            <a href="../web/page_obligatoire/nous_contacter.php">NOUS CONTACTER</a>
            <a href="../web/page_obligatoire/mentions_legales.html">MENTIONS LEGALES</a>
            <a href="../web/page_obligatoire/politique_de_confidentialite.html">POLITIQUE DE CONFIDENTALITE</a>
        </div>
        <div class="logo_reseaux">
            <img src="../asset/facebook-min.jpg" alt="facebook">
            <img src="../asset/TIKTOK-min.jpg" alt="tiktok">
            <img src="../asset/twitter-min.jpg" alt="twitter">
            <img src="../asset/youtube-min.jpg" alt="youtube">
            <img src="../asset/linkedin-min.jpg" alt="linkedin">
        </div>
    </footer>
</body>
</html>