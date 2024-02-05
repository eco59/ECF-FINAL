<?php
    //connexion bdd
    include_once '../connexion_bdd/connexion_bdd.php';
    
    session_start(); // Assurez-vous que la session est démarrée

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupère l'identifiant du jeu depuis la requête POST
        $jeuId = $_POST['jeu_id'];
    
        // Ajoute le jeu aux favoris du visiteur (vous devrez gérer l'authentification des visiteurs ici)
        $visiteurId = 1; // À remplacer par l'identifiant du visiteur connecté (à gérer côté serveur)
        
        // Vérifie si le jeu n'est pas déjà dans les favoris du visiteur
        $check_query = "SELECT * FROM favori WHERE visiteur_id = $visiteurId AND jeu_id = $jeuId";
        $check_result = $conn->query($check_query);
    
        if ($check_result->num_rows == 0) {
            // Ajoute le jeu aux favoris
            $insert_query = "INSERT INTO favori (visiteur_id, jeu_id) VALUES ($visiteurId, $jeuId)";
            $conn->query($insert_query);
            echo 'Le jeu a été ajouté aux favoris.';
        } else {
            echo 'Le jeu est déjà dans les favoris.';
        }
    }
    
    
?>