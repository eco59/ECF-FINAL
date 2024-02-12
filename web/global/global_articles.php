<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
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
    <section class="condition">
        <p>Toutes l'actualités GEEK !
        </p>
    </section>
    <<article class="articles_en_details derniere_section">
            <?php
                // On recupere toutes les infos dans la bdd articles
                $recupArticles = $bdd->prepare('SELECT titre, contenu, auteur, date_mise_a_jour, chemin_image, id FROM articles');
                $recupArticles->execute();

                while($Articles = $recupArticles->fetch()){
                    ?>
                    <!--<div class="articles">-->
                    <h1><?= htmlspecialchars($Articles['titre']);?></h1>
                        <div class="petite_infos">
                            <p><?= htmlspecialchars($Articles['auteur']);?></p>
                            <P><?= htmlspecialchars($Articles['date_mise_a_jour']);?></p>
                        <!-- Affichage de l'image -->
                        <img src="../images/<?= htmlspecialchars($Articles['chemin_image']); ?>" alt="<?= htmlspecialchars($Articles['titre']); ?>">

                        <a href="../details/articles_details.php?id=<?= htmlspecialchars($Articles['id']); ?>" class="en_savoir_plus retour">En savoir plus</a>
                    </div>
                    <br> <!--saut de ligne entre chaque jeux video -->
                    <?php
                }

            ?>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){
            // Fonction pour récupérer les derniers articles depuis le serveur
            function getLatestArticles() {
                $.get("get_latest_article.php", function(data){
                    $(".articles-container").html(data); // Remplace le contenu actuel par les derniers articles
                });
            }

            // Exécute la fonction toutes les 15 secondes (15000 millisecondes)
            setInterval(getLatestArticles, 15000);

            // Submit form using AJAX
            $("form").submit(function(e) {
                e.preventDefault(); // Empêche le comportement par défaut du formulaire

                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "../espace_managers/creation_article.php",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        var result = JSON.parse(response);
                        if(result.status === "success"){
                            // Article created successfully
                            alert("L'article a bien été créé");

                            // Fetch and append the new article to the news feed
                            $.get("get_latest_article.php?articleID=" + result.articleID, function(newArticle){
                                $(".articles-container").prepend(newArticle);
                            });

                            // Clear the form
                            $("form")[0].reset();
                        } else {
                            // Display error message
                            alert(result.message);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
