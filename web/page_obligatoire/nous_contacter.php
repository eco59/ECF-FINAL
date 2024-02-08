<?php
    // connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    
    // Démarrage de la session
    session_start();
    
    // Fonction d'échappement pour les chaînes
    function escape_string($string) {
        return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifiez si les champs sont vides
        if (empty($_POST["email"]) || empty($_POST["objet"]) || empty($_POST["message"])) {
            echo "Tous les champs doivent être remplis.";
            exit;
        }
    
        // Récupérez et échappez les données du formulaire
        $email = escape_string($_POST["email"]);
        $objet = escape_string($_POST["objet"]);
        $message = "Ce message vous a été envoyé via le site gamestudio.go.yj.fr\n\nEmail : " . $email . "\nMessage : " . escape_string($_POST["message"]);
    
        // En-têtes du mail avec encodage UTF-8
        $headers = "From: contact@gamesoft.go.yj.fr" . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit" . "\r\n";
    
        // Envoyer l'email
        $retour = mail("contact@gamesoft.go.yj.fr", $objet, $message, $headers);
    
        // Vérifier si l'email a été envoyé avec succès
        if ($retour) {
            echo "L'email a bien été envoyé";
        } else {
            echo "Une erreur s'est produite lors de l'envoi de l'email. Veuillez réessayer plus tard.";
        }
        exit;
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
    <section class="formulaire_nous_contacter derniere_section">
        <div class="adresse_mail">
            <form method="POST" onsubmit="return validateForm()" action="">
                <input class="mail" type="email" placeholder="Entrer votre adresse mail" name="email" required>
                <input class="objet" type="text" placeholder="Ecrivez votre objet" name="objet" required>
                <textarea class="message" placeholder="Ecrivez votre message" name="message" rows="10" cols="30" required></textarea>
                <div id="error_message"></div>
                <input class="button_envoyez" type="submit" id="submit" value="Envoyez">
                
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
    <script>
        function validateForm() {
            var email = document.forms["contactForm"]["email"].value;
            var objet = document.forms["contactForm"]["objet"].value;
            var message = document.forms["contactForm"]["message"].value;

            if (email == "" || objet == "" || message == "") {
                document.getElementById("error_message").innerHTML = "Tous les champs doivent être remplis";
                return false;
            }

            return true;
        }
    </script>
</body>
</html>