<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérifier la politique de mot de passe (12 caractères minimum, une majuscule, une minuscule, un caractère spécial)
        if (strlen($password) < 12 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            header("Location: ../connexion_visiteurs/mauvaismotdepasse.html");
            exit(); // Assurez-vous d'ajouter exit après la redirection
        } else {
            // Utilisation de requêtes préparées pour éviter les injections SQL
            $requete = $bdd->prepare("SELECT id, mdp, email, pseudo FROM visiteurs WHERE pseudo = :pseudo OR email = :email");
            $requete->execute(array("pseudo" => $pseudo, "email" => $email));
            $utilisateur = $requete->fetch();

            if ($utilisateur && password_verify($password, $utilisateur['mdp'])) {
                // Authentification réussie
                session_start();
            
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['id'] = $utilisateur['id'];
            
                // Redirection
                header("Location: ../connexion_visiteurs/dashboard_visiteurs.php");
                exit(); // Assurez-vous d'ajouter exit après la redirection
            } else {
                header("Location: ../connexion_visiteurs/incorrect.html");
                exit(); // Assurez-vous d'ajouter exit après la redirection
            }
        }
    }
?>