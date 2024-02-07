<?php
    //connexion bdd
    include '../connexion_bdd/connexion_bdd.php';

    if(isset($_GET['id']) AND !empty($_GET['id'])){
        // On vérifie la base de donnée
        $getid = htmlspecialchars($_GET['id']);
        $recupManager = $bdd->prepare('SELECT * FROM producteurs WHERE id =?', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $recupManager->execute(array($getid));
        if($recupManager->rowCount() >0){
            // On supprime dans la base de donnée
            $bannirManager = $bdd->prepare('DELETE FROM producteurs WHERE id = ?', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $bannirManager->execute(array($getid));
            // On redirige à la page ...
            header('Location: ../espace_admin/infos_compte.php');
            exit();
        }else{
            echo "Aucun memebre n'a été trouvé";
        }
    }else{
        echo "L'identifiant n'a pas été récupéré";
    }

?>