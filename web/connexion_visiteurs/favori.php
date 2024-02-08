<<<<<<< HEAD
<?php
    // Inclusion du fichier de connexion à la base de données
    include '../connexion_bdd/connexion_bdd.php';
    
    // Démarrage de la session sur chaque page où vous en avez besoin
    session_start();

    // Assurez-vous que la variable de session contenant l'identifiant de l'utilisateur est définie
    if (!isset($_SESSION['id'])) {
        // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
        header("Location: ../connexion_visiteurs/connexion.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    }

    // Récupérer l'identifiant de l'utilisateur à partir de la session
    $utilisateur = $_SESSION['id'];

    // Préparation de la requête SQL pour récupérer les jeux favoris de l'utilisateur
    $sql = "SELECT id_jeux_videos FROM favoris WHERE id_visiteurs = :utilisateur";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':utilisateur', $utilisateur, PDO::PARAM_INT);

    // Exécution de la requête préparée
    if ($stmt->execute()) {
        // Récupération des résultats
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($result === false) {
            // Gestion des erreurs pour le cas où fetchAll échoue
            echo 'Erreur lors de la récupération des jeux favoris.';
        }
    } else {
        // Gestion des erreurs pour le cas où l'exécution de la requête échoue
        echo 'Erreur lors de l\'exécution de la requête.';
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
    <section class="description_de_la_page_membre">
        <p>Mes Favoris
        </p>
    </section>
    <section class="ul_favori derniere_section">
    <?php
        if (isset($result)) {
            if (count($result) > 0) {
                echo "<ul>";
                foreach ($result as $row) {
                    $idJeu = $row['id_jeux_videos'];

                    // Préparation de la requête SQL pour récupérer le titre du jeu
                    $recupTitreJeu = $bdd->prepare('SELECT titre FROM jeux_videos WHERE id = :idJeu');
                    $recupTitreJeu->bindParam(':idJeu', $idJeu, PDO::PARAM_INT);
                    
                    // Exécution de la requête préparée
                    if ($recupTitreJeu->execute() && $titreJeu = $recupTitreJeu->fetchColumn()) {
                        // Affichage du jeu et du bouton pour retirer des favoris
                        echo "<li class='li_favori'>";
                        echo "<a href='../details/jeux_detail.php?id=$idJeu'>" . htmlspecialchars($titreJeu) . "</a>";
                        echo "<button class='retirer_favori button_deconnexion' data-id='$idJeu'>Retirer des favoris</button>";
                        echo "</li>";
                    }
                }
                echo "</ul>";
            } else {
                echo "<p>Aucun jeu favori trouvé.</p>";
            }
        }
        ?>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // ... (votre code existant)

            // Ajoutez un gestionnaire d'événements pour le clic sur le bouton "Retirer des favoris"
            $('.retirer_favori').click(function () {
                var idJeu = $(this).data('id');
                var button = $(this);

                // Utilisez AJAX pour envoyer l'identifiant du jeu à un script PHP qui gérera le retrait des favoris
                $.ajax({
                    type: 'POST',
                    url: 'retirer_favori.php',
                    data: { id_jeu: idJeu },
                    success: function (response) {
                        // Traitez la réponse si nécessaire
                        console.log(response);

                        // Supprimez l'élément de la liste si le retrait a réussi
                        if (response === "removed") {
                            button.closest('li').remove();
                        }
                    }
                });
            });
        });
    </script>
</body>
=======
<?php
    // Inclusion du fichier de connexion à la base de données
    include '../connexion_bdd/connexion_bdd.php';
    
    // Démarrage de la session sur chaque page où vous en avez besoin
    session_start();

    // Assurez-vous que la variable de session contenant l'identifiant de l'utilisateur est définie
    if (!isset($_SESSION['id'])) {
        // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
        header("Location: ../connexion_visiteurs/connexion.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    }

    // Récupérer l'identifiant de l'utilisateur à partir de la session
    $utilisateur = $_SESSION['id'];

    // Préparation de la requête SQL pour récupérer les jeux favoris de l'utilisateur
    $sql = "SELECT id_jeux_videos FROM favoris WHERE id_visiteurs = :utilisateur";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':utilisateur', $utilisateur, PDO::PARAM_INT);

    // Exécution de la requête préparée
    if ($stmt->execute()) {
        // Récupération des résultats
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($result === false) {
            // Gestion des erreurs pour le cas où fetchAll échoue
            echo 'Erreur lors de la récupération des jeux favoris.';
        }
    } else {
        // Gestion des erreurs pour le cas où l'exécution de la requête échoue
        echo 'Erreur lors de l\'exécution de la requête.';
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
    <section class="description_de_la_page_membre">
        <p>Mes Favoris
        </p>
    </section>
    <section class="ul_favori derniere_section">
    <?php
        if (isset($result)) {
            if (count($result) > 0) {
                echo "<ul>";
                foreach ($result as $row) {
                    $idJeu = $row['id_jeux_videos'];

                    // Préparation de la requête SQL pour récupérer le titre du jeu
                    $recupTitreJeu = $bdd->prepare('SELECT titre FROM jeux_videos WHERE id = :idJeu');
                    $recupTitreJeu->bindParam(':idJeu', $idJeu, PDO::PARAM_INT);
                    
                    // Exécution de la requête préparée
                    if ($recupTitreJeu->execute() && $titreJeu = $recupTitreJeu->fetchColumn()) {
                        // Affichage du jeu et du bouton pour retirer des favoris
                        echo "<li class='li_favori'>";
                        echo "<a href='../details/jeux_detail.php?id=$idJeu'>" . htmlspecialchars($titreJeu) . "</a>";
                        echo "<button class='retirer_favori button_deconnexion' data-id='$idJeu'>Retirer des favoris</button>";
                        echo "</li>";
                    }
                }
                echo "</ul>";
            } else {
                echo "<p>Aucun jeu favori trouvé.</p>";
            }
        }
        ?>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // ... (votre code existant)

            // Ajoutez un gestionnaire d'événements pour le clic sur le bouton "Retirer des favoris"
            $('.retirer_favori').click(function () {
                var idJeu = $(this).data('id');
                var button = $(this);

                // Utilisez AJAX pour envoyer l'identifiant du jeu à un script PHP qui gérera le retrait des favoris
                $.ajax({
                    type: 'POST',
                    url: 'retirer_favori.php',
                    data: { id_jeu: idJeu },
                    success: function (response) {
                        // Traitez la réponse si nécessaire
                        console.log(response);

                        // Supprimez l'élément de la liste si le retrait a réussi
                        if (response === "removed") {
                            button.closest('li').remove();
                        }
                    }
                });
            });
        });
    </script>
</body>
>>>>>>> a02418468dad454e9d1471734a741ca2dc502094
</html>