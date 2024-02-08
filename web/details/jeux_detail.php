<?php
    include '../connexion_bdd/connexion_bdd.php';
    session_start();

    if(!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] <= 0) {
        header('Location: ../global/global_jeux.php');
        exit();
    }

    $id_jeu = intval($_GET['id']);

    $recupJeuxVideos = $bdd->prepare('SELECT * FROM jeux_videos WHERE id = ?');
    $recupJeuxVideos->bindParam(1, $id_jeu, PDO::PARAM_INT);
    $recupJeuxVideos->execute();

    $jeux_videos = $recupJeuxVideos->fetch();

    if(!$jeux_videos) {
        header('Location: ../global/global_jeux.php');
        exit();
    }

    $recupImages = $bdd->prepare('SELECT * FROM images_jeux WHERE id_jeux_videos = ?');
    $recupImages->bindParam(1, $id_jeu, PDO::PARAM_INT);
    $recupImages->execute();

    $images = $recupImages->fetchAll();

    // Vérifiez si l'utilisateur est connecté avant de récupérer le favori
    if(isset($_SESSION['id'])) {
        $recupFavoris = $bdd->prepare('SELECT * FROM favoris WHERE id_jeux_videos = ? AND id = ?');
        $recupFavoris->bindParam(1, $id_jeu, PDO::PARAM_INT);
        $recupFavoris->bindParam(2, $_SESSION['id'], PDO::PARAM_INT);
        $recupFavoris->execute();

        $isInFavorites = $recupFavoris->fetch();
    } else {
        $isInFavorites = false;
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
        <p>Tous les details du jeux !
        </p>
    </section>
    <articles class="jeux_videos_details derniere_section">
        <div class="div">
            <h1><?= htmlspecialchars($jeux_videos['titre']); ?></h1>
            <p>Type/Genre :  <?= htmlspecialchars($jeux_videos['type_de_jeu']);?></p>
            <p class="note">Note: <?= htmlspecialchars($jeux_videos['note']); ?>/10</p> <!-- Ajout de cette ligne pour afficher la note -->
        </div>
            <p class="contenu"><?= htmlspecialchars_decode(strip_tags($jeux_videos['description'])); ?></p>

        <div class="image-gallery">
            <?php foreach ($images as $image): ?>
                <img src="../images/<?= $image['chemin_image']; ?>">
            <?php endforeach; ?>
        </div>
        <div class="div">
            <p>Support : <?= htmlspecialchars($jeux_videos['support']);?></p>
            <p>Date de création : <?= htmlspecialchars($jeux_videos['date_de_creation']);?></p>
        </div>
        <div class="div">
            <p>Moteur de jeux : <?= htmlspecialchars($jeux_videos['moteur_jeux']);?></p>
            <p>Date de mise a jour : <?= htmlspecialchars($jeux_videos['date_mise_a_jour']);?></p>
        </div>
        <div class="div">
            <p id="favoris-count">Nombre d'utilisateurs qui a mis ce jeu en favori :  <?= htmlspecialchars($jeux_videos['favoris_count']); ?></p>
            
        </div>
        <div class="div">
            <p>Date estimé de fin de création : <?= htmlspecialchars($jeux_videos['date_fin']);?></p>
        </div>
        <div class="div">
            <p>Statut : <?= htmlspecialchars($jeux_videos['statut_du_jeu']);?></p>
            <p>Nombre de joueur : <?= htmlspecialchars($jeux_videos['nombre_de_joueur']);?></p>
            <p>Studio : <?= htmlspecialchars($jeux_videos['Studio']);?></p>
        </div>
        <div class="div_favoris">
            <button class="<?= $isInFavorites ? 'retirer_favori' : 'ajouter_favori'; ?>" data-id="<?= $id_jeu; ?>">
                <?= $isInFavorites ? 'Retirer des favoris' : 'Ajouter à mes favoris'; ?>
            </button>
        </div>
        <div class="div_retour">
            <a href="../global/global_jeux.php">
                <button class="retour" >Retour à la liste des jeux</button>
            </a>
        </div>
    </articles>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.ajouter_favori, .retirer_favori').click(function () {
                var idJeu = $(this).data('id');
                var button = $(this);

                // Utilisez AJAX pour envoyer l'identifiant du jeu à un script PHP qui gérera l'ajout/retait des favoris
                $.ajax({
                    type: 'POST',
                    url: '../global/ajouter_favori.php',
                    data: { id_jeu: idJeu },
                    dataType: 'json', // Spécifiez le type de données à attendre en réponse
                    success: function (response) {
                        // Traitez la réponse si nécessaire
                        console.log(response);

                        // Mettre à jour le compteur de favoris
                        $('#favoris-count').text('Favoris : ' + response.newFavorisCount);

                        // Changez le texte du bouton en fonction de la réponse du serveur
                        if (response.status === "added") {
                            button.text('Retirer des favoris').removeClass('ajouter_favori').addClass('retirer_favori');
                        } else if (response.status === "removed") {
                            button.text('Ajouter à mes favoris').removeClass('retirer_favori').addClass('ajouter_favori');
                        }

                        // Mettez à jour dynamiquement la note affichée
                        var noteElement = $('.note'); // Assurez-vous d'ajuster le sélecteur en fonction de votre structure HTML
                        noteElement.text('Note: ' + response.newNote + '/10');
                    }
                });
            });
        });
    </script>
</body>
</html>