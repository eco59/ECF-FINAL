
# Gamesoft

Bienvenue sur Gamesoft, un site dédié aux jeux vidéo français développé par Coyen etienne.

## Description

Gamesoft est un projet open source qui vise à fournir une plateforme de découverte de jeux vidéos, qui a pour but d'aider les développeur de Gamesoft a priorisé les developpements des différents jeux videos selon les préférences du public.

## Fonctionnalités

- Recherche de jeux par titre, plateforme, genre, etc.
- Lecture d'articles concernant les jeux vidéos
- Gestion de listes de jeux favoris
- Système de notation des jeux
- ...



## Documentation

### Font-end :

J'ai utilisé du HTML5, du CSS ainsi que du JAVASCRIPT ( Utilisation d'AJAX et de JSON).

### Back-end:

J'ai utilisé du PHP avec utilisation PDO (version 8.2) 

Ma base de donnée est une base de donnée relationnel, pour ma part j'ai utilisé MariaDB grâce a PhpMyAdmin ( XAMPP control pannel).

### Sécurite :

Les mots de passe sont hashés ;

une politique de mot de passe est appliqué via la norme du CNIL ;

J'ai utilisé des requête PDO préparé pour éviter des injection SQL ou des failles XSS ;

J'ai utilisé des tokens ainsi que des jetons CRSF.



## Logo

https://github.com/eco59/ECF-FINAL/blob/dev/asset/logo.png


## Prerequisites

Un ordinateur avec Windows

Un IDE 

Node.js et npm d'installer (https://nodejs.org/)

Bibliothèque a installer : Phpspreadsheet

XAMPP control pannel pour sa base de donnée

## Installation

1. Cloner le dépôt GitHub :

```bash
git clone https://github.com/eco59/ECF-FINAL.git


Installer les dépendances :

cd ecf-final
npm install


Créez un fichier .env à la racine du projet et configurez les variables suivantes :

PORT=3000
DATABASE_HOST=localhost


Votre base de donnée: wjwwpnuy_utilisateurs:

CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` text NOT NULL
)

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `auteur` varchar(60) NOT NULL,
  `date_mise_a_jour` date DEFAULT NULL,
  `chemin_image` varchar(255) NOT NULL
)

CREATE TABLE `favoris` (
  `id` int(11) NOT NULL,
  `id_visiteurs` int(11) DEFAULT NULL,
  `id_jeux_videos` int(11) DEFAULT NULL
)

CREATE TABLE `images_jeux` (
  `id` int(11) NOT NULL,
  `id_jeux_videos` int(11) NOT NULL,
  `chemin_image` varchar(255) NOT NULL
)

CREATE TABLE `jeux_videos` (
  `id` int(11) NOT NULL,
  `titre` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `date_de_creation` date DEFAULT NULL,
  `nombre_de_joueur` int(11) NOT NULL,
  `Studio` varchar(12) NOT NULL,
  `support` varchar(60) NOT NULL,
  `moteur_jeux` varchar(60) NOT NULL,
  `type_de_jeu` varchar(20) NOT NULL,
  `date_fin` date DEFAULT NULL,
  `budget` int(11) NOT NULL,
  `statut_du_jeu` varchar(20) NOT NULL,
  `date_mise_a_jour` date DEFAULT NULL,
  `commentaire` text NOT NULL,
  `nom_prenom` varchar(60) NOT NULL,
  `note` decimal(3,2) DEFAULT NULL,
  `favoris_count` int(11) DEFAULT NULL
)

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` text NOT NULL
)

CREATE TABLE `modification` (
  `id` int(11) NOT NULL,
  `id_jeux_videos` int(11) DEFAULT NULL,
  `nouveau_budget` decimal(10,0) NOT NULL,
  `ancien_budget` decimal(10,0) NOT NULL,
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp(),
  `commentaire` text NOT NULL
)

CREATE TABLE `producteurs` (
  `id` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` text NOT NULL
)

CREATE TABLE `visiteurs` (
  `id` int(11) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `token` text NOT NULL
)

-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_favoris` (`id_visiteurs`,`id_jeux_videos`),
  ADD KEY `favoris_ibfk_2` (`id_jeux_videos`);

--
-- Index pour la table `images_jeux`
--
ALTER TABLE `images_jeux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galerie image` (`id_jeux_videos`);

--
-- Index pour la table `jeux_videos`
--
ALTER TABLE `jeux_videos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modification`
--
ALTER TABLE `modification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modification` (`id_jeux_videos`);

--
-- Index pour la table `producteurs`
--
ALTER TABLE `producteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visiteurs`
--
ALTER TABLE `visiteurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT pour la table `images_jeux`
--
ALTER TABLE `images_jeux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `jeux_videos`
--
ALTER TABLE `jeux_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `modification`
--
ALTER TABLE `modification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `producteurs`
--
ALTER TABLE `producteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `visiteurs`
--
ALTER TABLE `visiteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`id_visiteurs`) REFERENCES `visiteurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`id_jeux_videos`) REFERENCES `jeux_videos` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `images_jeux`
--
ALTER TABLE `images_jeux`
  ADD CONSTRAINT `galerie image` FOREIGN KEY (`id_jeux_videos`) REFERENCES `jeux_videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `modification`
--
ALTER TABLE `modification`
  ADD CONSTRAINT `modification` FOREIGN KEY (`id_jeux_videos`) REFERENCES `jeux_videos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


```
## Deployment

```bash
  npm run deploy
```


## Authors

- [@eco59](https://www.github.com/eco59)


