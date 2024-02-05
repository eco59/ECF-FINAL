<?php
//connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = $_GET['id'];
        // On prepare la bdd pour vérifier si l'article est bien cree
        $recupArticles = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
        $recupArticles->execute(array($getid));
        if($recupArticles->rowCount() > 0){
            $Articles_infos = $recupArticles->fetch();
            // On recupere les infos 
            $titre = $Articles_infos['titre'];
            $contenu = $Articles_infos['contenu'];
            $auteur = $Articles_infos['auteur'];
            $date_mise_a_jour = $Articles_infos['date_mise_a_jour'];
            //enlever les balise br qui s'affiche automatiquement
            str_replace('<br />', '', $Articles_infos['contenu']);
            // si on appuye sur le bouton valider on change les informations
            if(isset($_POST['valider'])){
                $titre_saisie = htmlspecialchars($_POST['titre']);
                $contenu_saisie = nl2br(htmlspecialchars($_POST['contenu']));
                $auteur_saisie = nl2br(htmlspecialchars($_POST['auteur']));
                $date_mise_a_jour = nl2br(htmlspecialchars($_POST['date_mise_a_jour']));

                // On update les infos
                $updateArticles = $bdd->prepare('UPDATE articles SET 
                titre = ?, contenu = ?, auteur = ?, date_mise_a_jour = ? 
                WHERE id = ?');
                $updateArticles->execute(array($titre_saisie, $contenu_saisie, $auteur_saisie ,$date_mise_a_jour, $getid));
                // On redirige vers la page...
                header('Location: ../global/global_articles.php');
            }
        }else{
            echo " Aucun article trouvé";
        }

    }else{
        echo " Aucun identifiant trouvé";
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
    <section class="condition">
        <p>modifier un jeux vidéo
        </p>
    </section>
    <article class="publier_jeux">
        <form  class="publier_jeux_form" action="" method="POST">
            <input type="text" name="titre" value="<?= $titre; ?>">
            <textarea name="contenu"><?= $contenu; ?></textarea>
            <input type="text" placeholder="nom auteur" name="auteur" required>
            <input type="date" placeholder="date_mise_a_jour" name="date_mise_a_jour" value="<?php echo date('Y-m-d'); ?>">
            <input class="files" type="file" name="image" accept="image/*">
            <input class="button_creation" type="submit" name="valider" value="Modifier l'article">
        </form>
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