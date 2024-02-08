<<<<<<< HEAD
<?php
//connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();

    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = htmlentities($_GET['id']);
        // On prepare la bdd pour vérifier si le jeux video est bien cree
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
            // On recupere les infos 
            $titre = htmlspecialchars($jeux_videox_infos['titre'], ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars($jeux_videox_infos['description'], ENT_QUOTES, 'UTF-8');
            $date_de_creation = htmlspecialchars($jeux_videox_infos['date_de_creation'], ENT_QUOTES, 'UTF-8');
            $nombre_de_joueur = htmlspecialchars($jeux_videox_infos['nombre_de_joueur'], ENT_QUOTES, 'UTF-8');
            $Studio = htmlspecialchars($jeux_videox_infos['Studio'], ENT_QUOTES, 'UTF-8');
            $support = htmlspecialchars($jeux_videox_infos['support'], ENT_QUOTES, 'UTF-8');
            $moteur_jeux = htmlspecialchars($jeux_videox_infos['moteur_jeux'], ENT_QUOTES, 'UTF-8');
            $type_de_jeu = htmlspecialchars($jeux_videox_infos['type_de_jeu'], ENT_QUOTES, 'UTF-8');
            $date_fin = htmlspecialchars($jeux_videox_infos['date_fin'], ENT_QUOTES, 'UTF-8');
            $budget = htmlspecialchars($jeux_videox_infos['budget'], ENT_QUOTES, 'UTF-8');
            $statut_du_jeu = htmlspecialchars($jeux_videox_infos['statut_du_jeu'], ENT_QUOTES, 'UTF-8');
            $date_mise_a_jour = htmlspecialchars($jeux_videox_infos['date_mise_a_jour'], ENT_QUOTES, 'UTF-8');
            $commentaire = htmlspecialchars($jeux_videox_infos['commentaire'], ENT_QUOTES, 'UTF-8');
            $nom_prenom = htmlspecialchars($jeux_videox_infos['nom_prenom'], ENT_QUOTES, 'UTF-8');
            //enlever les balise br qui s'affiche automatiquement
            str_replace('<br />', '', $jeux_videox_infos['description']);
            // si on appuye sur le bouton valider on change les informations


            $enregistrerAnciennesDonnees = $bdd->prepare('INSERT INTO modification (id_jeux_videos, ancien_budget, nouveau_budget, commentaire) VALUES (?, ?, ?, ?)');

            if (isset($_POST['valider'])) {
                // Récupérer les anciennes données
                $recupAnciennesDonnees = $bdd->prepare('SELECT id, budget FROM jeux_videos WHERE id = ?');
                $recupAnciennesDonnees->execute(array($getid));
                $anciennesDonnees = $recupAnciennesDonnees->fetch();

                // Enregistrer les anciennes données dans la table "modification"
                $enregistrerAnciennesDonnees->execute(array(
                    $anciennesDonnees['id'], // Utilisez l'id existant
                    $anciennesDonnees['budget'], // Utilisez le budget existant
                    $_POST['budget'], // Nouveau budget
                    $_POST['commentaire']
                ));

                // Mettre à jour les nouvelles données dans la table "jeux_videos"
                $updateJeuxVideos = $bdd->prepare('UPDATE jeux_videos SET 
                    date_fin = ?, budget = ?, statut_du_jeu = ?, date_mise_a_jour = ?, commentaire = ?
                    WHERE id = ?');
                $updateJeuxVideos->execute(array(
                    nl2br(htmlspecialchars($_POST['date_fin'])),
                    nl2br(htmlspecialchars($_POST['budget'])),
                    nl2br(htmlspecialchars($_POST['statut_du_jeu'])),
                    nl2br(htmlspecialchars($_POST['date_mise_a_jour'])),
                    nl2br(htmlspecialchars($_POST['commentaire'])),
                    $getid
                ));

                // Rediriger vers la page...
                header('Location: ../global/global_jeux.php');
                echo "Modification réussie !";
            }
            
        }else{
            echo " Aucun jeux vidéo trouvé";
        }

    }else{
        echo " Aucun identifiant trouvé";
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
        <p>modifier un jeux vidéo
        </p>
    </section>
    <article class="publier_jeux">
        <form class="publier_jeux_form" action="" method="POST">
            <input type="text" name="titre" value="<?= $titre; ?>" readonly>
            <textarea name="description" readonly >
                <?= $description; ?> 
            </textarea>
            <label class="input_description" for="date_de_creation">Date de création:</label>
            <input type="date" placeholder="date de création" name="date_de_creation" value="<?= $date_de_creation; ?>" readonly >
            <input type="number" placeholder="nombre de joueur" name="nombre_de_joueur" value="<?= $nombre_de_joueur; ?>"readonly >
            <input type="text" placeholder="Gamesoft" name="Studio" readonly>
            <select name="support" disabled ="disabled">
                <option value="" >Support de jeux</option>
                <option value="ordinateur" <?php if ($support === 'ordinateur') echo 'selected'; ?> >Ordinateur</option>
                <option value="console" <?php if ($support === 'console') echo 'selected'; ?>>Console</option>
                <option value="Console/Ordinateur" <?php if ($support === 'Console/Ordinateur') echo 'selected'; ?>>Console/Ordinateur</option>
            </select>
            <select name="moteur_jeux"disabled ="disabled">
                <option value="">Moteur de jeux</option>
                <option value="Unity" <?php if ($moteur_jeux === 'Unity') echo 'selected'; ?>>Unity</option>
                <option value="Unreal" <?php if ($moteur_jeux === 'Unreal') echo 'selected'; ?>>Unreal</option>
                <option value="CryEngine" <?php if ($moteur_jeux === 'CryEngine') echo 'selected'; ?>>CryEngine</option>
            </select>
            <select name="type_de_jeu" disabled ="disabled">
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
            <input type="number" placeholder="budget" name="budget"value="<?= $budget; ?>" >
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
            <input type="text" name="nom_prenom_disabled" placeholder="Mettez votre nom et prenom" value="<?= $nom_prenom; ?>" readonly>
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
=======
<?php
//connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();

    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = htmlentities($_GET['id']);
        // On prepare la bdd pour vérifier si le jeux video est bien cree
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
            // On recupere les infos 
            $titre = htmlspecialchars($jeux_videox_infos['titre'], ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars($jeux_videox_infos['description'], ENT_QUOTES, 'UTF-8');
            $date_de_creation = htmlspecialchars($jeux_videox_infos['date_de_creation'], ENT_QUOTES, 'UTF-8');
            $nombre_de_joueur = htmlspecialchars($jeux_videox_infos['nombre_de_joueur'], ENT_QUOTES, 'UTF-8');
            $Studio = htmlspecialchars($jeux_videox_infos['Studio'], ENT_QUOTES, 'UTF-8');
            $support = htmlspecialchars($jeux_videox_infos['support'], ENT_QUOTES, 'UTF-8');
            $moteur_jeux = htmlspecialchars($jeux_videox_infos['moteur_jeux'], ENT_QUOTES, 'UTF-8');
            $type_de_jeu = htmlspecialchars($jeux_videox_infos['type_de_jeu'], ENT_QUOTES, 'UTF-8');
            $date_fin = htmlspecialchars($jeux_videox_infos['date_fin'], ENT_QUOTES, 'UTF-8');
            $budget = htmlspecialchars($jeux_videox_infos['budget'], ENT_QUOTES, 'UTF-8');
            $statut_du_jeu = htmlspecialchars($jeux_videox_infos['statut_du_jeu'], ENT_QUOTES, 'UTF-8');
            $date_mise_a_jour = htmlspecialchars($jeux_videox_infos['date_mise_a_jour'], ENT_QUOTES, 'UTF-8');
            $commentaire = htmlspecialchars($jeux_videox_infos['commentaire'], ENT_QUOTES, 'UTF-8');
            $nom_prenom = htmlspecialchars($jeux_videox_infos['nom_prenom'], ENT_QUOTES, 'UTF-8');
            //enlever les balise br qui s'affiche automatiquement
            str_replace('<br />', '', $jeux_videox_infos['description']);
            // si on appuye sur le bouton valider on change les informations


            $enregistrerAnciennesDonnees = $bdd->prepare('INSERT INTO modification (id_jeux_videos, ancien_budget, nouveau_budget, commentaire) VALUES (?, ?, ?, ?)');

            if (isset($_POST['valider'])) {
                // Récupérer les anciennes données
                $recupAnciennesDonnees = $bdd->prepare('SELECT id, budget FROM jeux_videos WHERE id = ?');
                $recupAnciennesDonnees->execute(array($getid));
                $anciennesDonnees = $recupAnciennesDonnees->fetch();

                // Enregistrer les anciennes données dans la table "modification"
                $enregistrerAnciennesDonnees->execute(array(
                    $anciennesDonnees['id'], // Utilisez l'id existant
                    $anciennesDonnees['budget'], // Utilisez le budget existant
                    $_POST['budget'], // Nouveau budget
                    $_POST['commentaire']
                ));

                // Mettre à jour les nouvelles données dans la table "jeux_videos"
                $updateJeuxVideos = $bdd->prepare('UPDATE jeux_videos SET 
                    date_fin = ?, budget = ?, statut_du_jeu = ?, date_mise_a_jour = ?, commentaire = ?
                    WHERE id = ?');
                $updateJeuxVideos->execute(array(
                    nl2br(htmlspecialchars($_POST['date_fin'])),
                    nl2br(htmlspecialchars($_POST['budget'])),
                    nl2br(htmlspecialchars($_POST['statut_du_jeu'])),
                    nl2br(htmlspecialchars($_POST['date_mise_a_jour'])),
                    nl2br(htmlspecialchars($_POST['commentaire'])),
                    $getid
                ));

                // Rediriger vers la page...
                header('Location: ../global/global_jeux.php');
                echo "Modification réussie !";
            }
            
        }else{
            echo " Aucun jeux vidéo trouvé";
        }

    }else{
        echo " Aucun identifiant trouvé";
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
        <p>modifier un jeux vidéo
        </p>
    </section>
    <article class="publier_jeux">
        <form class="publier_jeux_form" action="" method="POST">
            <input type="text" name="titre" value="<?= $titre; ?>" readonly>
            <textarea name="description" readonly >
                <?= $description; ?> 
            </textarea>
            <label class="input_description" for="date_de_creation">Date de création:</label>
            <input type="date" placeholder="date de création" name="date_de_creation" value="<?= $date_de_creation; ?>" readonly >
            <input type="number" placeholder="nombre de joueur" name="nombre_de_joueur" value="<?= $nombre_de_joueur; ?>"readonly >
            <input type="text" placeholder="Gamesoft" name="Studio" readonly>
            <select name="support" disabled ="disabled">
                <option value="" >Support de jeux</option>
                <option value="ordinateur" <?php if ($support === 'ordinateur') echo 'selected'; ?> >Ordinateur</option>
                <option value="console" <?php if ($support === 'console') echo 'selected'; ?>>Console</option>
                <option value="Console/Ordinateur" <?php if ($support === 'Console/Ordinateur') echo 'selected'; ?>>Console/Ordinateur</option>
            </select>
            <select name="moteur_jeux"disabled ="disabled">
                <option value="">Moteur de jeux</option>
                <option value="Unity" <?php if ($moteur_jeux === 'Unity') echo 'selected'; ?>>Unity</option>
                <option value="Unreal" <?php if ($moteur_jeux === 'Unreal') echo 'selected'; ?>>Unreal</option>
                <option value="CryEngine" <?php if ($moteur_jeux === 'CryEngine') echo 'selected'; ?>>CryEngine</option>
            </select>
            <select name="type_de_jeu" disabled ="disabled">
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
            <input type="number" placeholder="budget" name="budget"value="<?= $budget; ?>" >
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
            <input type="text" name="nom_prenom_disabled" placeholder="Mettez votre nom et prenom" value="<?= $nom_prenom; ?>" readonly>
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
>>>>>>> a02418468dad454e9d1471734a741ca2dc502094
</html>