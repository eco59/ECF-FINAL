<?php
    session_start();
    // Générer et stocker le jeton CSRF
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
    <section class="description_de_la_page se_connecter">
        <p>Connexion Managers
        </p>
    </section>
    <section class="se_connecter_admin">
        <div class="login_admin">
            <form method="POST" action="login_managers.php">
                <input class="admin" type="email" placeholder="Entrer votre adresse mail" id="email" name="email" required>
                <input class="mdp_admin" type="password" placeholder="Entrer le mot de passe" id="password" name="password" required>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
                <input class="button_admin" type="submit" value="Se connecter" name="ok">
                <?php
                    if(!empty($_POST['csrf_token'])) {
                        if(hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                            // Process form data here
                            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
                            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
                            // use $email and $password in your db queries
                        }
                    }
                ?>
            </form>
        </div>
    </section>
    <section class="connexion">
        <div class="reinit">
            <a href="../motdepasse/motdepasseadminoublie.html"><button class="button_reinit">Mot de passe oublié ?</button></a>
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