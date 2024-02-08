<?php
    // Connexion à la base de données
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    // Vérifiez si la clé 'favoris' existe dans $_SESSION
    if (!isset($_SESSION['favoris'])) {
        // Si elle n'existe pas, initialisez-la comme un tableau vide
        $_SESSION['favoris'] = array();
    }
    
    // Récupération des paramètres de la requête
    $terme = isset($_GET['terme']) ? '%' . htmlspecialchars(trim(strip_tags($_GET['terme']))) . '%' : '';
    $type_de_jeu = isset($_GET['type_de_jeu']) ? intval($_GET['type_de_jeu']) : 0;
    $statut_du_jeu = isset($_GET['statut_du_jeu']) ? intval($_GET['statut_du_jeu']) : 0;
    $date_fin = isset($_GET['date_fin']) ? $_GET['date_fin'] : '';

    // Construction de la requête SQL
    $sql = "SELECT * FROM jeux_videos WHERE 1=1";

    // Initialisation d'un tableau pour stocker les paramètres et leurs valeurs
    $params = array();

    // Conditions pour ajouter des clauses WHERE à la requête
    if ($terme !== '') {
        $sql .= " AND titre LIKE :terme";
        $params[':terme'] = $terme;
    }
    if ($type_de_jeu != 0) {
        $sql .= " AND type_de_jeu = :type_de_jeu";
        $params[':type_de_jeu'] = $type_de_jeu;
    }
    
    if ($statut_du_jeu != 0) {
        $sql .= " AND statut_du_jeu = :statut_du_jeu";
        $params[':statut_du_jeu'] = $statut_du_jeu;
    }
    if (!empty($date_fin)) {
        $sql .= " AND date_fin <= :date_fin";
        $params[':date_fin'] = $date_fin;
    }
    
    // Préparation et exécution de la requête
    $recupJeuxVideos = $bdd->prepare($sql);
    $recupJeuxVideos->execute($params);
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
    <section class="search_jeux">
        <form class="publier_jeux_form" action="" method="GET">
            <input type="search" placeholder="Taper votre recherche..." name="terme">
            <select id="type_de_jeu" name="type_de_jeu">
                <option value="">Tous les genres</option>
                <option value="Action">Action</option>
                <option value="RPG">RPG</option>
                <option value="FPS">FPS</option>
                <option value="MMO">MMO</option>
                <option value="Aventure">Aventure</option>
                <option value="Sport">Sport</option>
                <option value="Combat">Combat</option>
                <option value="Stratégie">Stratégie</option>
                <!-- Ajoutez d'autres options de genre selon votre base de données -->
            </select>
            <select id="statut_du_jeu" name="statut_du_jeu">
                <option value="">Tous les statuts</option>
                <option value="En cours">En cours</option>
                <option value="Fini">Fini</option>
                <!-- Ajoutez d'autres options de statut selon votre base de données -->
            </select>
            <input type="date" id="date_fin" name="date_fin">
        </form>
    </section>
    <article class="jeux_global derniere_section">
        <?php
        if ($recupJeuxVideos->rowCount() > 0) {
            while ($row = $recupJeuxVideos->fetch(PDO::FETCH_ASSOC)) {
                echo "<table>";
                echo "<tr class='premiere_partie'>";
                echo "<td class='titre'><a href='../details/jeux_detail.php?id=" . $row['id'] . "'>" . htmlspecialchars($row["titre"]) . "</a></td>";
                echo "<td class='priorite'>" . htmlspecialchars($row["note"]) .  "/10</td>"; // Ajout de cette ligne pour afficher la note
                echo "</tr>";
                
                echo "<tr class='deuxieme_partie'>";
                // Affichage d'une seule image de la galerie
                $imagePath = $bdd->prepare('SELECT chemin_image FROM images_jeux WHERE id_jeux_videos = ? LIMIT 1');
                $imagePath->execute([$row['id']]);
                $image = $imagePath->fetch(PDO::FETCH_ASSOC);
                
                if ($image) {
                    echo "<td class='galerie-images'><img src='../images/" . htmlspecialchars($image["chemin_image"]) . "' alt='Image'></td>";
                } else {
                    echo "<td class='galerie-images'>Aucune image</td>";
                }
                
                // Ajoutez le bouton "Ajouter à mes favoris" avec un attribut data-id pour stocker l'identifiant du jeu
                $buttonText = in_array($row['id'], $_SESSION['favoris']) ? 'Retirer des favoris' : 'Ajouter à mes favoris';
                $buttonClass = in_array($row['id'], $_SESSION['favoris']) ? 'retirer_favori' : 'ajouter_favori';
                echo "<td><button class='$buttonClass favoris_jeux_global' data-id='" . htmlspecialchars($row['id']) . "'>$buttonText</button></td>";
                echo "</tr>";

                echo "<tr class='troisieme_partie'>";
                echo "<td class='contenu'>" . htmlspecialchars_decode(strip_tags($row["description"])) . "</td>";
                echo "<td class='statut'>". htmlspecialchars($row["statut_du_jeu"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Aucun résultat trouvé.";
        }
        ?>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            function submitForm() {
                var formData = $('form').serialize();
                $.ajax({
                    type: 'GET',
                    url: 'search.php',
                    data: formData, // Cela envoie déjà les données du formulaire
                    success: function (response) {
                        $('.jeux_global').html(response);
                    }
                });
            }
            // Soumettre le formulaire lors de la saisie dans la barre de recherche
            $('input[name="terme"]').on('input', function () {
                submitForm();
            });

            // Soumettre le formulaire lors de la modification des filtres
            $('#type_de_jeu, #statut_du_jeu, #date_fin').change(function () {
                submitForm();
            });

            // Soumettre le formulaire lors de la soumission du formulaire principal
            $('form').submit(function (e) {
                e.preventDefault();
                submitForm();
            });
            // Ajoutez un gestionnaire d'événements pour le clic sur le bouton "Ajouter/Retirer des favoris"
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

                        // Changez le texte du bouton en fonction de la réponse du serveur
                        if (response.status === "added") {
                            button.text('Retirer des favoris').removeClass('ajouter_favori').addClass('retirer_favori');
                        } else if (response.status === "removed") {
                            button.text('Ajouter à mes favoris').removeClass('retirer_favori').addClass('ajouter_favori');
                        }

                        // Mettez à jour dynamiquement la note affichée
                        var noteElement = button.closest('tr').find('.note'); // Assurez-vous d'ajuster le sélecteur en fonction de votre structure HTML
                        noteElement.text('Note: ' + response.newNote + '/10');
                    }
                });
            });
        });
    </script>
</body>
</html>