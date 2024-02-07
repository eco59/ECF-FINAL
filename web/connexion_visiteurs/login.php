<?php
    // Inclusion du fichier de connexion à la base de données
    include '../connexion_bdd/connexion_bdd.php';

    // Vérification de la méthode de requête
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données postées
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];

        // Vérification de la politique de mot de passe (12 caractères minimum, une majuscule, une minuscule, un caractère spécial)
        if (strlen($password) < 12 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            // Redirection en cas de mot de passe invalide
            header("Location: ../connexion_visiteurs/mauvaismotdepasse.html");
            exit(); // Assurez-vous d'ajouter exit après la redirection
        } else {
            // Utilisation de requêtes préparées pour éviter les injections SQL
            $requete = $bdd->prepare("SELECT id, mdp, email, pseudo FROM visiteurs WHERE pseudo = :pseudo OR email = :email");
            $requete->execute(array("pseudo" => $pseudo, "email" => $email));
            $utilisateur = $requete->fetch();

            // Vérification du mot de passe
            if ($utilisateur && password_verify($password, $utilisateur['mdp'])) {
                // Authentification réussie
                session_start();
            
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['pseudo'] = $utilisateur['pseudo'];
                $_SESSION['id'] = $utilisateur['id'];
            
                // Redirection vers le tableau de bord
                header("Location: ../connexion_visiteurs/dashboard_visiteurs.php");
                exit(); // Assurez-vous d'ajouter exit après la redirection
            } else {
                // Redirection en cas d'informations d'identification incorrectes
                header("Location: ../connexion_visiteurs/incorrect.html");
                exit(); // Assurez-vous d'ajouter exit après la redirection
            }
        }
    }
?>