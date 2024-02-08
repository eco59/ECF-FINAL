<<<<<<< HEAD
<?php
    // Connexion à la base de données
    include '../connexion_bdd/connexion_bdd.php';
    session_start();

    // Vérification de l'authenticité de l'utilisateur
    if(isset($_SESSION['id']) && isset($_POST['id_jeu'])) {
        $idJeu = intval($_POST['id_jeu']);
        $utilisateur = $_SESSION['id'];

        // Vérifiez si le jeu n'est pas déjà dans les favoris
        if (!in_array($idJeu, $_SESSION['favoris'])) {
            // Ajoutez le jeu aux favoris
            $_SESSION['favoris'][] = $idJeu;

            // Mettez à jour la base de données (ajout d'un favori)
            $updateQuery = $bdd->prepare("INSERT INTO favoris (id_visiteurs, id_jeux_videos) VALUES (?, ?)");
            $updateQuery->execute([$utilisateur, $idJeu]);

            // Mettez à jour la note du jeu dans la base de données
            $updateQuery = $bdd->prepare("UPDATE jeux_videos SET favoris_count = COALESCE(favoris_count, 0) + 1, note = COALESCE(favoris_count, 0) / 5 WHERE id = ?");
            $updateQuery->execute([$idJeu]);

            // Récupérez la nouvelle note
            $newNoteQuery = $bdd->prepare("SELECT note FROM jeux_videos WHERE id = ?");
            $newNoteQuery->execute([$idJeu]);
            $newNote = $newNoteQuery->fetchColumn();

            // Récupérez le nouveau nombre de favoris
            $newFavorisCountQuery = $bdd->prepare("SELECT favoris_count FROM jeux_videos WHERE id = ?");
            $newFavorisCountQuery->execute([$idJeu]);
            $newFavorisCount = $newFavorisCountQuery->fetchColumn();

            echo json_encode(['status' => 'added', 'newNote' => $newNote, 'newFavorisCount' => $newFavorisCount]);
        } else {
            // Retirez le jeu des favoris
            $_SESSION['favoris'] = array_diff($_SESSION['favoris'], array($idJeu));

            // Mettez à jour la base de données (retrait d'un favori)
            $updateQuery = $bdd->prepare("DELETE FROM favoris WHERE id_visiteurs = ? AND id_jeux_videos = ?");
            $updateQuery->execute([$utilisateur, $idJeu]);

            // Mettez à jour la note du jeu dans la base de données
            $updateQuery = $bdd->prepare("UPDATE jeux_videos SET favoris_count = COALESCE(favoris_count, 0) - 1, note = COALESCE(favoris_count, 0) / 5 WHERE id = ?");
            $updateQuery->execute([$idJeu]);

            // Récupérez la nouvelle note
            $newNoteQuery = $bdd->prepare("SELECT note FROM jeux_videos WHERE id = ?");
            $newNoteQuery->execute([$idJeu]);
            $newNote = $newNoteQuery->fetchColumn();
            
            // Récupérez le nouveau nombre de favoris
            $newFavorisCountQuery = $bdd->prepare("SELECT favoris_count FROM jeux_videos WHERE id = ?");
            $newFavorisCountQuery->execute([$idJeu]);
            $newFavorisCount = $newFavorisCountQuery->fetchColumn();

            echo json_encode(['status' => 'removed', 'newNote' => $newNote, 'newFavorisCount' => $newFavorisCount]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Identifiant du jeu non fourni ou utilisateur non authentifié.']);
    }
?>
=======
<?php
    // Connexion à la base de données
    include '../connexion_bdd/connexion_bdd.php';
    session_start();

    // Vérification de l'authenticité de l'utilisateur
    if(isset($_SESSION['id']) && isset($_POST['id_jeu'])) {
        $idJeu = intval($_POST['id_jeu']);
        $utilisateur = $_SESSION['id'];

        // Vérifiez si le jeu n'est pas déjà dans les favoris
        if (!in_array($idJeu, $_SESSION['favoris'])) {
            // Ajoutez le jeu aux favoris
            $_SESSION['favoris'][] = $idJeu;

            // Mettez à jour la base de données (ajout d'un favori)
            $updateQuery = $bdd->prepare("INSERT INTO favoris (id_visiteurs, id_jeux_videos) VALUES (?, ?)");
            $updateQuery->execute([$utilisateur, $idJeu]);

            // Mettez à jour la note du jeu dans la base de données
            $updateQuery = $bdd->prepare("UPDATE jeux_videos SET favoris_count = COALESCE(favoris_count, 0) + 1, note = COALESCE(favoris_count, 0) / 5 WHERE id = ?");
            $updateQuery->execute([$idJeu]);

            // Récupérez la nouvelle note
            $newNoteQuery = $bdd->prepare("SELECT note FROM jeux_videos WHERE id = ?");
            $newNoteQuery->execute([$idJeu]);
            $newNote = $newNoteQuery->fetchColumn();

            // Récupérez le nouveau nombre de favoris
            $newFavorisCountQuery = $bdd->prepare("SELECT favoris_count FROM jeux_videos WHERE id = ?");
            $newFavorisCountQuery->execute([$idJeu]);
            $newFavorisCount = $newFavorisCountQuery->fetchColumn();

            echo json_encode(['status' => 'added', 'newNote' => $newNote, 'newFavorisCount' => $newFavorisCount]);
        } else {
            // Retirez le jeu des favoris
            $_SESSION['favoris'] = array_diff($_SESSION['favoris'], array($idJeu));

            // Mettez à jour la base de données (retrait d'un favori)
            $updateQuery = $bdd->prepare("DELETE FROM favoris WHERE id_visiteurs = ? AND id_jeux_videos = ?");
            $updateQuery->execute([$utilisateur, $idJeu]);

            // Mettez à jour la note du jeu dans la base de données
            $updateQuery = $bdd->prepare("UPDATE jeux_videos SET favoris_count = COALESCE(favoris_count, 0) - 1, note = COALESCE(favoris_count, 0) / 5 WHERE id = ?");
            $updateQuery->execute([$idJeu]);

            // Récupérez la nouvelle note
            $newNoteQuery = $bdd->prepare("SELECT note FROM jeux_videos WHERE id = ?");
            $newNoteQuery->execute([$idJeu]);
            $newNote = $newNoteQuery->fetchColumn();
            
            // Récupérez le nouveau nombre de favoris
            $newFavorisCountQuery = $bdd->prepare("SELECT favoris_count FROM jeux_videos WHERE id = ?");
            $newFavorisCountQuery->execute([$idJeu]);
            $newFavorisCount = $newFavorisCountQuery->fetchColumn();

            echo json_encode(['status' => 'removed', 'newNote' => $newNote, 'newFavorisCount' => $newFavorisCount]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Identifiant du jeu non fourni ou utilisateur non authentifié.']);
    }
?>
>>>>>>> a02418468dad454e9d1471734a741ca2dc502094
