<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
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
        <p>Modifier le mot de passe
        </p>
    </section>
    <article class="article_oublie_mdp">
        <form method="POST" action="">
                <input class="email_mdp_oublie"type="email" placeholder="Entrer Email" name="email" required>
                <button class="button_oublie" type="submit" name="envoi">Retrouver mon mot de passe</button>
            
        </form>
    </article>
    <?php
    // Fonction pour valider une adresse e-mail
    function valider_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Fonction pour échapper les données
    function echapper_donnees($donnees) {
        return htmlspecialchars(trim($donnees), ENT_QUOTES, 'UTF-8');
    }

    // Vérifie si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["envoi"])) {
        // Vérifie si l'e-mail est défini et non vide
        if (isset($_POST["email"]) && !empty($_POST["email"])) {
            // Échapper les données du formulaire
            $destinataire = echapper_donnees($_POST["email"]);

            // Valider l'adresse e-mail
            if (!valider_email($destinataire)) {
                echo "Veuillez entrer une adresse e-mail valide.";
                exit;
            }

            // Adresse e-mail du destinataire externe
            $destinataire =  $_POST["email"]; // Remplacez par votre adresse e-mail externe

            // Sujet de l'e-mail
            $sujet = "Sujet de l'e-mail";

            // Corps de l'e-mail
            $message = "Bonjour, pour réinitialiser votre mot de passe, merci de cliquer sur le lien suivant : https://www.gamesoft.go.yj.fr/web/motdepasse/reinitialiser_mdp.php ; Bonne journée !";

            // En-têtes de l'e-mail
            $headers = "From: contact@gamesoft.go.yj.fr\r\n";
            $headers .= "Reply-To: contact@gamesoft.go.yj.fr\r\n";
            $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

            // Envoi de l'e-mail
            $envoi = mail($destinataire, $sujet, $message, $headers);

            // Vérification si l'e-mail a été envoyé avec succès
            if ($envoi) {
                echo '<div class="condition">L\'e-mail a été envoyé avec succès.</div>';
            } else {
                echo '<div class="condition">Une erreur s\'est produite lors de l\'envoi de l\'e-mail.</div>';
            }
        } else {
            echo '<div class="condition">Veuillez entrer une adresse e-mail valide.</div>';
        }
    }
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
