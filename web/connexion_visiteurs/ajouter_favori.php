<<<<<<< HEAD
<?php
    // Inclure le fichier de connexion à la base de données
    include_once '../connexion_bdd/connexion_bdd.php';
    
    // Démarrer la session
    session_start();

    // Vérifier si la requête est une méthode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer l'identifiant du jeu depuis la requête POST
        $jeuId = $_POST['jeu_id'];
    
        // Ajouter le jeu aux favoris du visiteur (vous devrez gérer l'authentification des visiteurs ici)
        $visiteurId = 1; // À remplacer par l'identifiant du visiteur connecté (à gérer côté serveur)
        
        // Préparation de la requête SELECT pour vérifier si le jeu est déjà dans les favoris
        $check_query = "SELECT * FROM favori WHERE visiteur_id = ? AND jeu_id = ?";
        $check_stmt = $bdd->prepare($check_query);

        // Liaison des paramètres
        $check_stmt->bind_param("ii", $visiteurId, $jeuId);
        
        // Exécution de la requête
        $check_stmt->execute();
        
        // Récupération du résultat
        $check_result = $check_stmt->get_result();
    
        // Vérification du nombre de lignes retournées
        if ($check_result->num_rows == 0) {
            // Le jeu n'est pas dans les favoris, on peut l'ajouter
            // Préparation de la requête INSERT
            $insert_query = "INSERT INTO favori (visiteur_id, jeu_id) VALUES (?, ?)";
            $insert_stmt = $bdd->prepare($insert_query);
            
            // Liaison des paramètres
            $insert_stmt->bind_param("ii", $visiteurId, $jeuId);
            
            // Exécution de la requête INSERT
            $insert_stmt->execute();
            
            echo 'Le jeu a été ajouté aux favoris.';
        } else {
            // Le jeu est déjà dans les favoris
            echo 'Le jeu est déjà dans les favoris.';
        }
    }
=======
<?php
    // Inclure le fichier de connexion à la base de données
    include_once '../connexion_bdd/connexion_bdd.php';
    
    // Démarrer la session
    session_start();

    // Vérifier si la requête est une méthode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer l'identifiant du jeu depuis la requête POST
        $jeuId = $_POST['jeu_id'];
    
        // Ajouter le jeu aux favoris du visiteur (vous devrez gérer l'authentification des visiteurs ici)
        $visiteurId = 1; // À remplacer par l'identifiant du visiteur connecté (à gérer côté serveur)
        
        // Préparation de la requête SELECT pour vérifier si le jeu est déjà dans les favoris
        $check_query = "SELECT * FROM favori WHERE visiteur_id = ? AND jeu_id = ?";
        $check_stmt = $bdd->prepare($check_query);

        // Liaison des paramètres
        $check_stmt->bind_param("ii", $visiteurId, $jeuId);
        
        // Exécution de la requête
        $check_stmt->execute();
        
        // Récupération du résultat
        $check_result = $check_stmt->get_result();
    
        // Vérification du nombre de lignes retournées
        if ($check_result->num_rows == 0) {
            // Le jeu n'est pas dans les favoris, on peut l'ajouter
            // Préparation de la requête INSERT
            $insert_query = "INSERT INTO favori (visiteur_id, jeu_id) VALUES (?, ?)";
            $insert_stmt = $bdd->prepare($insert_query);
            
            // Liaison des paramètres
            $insert_stmt->bind_param("ii", $visiteurId, $jeuId);
            
            // Exécution de la requête INSERT
            $insert_stmt->execute();
            
            echo 'Le jeu a été ajouté aux favoris.';
        } else {
            // Le jeu est déjà dans les favoris
            echo 'Le jeu est déjà dans les favoris.';
        }
    }
>>>>>>> a02418468dad454e9d1471734a741ca2dc502094
?>