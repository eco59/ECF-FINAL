<?php
include '../connexion_bdd/connexion_bdd.php';

// Préparez la requête avec un statement préparé pour éviter les injections SQL
$recupArticles = $bdd->prepare('SELECT titre, contenu, auteur, date_mise_a_jour, chemin_image, id FROM articles');
$recupArticles->execute();

while ($Articles = $recupArticles->fetch()) {
    ?>
    <div class="articles">
        <h1><?= htmlspecialchars($Articles['titre']);?></h1>
        <p><?= htmlspecialchars($Articles['contenu']);?></p>
        <p><?= htmlspecialchars($Articles['auteur']);?></p>
        <p><?= htmlspecialchars($Articles['date_mise_a_jour']);?></p>
        <img src="../images/<?= htmlspecialchars($Articles['chemin_image']); ?>" alt="<?= htmlspecialchars($Articles['titre']); ?>">
        <!-- Utilisation de htmlspecialchars pour les attributs href pour éviter les attaques XSS -->
        <a href="../details/articles_details.php?id=<?= htmlspecialchars($Articles['id']); ?>" class="en_savoir_plus">En savoir plus</a>
    </div>
    <br>
    <?php
}
?>
