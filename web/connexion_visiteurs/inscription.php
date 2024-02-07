<?php
    // Inclusion du fichier de connexion à la base de données
    include '../connexion_bdd/connexion_bdd.php';
    
    if (isset($_POST['ok'])) {
        // Récupération des données postées
        $mdp = $_POST['pass'];
        $email = $_POST['email'];
        $pseudo = $_POST['pseudo'];

        // Vérifier la politique de mot de passe (12 caractères minimum, une majuscule, une minuscule, un caractère spécial)
        if (strlen($mdp) < 12 || !preg_match('/[A-Z]/', $mdp) || !preg_match('/[a-z]/', $mdp) || !preg_match('/[^A-Za-z0-9]/', $mdp)) {
            // Redirection en cas de mot de passe invalide
            header('Location: ../connexion_visiteurs/mauvaismotdepasse.html');
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            // Hasher le mot de passe
            $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

            // Préparation de la requête SQL pour l'insertion dans la base de données
            $requete = $bdd->prepare("INSERT INTO visiteurs (mdp, email, pseudo) VALUES (:mdp, :email, :pseudo)");

            // Exécuter la requête en liant les paramètres
            $requete->execute(
                array(
                    "mdp" => $hashedPassword,
                    "email" => $email,
                    "pseudo" => $pseudo
                )
            );

            // Vérifier si l'insertion a réussi
            if ($requete->rowCount() > 0) {
                // Redirection en cas de succès de l'inscription
                header('Location: ../connexion_visiteurs/inscriptionreussi.html');
                exit(); // Assurez-vous de terminer le script après la redirection
            } else {
                // Redirection en cas d'échec de l'inscription
                header('Location: ../connexion_visiteurs/inscriptionrate.html');
                exit(); // Assurez-vous de terminer le script après la redirection
            }
        }
    }
?>