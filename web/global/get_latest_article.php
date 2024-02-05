<?php
include '../connexion_bdd/connexion_bdd.php';

$recupArticles = $bdd->query('SELECT * FROM articles');
while ($Articles = $recupArticles->fetch()) {
    ?>
    <div class="articles">
        <h1><?= $Articles['titre'];?></h1>
        <p><?= $Articles['contenu'];?></p>
        <p><?= $Articles['auteur'];?></p>
        <p><?= $Articles['date_mise_a_jour'];?></p>
        <img src="../images/<?= $Articles['chemin_image']; ?>" alt="<?= $Articles['titre']; ?>">
        <a href="../details/articles_details.php?id=<?= $Articles['id']; ?>" class="en_savoir_plus">En savoir plus</a>
    </div>
    <br>
    <?php
}
?>