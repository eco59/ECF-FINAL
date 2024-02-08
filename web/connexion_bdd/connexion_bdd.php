<?php
    $serveur = "localhost";
    $utilisateur = "wjwwpnuy_eliecohe";
    $motdepasse = "Cig@rettes1267+";
    $base_de_donnees = "wjwwpnuy_utilisateurs";
    

    try {
        $bdd = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $motdepasse);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        
        
        // Affichez un message générique à l'utilisateur
        echo "Une erreur s'est produite. Veuillez réessayer plus tard.";
    }
?>