<?php
    // Inclusion du fichier de connexion à la base de données
    include_once '../connexion_bdd/connexion_bdd.php';

    // Démarrez la session
    session_start();

    // Vérifiez si l'identifiant du jeu a été fourni via POST
    if (isset($_POST['id_jeu'])) {
        // Convertissez l'identifiant du jeu en un entier pour des raisons de sécurité
        $idJeu = intval($_POST['id_jeu']);
        // Assurez-vous que l'identifiant de l'utilisateur est défini dans la session
        if (isset($_SESSION['id'])) {
            // Récupérez l'identifiant de l'utilisateur à partir de la session
            $utilisateur = $_SESSION['id'];

            // Préparation de la requête pour supprimer le jeu des favoris dans la base de données
            $deleteQuery = $bdd->prepare("DELETE FROM favoris WHERE id_visiteurs = ? AND id_jeux_videos = ?");
            // Exécution de la requête en liant les paramètres
            $deleteQuery->execute([$utilisateur, $idJeu]);

            // Préparation de la requête pour mettre à jour la note du jeu dans la base de données (ajustez selon vos besoins)
            $updateQuery = $bdd->prepare("UPDATE jeux_videos SET favoris_count = favoris_count - 1, note = favoris_count / 5 WHERE id = ?");
            // Exécution de la requête en liant les paramètres
            $updateQuery->execute([$idJeu]);

            // Retourner un message indiquant que le jeu a été retiré des favoris
            echo "removed";
        } else {
            // Si l'identifiant de l'utilisateur n'est pas défini dans la session, retourner un message d'erreur
            echo "Utilisateur non authentifié.";
        }
    } else {
        // Si l'identifiant du jeu n'a pas été fourni via POST, retourner un message d'erreur
        echo "Identifiant du jeu non fourni.";
    }
?>