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

        // Vérifier si le formulaire a été soumis avec l'envoi
        if (isset($_POST['envoi'])) {
            if (!empty($_POST['titre']) && !empty($_POST['description'])) {
                // Traitement des données
                $titre = htmlspecialchars($_POST['titre']);
                $description = nl2br(htmlspecialchars($_POST['description']));

                // Vérification de la date de création
                $date_de_creation_saisie = strtotime($_POST['date_de_creation']);
                $date_actuelle = strtotime(date('Y-m-d'));
                $date_de_creation = $_POST['date_de_creation'];

                // Traitement des images
                $dossier_images = "../images/";
                $image_paths = array();

                foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {
                    $nom_fichier = basename($_FILES["image"]["name"][$key]);
                    $chemin_fichier = $dossier_images . $nom_fichier;
                    move_uploaded_file($tmp_name, $chemin_fichier);
                    $image_paths[] = $nom_fichier;
                }

                if ($date_de_creation_saisie < $date_actuelle) {
                    echo "La date de création ne peut pas être antérieure à aujourd'hui.";
                } else {
                    // Récupération des autres données du formulaire
                    $nombre_de_joueur = nl2br(htmlspecialchars($_POST['nombre_de_joueur']));
                    $Studio = nl2br(htmlspecialchars($_POST['Studio']));
                    $support = nl2br(htmlspecialchars($_POST['support']));
                    $moteur_jeux = nl2br(htmlspecialchars($_POST['moteur_jeux']));
                    $type_de_jeu = nl2br(htmlspecialchars($_POST['type_de_jeu']));
                    $date_fin = nl2br(htmlspecialchars($_POST['date_fin']));
                    $budget = nl2br(htmlspecialchars($_POST['budget']));
                    $statut_du_jeu = nl2br(htmlspecialchars($_POST['statut_du_jeu']));
                    $date_mise_a_jour = nl2br(htmlspecialchars($_POST['date_mise_a_jour']));
                    $commentaire = nl2br(htmlspecialchars($_POST['commentaire']));
                    $nom_prenom = nl2br(htmlspecialchars($_POST['nom_prenom']));

                    // Insérer les données dans la table jeux_videos
                    $insererJeuxVideos = $bdd->prepare('INSERT INTO jeux_videos
                    (titre, description, date_de_creation, nombre_de_joueur, Studio, support, moteur_jeux, type_de_jeu, date_fin, budget, statut_du_jeu, date_mise_a_jour, commentaire, nom_prenom)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    $insererJeuxVideos->execute(array(
                        $titre, $description, $date_de_creation, $nombre_de_joueur,
                        $Studio, $support, $moteur_jeux, $type_de_jeu, $date_fin, $budget, $statut_du_jeu,
                        $date_mise_a_jour, $commentaire, $nom_prenom
                    ));

                    // Insérer les données dans la table images_jeux
                    $id_jeux_videos = $bdd->lastInsertId(); // Get the last inserted ID from jeux_videos

                    foreach ($image_paths as $image_path) {
                        $insererImages = $bdd->prepare('INSERT INTO images_jeux (id_jeux_videos, chemin_image) VALUES (?, ?)');
                        $insererImages->execute(array($id_jeux_videos, $image_path));
                    }

                    echo "<div class='condition'>Création réussie !</div>";
                }
            } else {
                echo "Veuillez compléter tous les champs...";
            }
        }
    }

    // Création d'un objet DateTime pour la date actuelle
    $dateActuelle = new DateTime();

    // Obtention de l'année en cours
    $anneeEnCours = $dateActuelle->format('Y');

    // Création d'un objet DateTime pour la dernière date de l'année
    $derniereDateAnnee = new DateTime("$anneeEnCours-12-31");
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
        <p>Créer un jeux vidéo
        </p>
    </section>
    <article class="publier_jeux">
        <form class="publier_jeux_form" action="" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Titre" name="titre" required>
            <textarea placeholder="Description" name="description" required></textarea>
            <input type="hidden" value="<?php echo $_SESSION['csrf_token']; ?>" name="csrf_token" />
            <label class="input_description" for="date_de_creation">Date de création:</label>
            <input type="date" placeholder="date de création" name="date_de_creation" required>
            <input type="number" placeholder="nombre de joueur" name="nombre_de_joueur" required>
            <input type="text" placeholder="Gamesoft" name="Studio" value="Gamesoft" readonly>
            <select name="support" required>
                <option value="">Support de jeux</option>
                <option value="ordinateur">Ordinateur</option>
                <option value="console">Console</option>
                <option value="Console/Ordinateur">Console/Ordinateur</option>
            </select>
            <select name="moteur_jeux" required>
                <option value="">Moteur de jeux</option>
                <option value="Unity">Unity</option>
                <option value="Unreal">Unreal</option>
                <option value="CryEngine">CryEngine</option>
            </select>
            <select name="type_de_jeu" required>
                <option value="">Tous les genres</option>
                <option value="Action">Action</option>
                <option value="RPG">RPG</option>
                <option value="FPS">FPS</option>
                <option value="MMO">MMO</option>
                <option value="Aventure">Aventure</option>
                <option value="Sport">Sport</option>
                <option value="Combat">Combat</option>
                <option value="Stratégie">Stratégie</option>
            </select>
            <label class="input_description" for="date_fin">Date de fin:</label>
            <input type="date" placeholder="date estimé de fin" name="date_fin" value="<?php echo $derniereDateAnnee->format('Y-m-d');?>" >
            <input type="number" placeholder="budget" name="budget">
            <select name="statut_du_jeu">
                <option value="">Tous les statuts</option>
                <option value="En cours">En cours</option>
                <option value="Fini">Fini</option>
            </select>
            <label class="input_description" for="date_mise_a_jour">Date de mise a jour:</label>
            <input type="date" placeholder="date_mise_a_jour" name="date_mise_a_jour" value="<?php echo date('Y-m-d'); ?>" >
            <label class="input_description" for="commentaire">Commentaire :</label>
            <textarea name="commentaire" rows="4" cols="50"></textarea><br>
            <input type="text" name="nom_prenom" placeholder="Mettez votre nom et prenom" required>
            <input class="files" type="file" name="image[]" multiple>
            <input class="button_creation" type="submit" name="envoi" value="créer le jeu">
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
</html>