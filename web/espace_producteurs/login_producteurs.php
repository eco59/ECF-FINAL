<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier le jeton CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier la complexité du mot de passe (12 caractères minimum, une majuscule, une minuscule, un caractère spécial)
        if (strlen($password) < 12 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            echo "Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule et un caractère spécial.";
        } else {

        // Utilisation de requêtes préparées pour éviter les injections SQL
        $requete = $bdd->prepare("SELECT id, mdp FROM producteurs WHERE email = :email");
        $requete->execute(array("email" => $email));
        $utilisateur = $requete->fetch();

        if ($utilisateur && password_verify($password, $utilisateur['mdp'])) {
            // Authentification réussie

            // Générer un nouveau jeton
            $token = bin2hex(random_bytes(32));

            // Mettre à jour le jeton dans la base de données
            $requeteUpdateToken = $bdd->prepare("UPDATE producteurs SET token = :token WHERE email = :email");
            $requeteUpdateToken->execute(array("token" => $token, "email" => $email));

            // Stocker le jeton dans un cookie
            setcookie("email", $email, time() + 3600);
            setcookie("token", $token, time() + 3600);

            // Rediriger vers la page du manager
            header("Location: ../espace_producteurs/dashboard_product.php");
            exit();
        } else {
            echo "Email ou mot de passe incorrect !";
        }
    }
}
?>