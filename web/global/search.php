<?php
    // Connexion à la base de données
    include '../connexion_bdd/connexion_bdd.php';
    session_start();
    // Récupération des paramètres de la requête
    $terme = isset($_GET['terme']) ? '%' . htmlspecialchars(trim(strip_tags($_GET['terme']))) . '%' : '';
    //$type_de_jeu = isset($_GET['type_de_jeu']) ? intval($_GET['type_de_jeu']) : 0;
    $type_de_jeu = isset($_GET['type_de_jeu']) ? htmlspecialchars(trim(strip_tags($_GET['type_de_jeu']))) : '';
    $statut_du_jeu = isset($_GET['statut_du_jeu']) ? htmlspecialchars(trim(strip_tags($_GET['statut_du_jeu']))) : ''; // Modification ici
    $date_fin = isset($_GET['date_fin']) ? $_GET['date_fin'] : '';

    // Préparation de la requête SQL
    $sql = "SELECT * FROM jeux_videos WHERE 1=1";

    // Initialisation d'un tableau pour stocker les paramètres et leurs valeurs
    $params = array();

    // Conditions pour ajouter des clauses WHERE à la requête
    if ($terme !== '' && strlen($terme) >= 3) {
        $sql .= " AND titre LIKE :terme";
        $params[':terme'] = $terme;
    }
    if (!empty($type_de_jeu)) {
        $sql .= " AND type_de_jeu = :type_de_jeu";
        $params[':type_de_jeu'] = $type_de_jeu;
    }
    if (!empty($statut_du_jeu)) {  // Modification ici
        $sql .= " AND statut_du_jeu = :statut_du_jeu";  // Modification ici
        $params[':statut_du_jeu'] = $statut_du_jeu;  // Modification ici
    }
    if (!empty($date_fin)) {
        $sql .= " AND date_fin <= :date_fin";
        $params[':date_fin'] = $date_fin;
    }

    // Ajoutez cette ligne pour limiter les résultats
    $sql .= " LIMIT 0, 25";

    // Préparation et exécution de la requête
    $recupJeuxVideos = $bdd->prepare($sql);
    
    if ($recupJeuxVideos === false) {
        // Erreur de préparation
        print_r($bdd->errorInfo());
    } else {
        // Exécution de la requête
        $resultat = $recupJeuxVideos->execute($params);

        if ($resultat === false) {
            // Erreur d'exécution
            print_r($recupJeuxVideos->errorInfo());
        }
    }
?>

<?php
        if ($recupJeuxVideos->rowCount() > 0) {
            while ($row = $recupJeuxVideos->fetch(PDO::FETCH_ASSOC)) {
                echo "<table>";
                echo "<tr class='premiere_partie'>";
                echo "<td class='titre'><a href='../details/jeux_detail.php?id=" . $row['id'] . "'>" . $row["titre"] . "</a></td>";
                echo "<td class='priorite'>" . $row["note"] .  "/10</td>"; // Ajout de cette ligne pour afficher la note
                echo "</tr>";
                
                echo "<tr class='deuxieme_partie'>";
                // Affichage d'une seule image de la galerie
                $imagePath = $bdd->prepare('SELECT chemin_image FROM images_jeux WHERE id_jeux_videos = ? LIMIT 1');
                $imagePath->execute([$row['id']]);
                $image = $imagePath->fetch(PDO::FETCH_ASSOC);
                
                if ($image) {
                    echo "<td class='galerie-images'><img src='../images/" . $image["chemin_image"] . "' alt='Image'></td>";
                } else {
                    echo "<td class='galerie-images'>Aucune image</td>";
                }
                
                
                // Ajoutez le bouton "Ajouter à mes favoris" avec un attribut data-id pour stocker l'identifiant du jeu
                $buttonText = in_array($row['id'], $_SESSION['favoris']) ? 'Retirer des favoris' : 'Ajouter à mes favoris';
                $buttonClass = in_array($row['id'], $_SESSION['favoris']) ? 'retirer_favori' : 'ajouter_favori';
                echo "<td><button class='$buttonClass favoris_jeux_global' data-id='" . $row['id'] . "'>$buttonText</button></td>";
                echo "</tr>";

                echo "<tr class='troisieme_partie'>";
                echo "<td class='contenu'>" . $row["description"] . "</td>";
                echo "<td class='statut'>". $row["statut_du_jeu"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Aucun résultat trouvé.";
        }
        ?>
        
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
                        $('.jeux_videos').html(response);
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