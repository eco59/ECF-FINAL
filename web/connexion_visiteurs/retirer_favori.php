<?php
    //connexion bdd
    include_once '../connexion_bdd/connexion_bdd.php';

    // Démarrez la session
    session_start();

    if (isset($_POST['id_jeu'])) {
        $idJeu = intval($_POST['id_jeu']);
        $utilisateur = $_SESSION['id'];

        // Retirez le jeu des favoris dans la base de données
        $deleteQuery = $bdd->prepare("DELETE FROM favoris WHERE id_visiteurs = ? AND id_jeux_videos = ?");
        $deleteQuery->execute([$utilisateur, $idJeu]);

        // Mettez à jour la note du jeu dans la base de données (ajustez selon vos besoins)
        $updateQuery = $bdd->prepare("UPDATE jeux_videos SET favoris_count = favoris_count - 1, note = favoris_count / 5 WHERE id = ?");
        $updateQuery->execute([$idJeu]);

        echo "removed";
    } else {
        echo "Identifiant du jeu non fourni.";
    }
?>