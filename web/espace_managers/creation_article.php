<<<<<<< HEAD
<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier le jeton CSRF
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Invalid CSRF token');
        }
        if(isset($_POST['envoi'])){
                // Traitement de l'image
                $dossier_images = "../images/";
                $nom_fichier = basename($_FILES["image"]["name"]);
                $chemin_fichier = $dossier_images . $nom_fichier;

                // Déplacer l'image vers le dossier spécifié
                move_uploaded_file($_FILES["image"]["tmp_name"], $chemin_fichier);

            if(!empty($_POST['titre']) AND !empty($_POST['contenu'])){
                $titre = htmlspecialchars($_POST['titre']);
                $contenu = nl2br(htmlspecialchars($_POST['contenu']));
                $auteur = nl2br(htmlspecialchars($_POST['auteur']));
                $date_mise_a_jour = nl2br(htmlspecialchars($_POST['date_mise_a_jour']));

                //enlever les balise br qui s'affiche automatiquement
                str_replace('<br />', '', $Articles_infos['contenu']);
                
                // On insere dans la BDD les infos 
                $insererArticles = $bdd->prepare('INSERT INTO articles
                (titre, contenu, auteur, date_mise_a_jour, chemin_image)
                VALUES(?, ?, ?, ?, ?)');
                $insererArticles->execute(array($titre, $contenu, $auteur, $date_mise_a_jour, $nom_fichier));
                echo "<div class='condition'>Creation réussie !</div>";
            }else{
                echo"veuillez completer tous les champs...";
            }
            // Get the ID of the last inserted article
            $lastArticleID = $bdd->lastInsertId();
            // Return the ID as JSON
                echo json_encode(array("status" => "success", "articleID" => $lastArticleID));
            } else {
                echo json_encode(array("status" => "error", "message" => "Veuillez compléter tous les champs..."));
            }
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
        <p>Créer l'article
        </p>
    </section>
    <article class="publier_jeux">
            <form class="publier_jeux_form" action="" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="Titre" name="titre" required>
                <textarea name="contenu" required></textarea>
                <input type="hidden" value="<?php echo $_SESSION['csrf_token']; ?>" name="csrf_token" />
                <input type="text" placeholder="nom auteur" name="auteur" required>
                <input type="date" placeholder="date_mise_a_jour" name="date_mise_a_jour" value="<?php echo date('Y-m-d'); ?>"  >
                <input class="files" type="file" name="image" accept="image/*">
                <input class="button_creation" type="submit" name="envoi" value="créé l'article">
            </form>
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
=======
<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier le jeton CSRF
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Invalid CSRF token');
        }
        if(isset($_POST['envoi'])){
                // Traitement de l'image
                $dossier_images = "../images/";
                $nom_fichier = basename($_FILES["image"]["name"]);
                $chemin_fichier = $dossier_images . $nom_fichier;

                // Déplacer l'image vers le dossier spécifié
                move_uploaded_file($_FILES["image"]["tmp_name"], $chemin_fichier);

            if(!empty($_POST['titre']) AND !empty($_POST['contenu'])){
                $titre = htmlspecialchars($_POST['titre']);
                $contenu = nl2br(htmlspecialchars($_POST['contenu']));
                $auteur = nl2br(htmlspecialchars($_POST['auteur']));
                $date_mise_a_jour = nl2br(htmlspecialchars($_POST['date_mise_a_jour']));

                //enlever les balise br qui s'affiche automatiquement
                str_replace('<br />', '', $Articles_infos['contenu']);
                
                // On insere dans la BDD les infos 
                $insererArticles = $bdd->prepare('INSERT INTO articles
                (titre, contenu, auteur, date_mise_a_jour, chemin_image)
                VALUES(?, ?, ?, ?, ?)');
                $insererArticles->execute(array($titre, $contenu, $auteur, $date_mise_a_jour, $nom_fichier));
                echo "<div class='condition'>Creation réussie !</div>";
            }else{
                echo"veuillez completer tous les champs...";
            }
            // Get the ID of the last inserted article
            $lastArticleID = $bdd->lastInsertId();
            // Return the ID as JSON
                echo json_encode(array("status" => "success", "articleID" => $lastArticleID));
            } else {
                echo json_encode(array("status" => "error", "message" => "Veuillez compléter tous les champs..."));
            }
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
        <p>Créer l'article
        </p>
    </section>
    <article class="publier_jeux">
            <form class="publier_jeux_form" action="" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="Titre" name="titre" required>
                <textarea name="contenu" required></textarea>
                <input type="hidden" value="<?php echo $_SESSION['csrf_token']; ?>" name="csrf_token" />
                <input type="text" placeholder="nom auteur" name="auteur" required>
                <input type="date" placeholder="date_mise_a_jour" name="date_mise_a_jour" value="<?php echo date('Y-m-d'); ?>"  >
                <input class="files" type="file" name="image" accept="image/*">
                <input class="button_creation" type="submit" name="envoi" value="créé l'article">
            </form>
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
>>>>>>> a02418468dad454e9d1471734a741ca2dc502094
</html>