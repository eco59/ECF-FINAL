<?php
    session_start();
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
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
        <p>Création de compte producteurs
        </p>
    </section>
    <section class="se_connecter_admin">
        <div class="login_admin">
        <form action="" method="POST">
                <input class="admin" type="email" id="email" name="email" placeholder="Entrer votre adresse mail"  required>
                <input class="mdp_admin" type="password" id="pass" name="pass" placeholder="Entrer le mot de passe"  required>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
                <input class="button_admin" type="submit"value="CREER" name="ok">
                <?php
                    //connexion bdd
                    include '../connexion_bdd/connexion_bdd.php';
                    if (!empty($_POST['csrf_token'])) {
                        if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                            if (isset($_POST['ok'])) {
                                $mdp = $_POST['pass'];
                                $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
                                
        
                            // Vérifier la politique de mot de passe (12 caractères minimum, une majuscule, une minuscule, un caractère spécial)
                            if (strlen($mdp) < 12 || !preg_match('/[A-Z]/', $mdp) || !preg_match('/[a-z]/', $mdp) || !preg_match('/[^A-Za-z0-9]/', $mdp)) {
                                echo "Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule et un caractère spécial.";
                            } else {
                                // Hasher le mot de passe
                                $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
                    
                                // Insérer dans la base de données en utilisant une requête préparée
                            $requete = $bdd->prepare("INSERT INTO producteurs VALUES (0, :mdp, :email, '')");
                            // Exécuter la requête en liant les paramètres
                            $requete->execute(
                                array(
                                    "mdp" => $hashedPassword,
                                    "email" => $email
                                )
                            );

                            // Vérifier si l'insertion a réussi
                            if ($requete->rowCount() > 0) {
                                header('Location: ../connexion_visiteurs/inscriptionreussi.html');
                            } else {
                                header('Location: ../connexion_visiteurs/inscriptionrate.html');
                            }
                        }
                    }
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
</body>
</html>