<?php
    // Inclusion du fichier de connexion à la base de données
    include_once '../connexion_bdd/connexion_bdd.php';
    // Démarrage de la session
    session_start();

    // Vérification si l'identifiant de l'article est défini dans l'URL
    if(isset($_GET['id'])) {
        // Récupération de l'identifiant de l'article depuis l'URL
        $id_article = htmlspecialchars($_GET['id']);

        // Préparation de la requête pour récupérer les informations de l'article spécifique
        $recupArticles = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
        // Exécution de la requête en liant le paramètre
        $recupArticles->execute([$id_article]);
        // Récupération des données de l'article
        $Articles = $recupArticles->fetch();
        // Suppression des balises br qui s'affichent automatiquement
        $Articles['contenu'] = str_replace('<br />', '', $Articles['contenu']);
        // Vérification si l'article existe
        if(!$Articles) {
            // Redirection vers la page de liste des articles ou affichage d'un message d'erreur
            header('Location: ../global/global_articles.php');
            exit();
        }
    } else {
        // Redirection vers la page de liste des articles si l'identifiant de l'article n'est pas défini dans l'URL
        header('Location: ../global/global_articles.php');
        exit();
    }
?>

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
                    <?php
                        if(isset($_SESSION['pseudo'])) {
                            // L'utilisateur est connecté, affichez le lien du tableau de bord et le bouton de déconnexion
                            echo '<a href="../connexion_visiteurs/dashboard_visiteurs.php">Dashboard</a>';
                            echo '<a href="../deconnexion/logout.php">Déconnexion</a>';
                        } else {
                            // L'utilisateur n'est pas connecté, affichez le lien de connexion
                            echo '<a href="../connexion_visiteurs/connexion.php">Mon espace</a>';
                        }
                    ?>
                    <a href="../global/global_jeux.php">Tous les jeux vidéo</a>
                    <a href="../global/global_articles.php">Tous les articles</a>
                    <a href="../espace_admin/connexion_administrateurs.php">Espace administrateurs</a>
                    <a href="../espace_managers/connexion_managers.php">Espace managers</a>
                    <a href="../espace_producteurs/connexion_producteurs.php">Espace producteurs</a>
                </div>
            </nav>
        </div>
    </section>
    <section class="description_de_la_page_articles">
        <p>Toutes les infos geek en détails !
        </p>
    </section>
    <article class="articles_en_details derniere_section">
        <h1><?= htmlspecialchars($Articles['titre']); ?></h1>
        <p class="contenu"><?= htmlspecialchars($Articles['contenu']); ?></p>
        <img src="../images/<?= htmlspecialchars($Articles['chemin_image']); ?>" alt="<?= htmlspecialchars($Articles['titre']); ?>">
        <div class="petite_infos">
            <p class="auteur">Ecrit par : <?= htmlspecialchars($Articles['auteur']); ?></p>
            <p class="date_mise_a_jour"><?= htmlspecialchars($Articles['date_mise_a_jour']); ?></p>
        </div>
        <div class="div_retour">
            <a href="../global/global_articles.php">
                <button class="retour">Retour à la liste des articles</button>
            </a>
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
