<?php
    // connexion bdd
    include '../connexion_bdd/connexion_bdd.php';
    session_start();
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier le jeton CSRF
        if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Invalid CSRF token');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérifier la complexité du mot de passe (20 caractères minimum, une majuscule, une minuscule, un caractère spécial)
        if (strlen($password) < 20 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            echo "Le mot de passe doit contenir au moins 20 caractères, une majuscule, une minuscule et un caractère spécial.";
        } else {
            // Utilisation de requêtes préparées pour éviter les injections SQL
            $requete = $bdd->prepare("SELECT * FROM administrateurs WHERE email = :email");
            $requete->execute(array("email" => $email));
            $rep = $requete->fetch();

            // Verify the password.
            if ($rep['id'] != false) {
                //c'est ok
                setcookie("email", $email, time() + 3600);
                // Utilisation d'une requête préparée pour mettre à jour le token
                $requeteUpdateToken = $bdd->prepare("UPDATE administrateurs SET token = :token WHERE email = :email");
                $requeteUpdateToken->execute(array("token" => $token, "email" => $email));

                setcookie("token", $token, time() + 3600);
    
                    // On redirige vers la page..
                    header("Location: ../espace_admin/dashboard_admin.php");
                    exit();
                } else {
                    echo "email ou mdp incorrect !";
                }
            }
        }
?>
