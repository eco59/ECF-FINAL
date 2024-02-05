<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email != "" && $password != "") {

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