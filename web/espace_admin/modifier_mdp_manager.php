<?php
// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
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
    <section class="condition">
        <p>Modifier le mot de passe managers
        </p>
    </section>
    <section class="se_connecter_admin">
        <div class="login_admin">
            <form action="" method="POST">
                <input class="admin" type="email" id="email" name="email" placeholder="Entrer votre adresse mail"  required>
                <input  class="mdp_admin" type="password" id="pass" name="pass" placeholder="Entrer le mot de passe"  required>
                <!-- Include CSRF token in form -->
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <input class="button_admin" type="submit"value="modifier" name="ok">
                <?php
                    //connexion bdd
                    include '../connexion_bdd/connexion_bdd.php';
                    session_start();
                    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
                    // Démarrer la session sur chaque page où vous en avez besoin
                        
                        if(isset($_POST['ok'])){
                            $mdp_saisie = htmlspecialchars($_POST['pass']);
                            $email_saisie = htmlspecialchars($_POST['email']);

                            // Hasher le mot de passe
                            $mdp_hash = password_hash($mdp_saisie, PASSWORD_DEFAULT);

                            //modifier dans la base de donnée
                            $changermdp = $bdd->prepare('UPDATE manager SET mdp = ?, email = ? WHERE email = ?');
                            $changermdp->execute(array($mdp_hash, $email_saisie, $email_saisie));
                            if ($changermdp->rowCount() > 0) {
                                echo "<div class='condition'>Modification réussie !</div>";
                            } else {
                                echo "<div class='condition'>Aucune modification effectuée. Vérifiez l'email.</div>";
                            }
                        }
                    }else {
                        die("Invalid CSRF token");
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
