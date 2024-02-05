<?php
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../accueil/accueil.php');
    exit();
?>