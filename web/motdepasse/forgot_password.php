<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["email"])) {
            $email = $_POST["email"];
    
            // Vérifier si l'e-mail existe dans la base de données
            $stmt = $pdo->prepare("SELECT * FROM visiteurs WHERE email = :email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $visiteurs = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($visiteurs) {
                // Générer un token unique pour la réinitialisation du mot de passe
                $token = bin2hex(random_bytes(32));
    
                // Mettre à jour la base de données avec le token
                $stmt = $pdo->prepare("UPDATE visiteurs SET reset_token = :token WHERE email = :email");
                $stmt->bindParam(":token", $token, PDO::PARAM_STR);
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                $stmt->execute();
    
                // Envoyer un e-mail avec le lien de réinitialisation
                $reset_link = "http://gamestudio.com/reinitialiser_mdp.php?token=$token";
                $message = "Bonjour,\n\nPour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant : $reset_link";
                mail($email, "Réinitialisation de mot de passe", $message);
    
                echo "Un e-mail a été envoyé avec les instructions de réinitialisation du mot de passe.";
            } else {
                echo "Aucun compte associé à cet e-mail.";
            }
        }
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
        <p>Modifier le mot de passe
        </p>
    </section>
    <article class="article_oublie_mdp">
        <form method="POST" action="">
                <input class="email_mdp_oublie"type="email" placeholder="Entrer Email" name="email" required>
                <button class="button_oublie" type="submit" name="envoi">Retrouver mon mot de passe</button>
            
        </form>
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
</body>

</html>