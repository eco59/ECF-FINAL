<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';

    if(isset($_POST['ok'])){
        $mdp_saisie = htmlspecialchars($_POST['pass']); // Sécurisation du mot de passe saisi
        $pseudo = htmlspecialchars($_POST['pseudo']); // Sécurisation du pseudo saisi
        $email_saisie = htmlspecialchars($_POST['email']); // Sécurisation de l'e-mail saisi
        
        //modification dans la base de données
        $changermdp = $bdd->prepare('UPDATE visiteurs SET mdp = ? WHERE email = ?, pseudo = ?'); // Modification de la requête pour mettre à jour le mot de passe d'un utilisateur spécifique
        $changermdp->execute(array($mdp_saisie, $email_saisie, $pseudo));
        
        if ($changermdp) {
            header("Location: ../connexion_visiteurs/connexion.php");
        } else {
            echo "Erreur lors de la modification";
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
        <form action="" method="POST">
            <input class="email_mdp_oublie" type="email" id="email" name="email" placeholder="Entrer votre adresse mail"  required>
            <input class="email_mdp_oublie mdp_new" type="text" placeholder="Entrer votre pseudo" name="pseudo" required>
            <input class="email_mdp_oublie mdp_new" type="password" id="pass" name="pass" placeholder="Nouveau mot de passe"  required>
            <input class="button_oublie" type="submit"value="Modifier" name="ok">
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