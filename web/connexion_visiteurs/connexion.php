<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';

    // Démarrage de la session
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
    <section class="description_de_la_page se_connecter">
        <p>Se connecter
        </p>
    </section>
    <section class="connexion">
        <div class="login">
        <form method="POST" action="login.php">
            <input  class="user" type="email" name="email" placeholder="Entrer votre adresse mail"  required>
            <input class="user" type="text" placeholder="Entrer votre pseudo" name="pseudo" required>
            <input class="mdp" type="password" placeholder="Entrer le mot de passe" id="password" name="password" required>
            <input class="button" type="submit" value="Se connecter" name="ok">
        </form>
        </div>
        <div class="inscription">
        <form  method="POST" action="inscription.php">
            <input  class="mail" type="email" id="email" name="email" placeholder="Entrer votre adresse mail"  required>
            <input  class="mail" type="text" id="pseudo" name="pseudo" placeholder="Entrer votre pseudo"  required>
            <input class="mdp_inscription" type="password" id="pass" name="pass" placeholder="Entrer le mot de passe"  required>
            <input class="button" type="submit"value="S'inscrire" name="ok">
        </form>
        </div>
    </section>
    <section class="connexion">
        <div class="reinit">
            <a href="../motdepasse/forgot_password.php"><button class="button_reinit">Mot de passe oublié ?</button></a>
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