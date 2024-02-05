<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    
    if (isset($_POST['ok'])) {
        $mdp = $_POST['pass'];
        $email = $_POST['email'];
        $pseudo = $_POST['pseudo'];

        // Vérifier la politique de mot de passe (12 caractères minimum, une majuscule, une minuscule, un caractère spécial)
        if (strlen($mdp) < 12 || !preg_match('/[A-Z]/', $mdp) || !preg_match('/[a-z]/', $mdp) || !preg_match('/[^A-Za-z0-9]/', $mdp)) {
            header('Location: ../connexion_visiteurs/mauvaismotdepasse.html');
        } else {
            // Hasher le mot de passe
            $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

            // Insérer dans la base de données en utilisant une requête préparée
            $requete = $bdd->prepare("INSERT INTO visiteurs VALUES (0, :mdp, :email, :pseudo, '')");

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
                header('Location: ../connexion_visiteurs/inscriptionreussi.html');
            } else {
                header('Location: ../connexion_visiteurs/inscriptionrate.html');
            }
        }
    }
?>