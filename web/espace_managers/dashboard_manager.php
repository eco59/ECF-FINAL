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
        <p>Dashboard manager
        </p>
    </section>
    <section class="creation_jeux">
        <a href="../espace_managers/creation_article.php">
            <button class="button_creer_jeux">Creer articles</button>
        </a>
    </section>
    <section class="afficher_jeux_videos ">
        <?php
        //connexion bdd
            include '../connexion_bdd/connexion_bdd.php';
            // Démarrer la session sur chaque page où vous en avez besoin
            session_start();
            // On recupere toutes les infos dans la bdd jeux_videos
            $recupArticles = $bdd->query('SELECT * FROM articles');
            while($Articles = $recupArticles->fetch()){
                $titre = htmlspecialchars($Articles['titre'], ENT_QUOTES, 'UTF-8');
                $auteur = htmlspecialchars($Articles['auteur'], ENT_QUOTES, 'UTF-8');
                $date_mise_a_jour = htmlspecialchars($Articles['date_mise_a_jour'], ENT_QUOTES, 'UTF-8');
                $id = htmlspecialchars($Articles['id'], ENT_QUOTES, 'UTF-8');
                ?>
                <div class="jeux_videos">
                    <div class="partie_titre">
                        <h1><?= $titre;?></h1>
                        <p><?= $auteur;?></p>
                        <p><?= $date_mise_a_jour;?></p>
                        
                        <a href="../details/articles_details.php?id=<?= $id; ?>">
                            <button class="retour">Voir les détails</button>
                        </a>
                    </div>
                    <div class="partie_button">
                        <a href="../espace_managers/modifier_articles.php?id=<?= $id; ?>">
                            <button class="button_modif">modifier l'article</button>
                        </a>
                        <a href="../espace_managers/supprimer_articles.php?id=<?= $id; ?>">
                            <button class="button_bannir">Supprimer l'article</button>
                        </a>
                    </div>
                </div>
                <br> <!--saut de ligne entre chaque articles -->
                <?php
            }
        ?>
    </section>
    <section class="deconnexion derniere_section">
        <a href="../deconnexion/logout.php">
            <button class="button_deconnexion">Deconnexion</button>
        </a>
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
