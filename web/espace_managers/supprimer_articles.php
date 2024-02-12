<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    // On recupere les infos
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = htmlspecialchars($_GET['id']);
        $recupArticles = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
        $recupArticles->execute(array($getid));
        if($recupArticles->rowCount() > 0){
            // On supprime les infos
            $deleteArticles = $bdd->prepare('DELETE FROM articles WHERE id = ?');
            $deleteArticles->execute(array($getid));
            // On redirige vers la page..
            header('Location: ../espace_managers/dashboard_manager.php');
        }else{
            echo " Aucun jeux vidéo trouvé";
        }
    }else{
        echo " Aucun identifiant trouvé";
    }
?>
