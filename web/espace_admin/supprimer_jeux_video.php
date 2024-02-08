<<<<<<< HEAD
<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    // On recupere les infos
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = htmlspecialchars($_GET['id']);
        $recupJeuxVideos = $bdd->prepare('SELECT * FROM jeux_videos WHERE id = ?');
        $recupJeuxVideos->execute(array($getid));
        if($recupJeuxVideos->rowCount() > 0){
            // On supprime les infos
            $deleteJeuxVideos = $bdd->prepare('DELETE FROM jeux_videos WHERE id = ?');
            $deleteJeuxVideos->execute(array($getid));
            // On redirige vers la page..
            header('Location: ../espace_admin/dashboard_admin.php');
        }else{
            echo " Aucun jeux vidéo trouvé";
        }
    }else{
        echo " Aucun identifiant trouvé";
    }
=======
<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    // Démarrer la session sur chaque page où vous en avez besoin
    session_start();
    // On recupere les infos
    if(isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = htmlspecialchars($_GET['id']);
        $recupJeuxVideos = $bdd->prepare('SELECT * FROM jeux_videos WHERE id = ?');
        $recupJeuxVideos->execute(array($getid));
        if($recupJeuxVideos->rowCount() > 0){
            // On supprime les infos
            $deleteJeuxVideos = $bdd->prepare('DELETE FROM jeux_videos WHERE id = ?');
            $deleteJeuxVideos->execute(array($getid));
            // On redirige vers la page..
            header('Location: ../espace_admin/dashboard_admin.php');
        }else{
            echo " Aucun jeux vidéo trouvé";
        }
    }else{
        echo " Aucun identifiant trouvé";
    }
>>>>>>> a02418468dad454e9d1471734a741ca2dc502094
?>