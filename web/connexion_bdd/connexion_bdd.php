<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try{
        $bdd = new PDO("mysql:host=$servername;dbname=utilisateurs", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "connexion reussie !";
    }
    catch(PDOException $e) {
        // Enregistrez l'erreur dans un fichier journal
        error_log("Erreur PDO : " . $e->getMessage(), 0);
        // Affichez un message générique à l'utilisateur
        echo "Une erreur s'est produite. Veuillez réessayer plus tard.";
    }
?>