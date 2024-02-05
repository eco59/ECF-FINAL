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
    <section class="description_de_la_page contacter">
        <p>Nous contacter
        </p>
    </section>
    <section class="formulaire_nous_contacter">
        <div class="adresse_mail">
        <form method="POST">
            <input class="mail" type="mail" placeholder="Entrer votre adresse mail" name="mail" required>
            <input class="objet" type="text" placeholder="Ecrivez votre objet" name="objet" required>
            <textarea class="message" placeholder="Ecrivez votre message" name="message" rows="10" cols="30" required></textarea>
            <input class="button_envoyez" type="submit" id="submit" value="Envoyez">
            <?php
            //si le formulaire a été soumis
            if (isset($_POST["message"])){
                $message = "Ce message vous a été evoyé via le site gamestudio.fr
                Email : " .$_POST["email"] . "
                Message : " . $_POST["message"];
                $retour = mail("e.coyen@outlook.fr", $_POST["objet"], $message, "From:contact@gamestudio.fr" ."\r\n" . "Reply-to:" . $_POST["email"]);
                if($retour){
                    echo "L'email a bien été envoyé";
                }
            }
            ?>
        </form>
        </div>
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