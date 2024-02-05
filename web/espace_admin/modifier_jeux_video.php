<?php
//connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = $_GET['id'];
        
        // On prépare la requête pour vérifier si le jeu vidéo est bien créé
        $recupJeuxVideos = $bdd->prepare('SELECT * FROM jeux_videos WHERE id = ?');
        $recupJeuxVideos->execute(array($getid));
        
        // Traitement des images
        $dossier_images = "../images/";

        $image_paths = array();
        if(isset($_FILES["image"]) && is_array($_FILES["image"]["tmp_name"])) {
            foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {
                $nom_fichier = basename($_FILES["image"]["name"][$key]);
                $chemin_fichier = $dossier_images . $nom_fichier;
                move_uploaded_file($tmp_name, $chemin_fichier);
                $image_paths[] = $nom_fichier;
            }
        }

        if($recupJeuxVideos->rowCount() > 0){
            $jeux_videox_infos = $recupJeuxVideos->fetch();
            
            // On récupère les infos
            $titre = $jeux_videox_infos['titre'];
            $description = $jeux_videox_infos['description'];
            $date_de_creation = $jeux_videox_infos['date_de_creation'];
            $nombre_de_joueur = $jeux_videox_infos['nombre_de_joueur'];
            $Studio = $jeux_videox_infos['Studio'];
            $support = $jeux_videox_infos['support'];
            $moteur_jeux = $jeux_videox_infos['moteur_jeux'];
            $type_de_jeu = $jeux_videox_infos['type_de_jeu'];
            $date_fin = $jeux_videox_infos['date_fin'];
            $budget = $jeux_videox_infos['budget'];
            $statut_du_jeu = $jeux_videox_infos['statut_du_jeu'];
            $date_mise_a_jour = $jeux_videox_infos['date_mise_a_jour'];
            $commentaire = $jeux_videox_infos['commentaire'];
            $nom_prenom = $jeux_videox_infos['nom_prenom'];
            
            // Suppression des balises br qui s'affichent automatiquement
            str_replace('<br />', '', $jeux_videox_infos['description']);
            
            // Vérification si le formulaire est soumis
            if(isset($_POST['valider'])){
                //$titre_saisie = htmlspecialchars($_POST['titre']);
                $description_saisie = nl2br(htmlspecialchars($_POST['description']));
                $date_de_creation_saisie = date('Y-m-d', strtotime($_POST['date_de_creation']));
                $date_actuelle = strtotime(date('Y-m-d'));
    
                // Vérification de la date de création
                if($date_de_creation_saisie < $date_actuelle) {
                    echo "La date de création ne peut pas être antérieure à aujourd'hui.";
                } else {
                    $nombre_de_joueur_saisie = nl2br(htmlspecialchars($_POST['nombre_de_joueur']));
                    $Studio_saisie = nl2br(htmlspecialchars($_POST['Studio']));
                    $support_saisie = nl2br(htmlspecialchars($_POST['support']));
                    $moteur_jeux_saisie = nl2br(htmlspecialchars($_POST['moteur_jeux']));
                    $type_de_jeu_saisie = nl2br(htmlspecialchars($_POST['type_de_jeu']));
                    $date_fin_saisie = nl2br(htmlspecialchars($_POST['date_fin']));
                    $budget_saisie = nl2br(htmlspecialchars($_POST['budget']));
                    $statut_du_jeu_saisie = nl2br(htmlspecialchars($_POST['statut_du_jeu']));
                    $date_mise_a_jour_saisie = nl2br(htmlspecialchars($_POST['date_mise_a_jour']));
                    $commentaire_saisie = nl2br(htmlspecialchars($_POST['commentaire']));
                    $nom_prenom = nl2br(htmlspecialchars($_POST['nom_prenom']));
    
                    // On update les infos
                    $updateJeuxVideos = $bdd->prepare('UPDATE jeux_videos SET 
                    description = ?, date_de_creation = ?, nombre_de_joueur = ?, Studio = ?, support = ?, moteur_jeux = ?, type_de_jeu = ?, date_fin = ?, budget = ?, statut_du_jeu = ?, date_mise_a_jour = ?, commentaire = ?, nom_prenom = ? 
                    WHERE id = ?');
                    $updateJeuxVideos->execute(array($description_saisie, $date_de_creation_saisie, $nombre_de_joueur_saisie, $Studio_saisie, $support_saisie, $moteur_jeux_saisie, $type_de_jeu_saisie,
                    $date_fin_saisie, $budget_saisie, $statut_du_jeu_saisie, $date_mise_a_jour_saisie, $commentaire_saisie,$nom_prenom, $getid));
    
                    // Insérer les données dans la table images_jeux
                    $id_jeux_videos = $getid; // Utiliser l'ID du jeu vidéo existant
                    foreach ($image_paths as $image_path) {
                        $insererImages = $bdd->prepare('INSERT INTO images_jeux (id_jeux_videos, chemin_image) VALUES (?, ?)');
                        $insererImages->execute(array($id_jeux_videos, $image_path));
                    }
                    // Redirection vers la page...
                    header('Location: ../espace_admin/dashboard_admin.php');
                }
            }
        } else {
            echo "Aucun jeu vidéo trouvé";
        }
    
    } else {
        echo "Aucun identifiant trouvé";
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
        <p>modifier un jeux vidéo
        </p>
    </section>
    <article class="publier_jeux">
        <form class="publier_jeux_form" action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="titre" value="<?= $titre; ?>" disabled="disabled">
            <textarea name="description">
                <?= $description; ?>
            </textarea>
            <label class="input_description" for="date_de_creation">Date de création:</label>
            <input type="date" placeholder="date de création" name="date_de_creation" required>
            <input type="number" placeholder="nombre de joueur" name="nombre_de_joueur" required>
            <input type="text" placeholder="Gamesoft" name="Studio" value="Gamesoft" readonly>
            <select name="support" required>
                <option value="">Support de jeux</option>
                <option value="ordinateur" <?php if ($support === 'ordinateur') echo 'selected'; ?>>Ordinateur</option>
                <option value="console" <?php if ($support === 'console') echo 'selected'; ?>>Console</option>
                <option value="Console/Ordinateur" <?php if ($support === 'Console/Ordinateur') echo 'selected'; ?>>Console/Ordinateur</option>
            </select>
            <select name="moteur_jeux" required>
                <option value="">Moteur de jeux</option>
                <option value="Unity" <?php if ($moteur_jeux === 'Unity') echo 'selected'; ?>>Unity</option>
                <option value="Unreal" <?php if ($moteur_jeux === 'Unreal') echo 'selected'; ?>>Unreal</option>
                <option value="CryEngine" <?php if ($moteur_jeux === 'CryEngine') echo 'selected'; ?>>CryEngine</option>
            </select>
            <select name="type_de_jeu" required>
                <option value="">Tous les genres</option>
                <option value="Action" <?php if ($type_de_jeu === 'Action') echo 'selected'; ?>>Action</option>
                <option value="RPG" <?php if ($type_de_jeu === 'RPG') echo 'selected'; ?>>RPG</option>
                <option value="FPS" <?php if ($type_de_jeu === 'FPS') echo 'selected'; ?>>FPS</option>
                <option value="MMO" <?php if ($type_de_jeu=== 'MMO') echo 'selected'; ?>>MMO</option>
                <option value="Aventure" <?php if ($type_de_jeu=== 'Aventure') echo 'selected'; ?>>Aventure</option>
                <option value="Sport" <?php if ($type_de_jeu === 'Sport') echo 'selected'; ?>>Sport</option>
                <option value="Combat" <?php if ($type_de_jeu=== 'Combat') echo 'selected'; ?>>Combat</option>
                <option value="Stratégie" <?php if ($type_de_jeu === 'Stratégie') echo 'selected'; ?>>Stratégie</option>
            </select>
            <label class="input_description" for="date_fin">Date de fin:</label>
            <input type="date" placeholder="date estimé de fin" name="date_fin" value="<?php echo $derniereDateAnnee->format('Y-m-d');?>" >
            <input type="number" placeholder="budget" name="budget">
            <select name="statut_du_jeu">
                <option value="">Tous les statuts</option>
                <option value="En cours" <?php if ($statut_du_jeu === 'En cours') echo 'selected'; ?>>En cours</option>
                <option value="Fini" <?php if ($statut_du_jeu === 'Fini') echo 'selected'; ?>>Fini</option>
            </select>
            <label class="input_description" for="date_mise_a_jour">Date de mise a jour:</label>
            <input type="date" placeholder="date_mise_a_jour" name="date_mise_a_jour" value="<?php echo date('Y-m-d'); ?>">
            <label class="input_description" for="commentaire">Commentaire :</label>
            <textarea name="commentaire" rows="4" cols="50"></textarea><br>
            <input type="hidden" name="nom_prenom" value="<?= $nom_prenom; ?>">
            <input type="text" name="nom_prenom_disabled" placeholder="Mettez votre nom et prenom" value="<?= $nom_prenom; ?>" disabled="disabled">
            <input class="files" type="file" name="image[]" multiple>
            <input class="button_creation" type="submit" name="valider">
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