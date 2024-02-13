-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 fév. 2024 à 14:57
-- Version du serveur : 10.5.21-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wjwwpnuy_utilisateurs`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `mdp`, `email`, `token`) VALUES
(6, '5e982d446963a4a7a12a94df1f805ea3c6e78ee6de4197bc8fd17df37493', 'administrateurtest@test.fr', '');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `auteur` varchar(60) NOT NULL,
  `date_mise_a_jour` date DEFAULT NULL,
  `chemin_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `auteur`, `date_mise_a_jour`, `chemin_image`) VALUES
(16, 'Test complet de Tekken 8 : le dÃ©but dâ€™une nouvelle Ã¨re', 'AprÃ¨s Street Fighter VI et Mortal Kombat 1, Tekken 8 sâ€™apprÃªte Ã  complÃ©ter la sainte trinitÃ© des jeux de combat de nouvelle gÃ©nÃ©ration. Le nouveau bÃ©bÃ© dâ€™Harada parviendra-t-il Ã  rÃ©pondre aux attentes Ã©normes du public ? Voici notre premier avis Ã  chaud.<br />\r\n<br />\r\nÃ‡a y est. AprÃ¨s des annÃ©es dâ€™attente et une campagne de promotion extrÃªmement dense qui a alimentÃ© une hype phÃ©nomÃ©nale ces derniers mois, Tekken 8 est enfin sur le point dâ€™arriver. Quasiment trente ans aprÃ¨s la sortie du premier opus, Katsuhiro Harada et ses troupes reviennent avec la promesse dâ€™offrir un grand tournant gÃ©nÃ©rationnel Ã  cette franchise lÃ©gendaire.<br />\r\n<br />\r\nTekken 8 se dÃ©marque Ã  bien des niveaux, et les premiÃ¨res diffÃ©rences sont immÃ©diatement visibles avant mÃªme dâ€™arriver au menu principal. Ce nâ€™Ã©tait pas une surprise puisque Bandai-Namco a multipliÃ© les teasers, mais on peut difficilement sâ€™empÃªcher dâ€™Ãªtre bluffÃ© par lâ€™ampleur de la transformation esthÃ©tique opÃ©rÃ©e par le studio.<br />\r\n<br />\r\nUn renouveau style graphique trÃ¨s rÃ©ussi, mais clivant<br />\r\nDâ€™un point de vue strictement technique, Tekken 8 est absolument magnifique pour un jeu de combat, sachant quâ€™il sâ€™agit dâ€™un genre oÃ¹ les artistes doivent jongler avec de nombreuses restrictions puisquâ€™il est impÃ©ratif de privilÃ©gier la fluiditÃ© du gameplay. Produit sous Unreal Engine 5, il se hisse sans problÃ¨me au niveau de Mortal Kombat 1 en termes de fidÃ©litÃ© graphique. Il sâ€™agit sans conteste dâ€™un des plus beaux jeux de baston jamais produits, aussi bien au niveau des personnages que des animations et des dÃ©cors.<br />\r\n<br />\r\nEn ce qui concerne la direction artistique, par contre, les joueurs risquent dâ€™Ãªtre un tantinet plus divisÃ©s. Un peu comme Capcom avec Street Fighter VI, Bandai Namco a optÃ© pour une identitÃ© visuelle assez diffÃ©rente des prÃ©cÃ©dents opus. Les graphismes plutÃ´t sobres et terre Ã  terre qui faisait partie de lâ€™identitÃ© de la sÃ©rie ont Ã©tÃ© sacrifiÃ©s sur lâ€™autel du grand spectacle, avec un dÃ©ferlement constant de couleurs vives et dâ€™effets de particules qui donnent un cÃ´tÃ© rÃ©solument plus anime quâ€™auparavant.<br />\r\n<br />\r\nMÃªme si le rÃ©sultat en jette incontestablement, ce changement de style ne plaira pas forcÃ©ment Ã  tout le monde, Ã  la fois pour des raisons de goÃ»t artistique et de gameplay. Par exemple, de notre cÃ´tÃ©, nous avons trouvÃ© que ces avalanches de VFX avaient un impact trop important sur la lisibilitÃ© des matches, et choisi de les rÃ©duire au minimum. Les joueurs PC qui disposent dâ€™une machine modeste risquent aussi de devoir diminuer la qualitÃ© graphique.<br />\r\n<br />\r\nAutre prÃ©cision importante : Bandai Namco recommande dâ€™installer Tekken 8 sur un SSD, et ce nâ€™est pas une exagÃ©ration. MÃªme si nous ne sommes pas dans une situation Ã  la Starfield, carrÃ©ment injouable sans SSD, les temps de chargement peuvent vite devenir exaspÃ©rants sur un HDD traditionnel. Dans la mesure du possible, prÃ©fÃ©rez donc lâ€™option flash.<br />\r\n<br />\r\nMode Histoire : bien plus abouti, mais toujours anecdotique<br />\r\nAvant lâ€™ouverture tant attendue des serveurs, nous avons passÃ© quelques heures Ã  dÃ©couvrir le contenu hors ligne en commenÃ§ant par le contenu solo, et notamment le nouveau mode Histoire. La trame narrative est exactement ce Ã  quoi on pouvait sâ€™attendre.<br />\r\n<br />\r\nAprÃ¨s quâ€™il ait enfin rÃ©ussi Ã  se dÃ©barrasser de son illustre paternel Heihachi Ã  la fin de Tekken 7, Kazuya Mishima est plus dÃ©terminÃ© que jamais Ã  assouvir sa soif de pouvoir absolu. Il sâ€™embarque dans une grande entreprise de domination du monde avec lâ€™objectif de lancer une nouvelle Ã¨re pour lâ€™humanitÃ©, oÃ¹ seuls les combattants les plus impitoyables auront leur place. Il se heurte cependant Ã  un dernier obstacle : une coalition menÃ©e par son fils Jin, hÃ©ritier de son fameux Devil Gene et seule personne capable de lui tenir tÃªte en combat singulier.<br />\r\n<br />\r\nRien dâ€™excessivement original, en somme â€“ et cela vaut aussi pour le gameplay. Certes, les diffÃ©rents Ã©pisodes sont largement mieux mis en scÃ¨ne que dans Tekken 7, mais ils souffrent toujours des mÃªmes problÃ¨mes quâ€™auparavant, notamment Ã  cause de lâ€™IA des adversaires qui rend les matches trÃ¨s diffÃ©rents de ceux entre humains â€“ et pas pour les bonnes raisons. Les Bots enchaÃ®nent toujours les actions qui vont Ã  lâ€™encontre des principes fondamentaux du jeu, et compensent leur absence totale de stratÃ©gie par une bonne dose dâ€™input reading nausÃ©abond. Plus frustrant quâ€™autre chose.<br />\r\n<br />\r\nEn dâ€™autres termes, câ€™est un mode Histoire loin dâ€™Ãªtre transcendant, et largement insuffisant pour justifier lâ€™achat du titre Ã  lui seul. Si vous nâ€™Ãªtes pas adepte des combats entre joueurs et que vous songez Ã  vous offrir Tekken 8 pour son scÃ©nario, sans surprise, mieux vaut vous abstenir.<br />\r\n<br />\r\nMode Arcade : enfin une main tendue aux dÃ©butants<br />\r\nPar contre, le nouveau mode Arcade qui remplace le mode Treasure Battle a de vrais arguments. Au lieu dâ€™enchaÃ®ner des combats stÃ©riles contre ces bots dÃ©cÃ©rÃ©brÃ©s, il offre cette fois un semblant de mise en scÃ¨ne en proposant au joueur de progresser dâ€™un dojo Ã  lâ€™autre en affrontant des adversaires virtuels de plus en plus coriaces.<br />\r\n<br />\r\nCes derniers souffrent toujours des mÃªmes problÃ¨mes dâ€™IA, ce qui rend lâ€™expÃ©rience assez dÃ©sespÃ©rante pour les joueurs confirmÃ©s ou avancÃ©s. Par contre, ce mode a un vrai intÃ©rÃªt pour les nÃ©ophytes; en pratique, il joue le rÃ´le de tutoriel progressif qui permet aux nouveaux venus de dÃ©couvrir les diffÃ©rentes mÃ©caniques de ce jeu atrocement complexe Ã  leur rythme. Câ€™est la premiÃ¨re fois quâ€™un Tekken propose ce genre dâ€™initiation en douceur, et il Ã©tait plus que temps ! A lui seul, ce mode arcade qui prend les dÃ©butants par la main pourrait rendre les premiers pas bien moins intimidants. Cela Ã©vite de tout devoir apprendre Ã  la dure â€“ un processus souvent frustrant qui a sans doute dÃ©couragÃ© de nombreux joueurs.<br />\r\n<br />\r\nOn peut aussi citer lâ€™arrivÃ©e du mode SpÃ©cial, calquÃ© sur le mode Moderne de StreetFighter VI. Il rÃ©duit Ã©normÃ©ment le nombre dâ€™options pour forcer le joueur Ã  se concentrer sur une poignÃ©e de coups gÃ©nÃ©ralement utiles. Cela a pour effet dâ€™Ã©liminer quasiment toutes les nuances qui font le sel de Tekken, mais cela permet surtout aux dÃ©butants de commencer Ã  sâ€™amuser beaucoup plus rapidement, sans devoir passer plusieurs heures Ã  apprendre le strict minimum vital pour jouer un personnage.<br />\r\n<br />\r\nEn conclusion, la barriÃ¨re dâ€™entrÃ©e est donc significativement plus basse quâ€™auparavant, et câ€™est une trÃ¨s bonne nouvelle pour lâ€™avenir de la franchise.', 'Antoine Gautherie', '2024-02-13', 'tekken-8-precommande.webp'),
(17, 'Epic Games Store : 2 jeux gratuits pour le â€œprixâ€ dâ€™un seulement cette semaine', 'Comme cela peut lui arriver, Epic Games a dÃ©cidÃ© de rÃ©galer ses joueurs deux fois plus quâ€™Ã  lâ€™accoutumÃ©e. En effet, sur son store, vous pouvez dâ€™ores et dÃ©jÃ  rÃ©cupÃ©rer deux titres gratuits pour le prix dâ€™un (vous avez compris) et ce jusquâ€™Ã  jeudi prochain. La sÃ©lection de cette semaine nous promet des sessions de gameplay intenses, notamment avec le premier jeu offert. Il sâ€™agit de Doki Doki Literature Club Plus.<br />\r\n<br />\r\nDe lâ€™horreur, de lâ€™amour et de lâ€™action<br />\r\nSurnommÃ© DDLC, il sâ€™agit dâ€™un jeu narratif en point and click basÃ© sur les codes des dating sim. Vous Ãªtes Ã©lÃ¨ve dans un lycÃ©e et devez conquÃ©rir votre crush avec des poÃ¨mes que vous Ã©crivez. Ils doivent Ãªtre parfaits pour obtenir la fin que vous souhaitez. Mais une rÃ©alitÃ© plus sombre se cache sous ces airs innocents. DDLC est considÃ©rÃ© comme un jeu dâ€™horreur psychologique, et il a un concept pour le moins intrigant. Il est bien mentionner sur la fiche produit quâ€™il â€œne convient pas aux enfants ni aux personnes trop sensibles.â€<br />\r\n<br />\r\nSi dâ€™habitude le jeu de base est gratuit, câ€™est la version Plus qui vous est offerte pendant une semaine. Celle-ci ajoute des musiques, des illustrations et des chapitres supplÃ©mentaires Ã  lâ€™histoire pour un maximum de fun (ou de frayeur). Si vous ne pensez pas Ãªtre prÃªts Ã  vous lancer dans lâ€™aventure, vous pouvez Ã©galement rÃ©cupÃ©rer le jeu Lost Castle.<br />\r\n<br />\r\nOn quitte les couloirs roses du lycÃ©e pour sâ€™engouffrer dans un univers dâ€™heroic fantasy. Il se prÃ©sente sous la forme dâ€™un dungeon crawler et dâ€™un rogue-lite dans lequel vous devrez combattre des forces malÃ©fiques et dÃ©moniaques. Celles-ci ont pris possession du chÃ¢teau de Hardwood et ont Ã©tendu leur corruption dans toute la rÃ©gion. Le gros avantage de ce titre est quâ€™il peut se jouer en solo ou Ã  plusieurs, jusquâ€™Ã  4 joueurs en local ou en ligne. Son style visuel sâ€™inspire des jeux rÃ©tro en 2D/3D sans pour autant adopter le look des Pixel Arts.<br />\r\n<br />\r\nLe programme de la semaine prochaine est lÃ <br />\r\nLa semaine prochaine, le rythme dâ€™Epic Games revient Ã  la normale. Si les deux titres susmentionnÃ©s sont Ã  rÃ©cupÃ©rer avant le 15 fÃ©vrier Ã  17h, câ€™est parce quâ€™ils seront remplacÃ©s par le jeu gratuit de la semaine prochaine, Ã  savoir Dakar Desert Rally. Comme son nom lâ€™indique, il sâ€™agit dâ€™un jeu de course sur terrain naturel. Visuellement, lâ€™immersion est Ã  son comble. Le titre de simulation vaut actuellement 29,99â‚¬ il sâ€™agit donc dâ€™un beau cadeau de la part du studio.<br />\r\n<br />\r\n', 'Elisa Rahouadj', '2024-02-13', 'lostcastle.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id` int(11) NOT NULL,
  `id_visiteurs` int(11) DEFAULT NULL,
  `id_jeux_videos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `id_visiteurs`, `id_jeux_videos`) VALUES
(220, 17, 32),
(221, 17, 33),
(225, 18, 33);

-- --------------------------------------------------------

--
-- Structure de la table `images_jeux`
--

CREATE TABLE `images_jeux` (
  `id` int(11) NOT NULL,
  `id_jeux_videos` int(11) NOT NULL,
  `chemin_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `images_jeux`
--

INSERT INTO `images_jeux` (`id`, `id_jeux_videos`, `chemin_image`) VALUES
(26, 31, 'FF7a-min.jpg'),
(27, 31, 'FF7b-min.jpg'),
(28, 31, 'FF7-min.jpg'),
(29, 31, 'final_fantasy_vii_rebirth-min.jpg'),
(30, 32, 'StarWars-min.jpg'),
(31, 33, 'super-mario-rpg-0-min.jpg'),
(35, 36, ''),
(36, 31, 'FF7a-min.jpg'),
(37, 32, 'StarWars-min.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `jeux_videos`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jeux_videos`
--

INSERT INTO `jeux_videos` (`id`, `titre`, `description`, `date_de_creation`, `nombre_de_joueur`, `Studio`, `support`, `moteur_jeux`, `type_de_jeu`, `date_fin`, `budget`, `statut_du_jeu`, `date_mise_a_jour`, `commentaire`, `nom_prenom`, `note`, `favoris_count`) VALUES
(31, 'Final Fantasy VII Rebirth', 'Il est de retour...', '2024-02-05', 1, 'Gamesoft', 'console', 'Unity', 'Action', '2024-12-31', 13503, 'En cours', '2024-02-07', '', 'coyen etienne', 0.20, 1),
(32, 'Star wars outlaws', 'Star Wars Outlaws se dÃ©roule entre les Ã©vÃ©nements des films iconiques L&#039;Empire Contre-Attaque et Le Retour du Jedi. Le joueur incarnera un personnage nommÃ© Kay Vess, un anti-hÃ©ros Ã©mergent Ã  la recherche de libertÃ© et de moyens de commencer une nouvelle vie. AccompagnÃ© de son compagnon Nix, Kay devra se battre, voler et ruser pour traverser les syndicats du crime de la galaxie, rejoignant ainsi les rangs des hors-la-loi les plus recherchÃ©s.', '2024-02-05', 1, 'Gamesoft', 'Console/Ordinateur', 'Unity', 'Action', '2024-12-31', 250000, 'En cours', '2024-02-07', '', 'coyen etienne', 0.40, 2),
(33, 'Super Mario RPG : Legend of the sevens stars', 'Le nouveau Mario RPG arrive enfin en France !', '2024-02-05', 1, 'Gamesoft', 'Console/Ordinateur', 'Unreal', 'RPG', '2024-12-31', 543200, 'En cours', '2024-02-07', '', 'coyen etienne', 0.40, 2),
(36, 'Avowed', 'Bienvenue dans les Terres vivantes, une mystÃ©rieuse Ã®le oÃ¹ vous attendent des aventures et des dangers.<br />\r\nAvowed est un RPG Ã  la premiÃ¨re personne dÃ©veloppÃ© par l&#039;Ã©quipe primÃ©e d&#039;Obsidian Entertainment. Il se dÃ©roule dans le monde fictif d&#039;Eora que les joueurs ont pu dÃ©couvrir dans la franchise Pillars of Eternity.<br />\r\nVous Ãªtes un Ã©missaire d&#039;Aedyr, un pays lointain, et devez mener l&#039;enquÃªte sur une Ã©pidÃ©mie se rependant sur les Terres vivantes. Des mystÃ¨res, des secrets, des dangers et des aventures vous attendent sur cette Ã®le oÃ¹ vos choix ont des consÃ©quences et oÃ¹ la nature est restÃ©e sauvage. Vous dÃ©couvrez un lien personnel unissant les Terres vivantes et un ancien secret qui menace de tout dÃ©truire. Serez-vous en mesure de sauver cette frontiÃ¨re et votre Ã¢me des forces menaÃ§ant de les dÃ©chirer ?<br />\r\n<br />\r\nLes Ã©tranges et merveilleuses Terres vivantes<br />\r\nLes Terres vivantes sont un endroit Ã  la fois Ã©tranger et intrinsÃ¨quement familier, comme si l&#039;Ã®le elle-mÃªme vous lanÃ§ait un appel Ã  l&#039;aide. Explorez une Ã®le berceau de diffÃ©rent environnement et paysages qui abritent tous un Ã©cosystÃ¨me unique.<br />\r\n<br />\r\nDes combats viscÃ©raux Ã  votre faÃ§on<br />\r\nAssociez Ã©pÃ©es, sorts, pistolets et boucliers pour combattre Ã  votre faÃ§on. DÃ©couvrez dans votre grimoire des sorts pour piÃ©ger, geler ou brÃ»ler vos ennemis, frappez-les avec votre bouclier ou tenez-les Ã  distance grÃ¢ce Ã  votre arc.<br />\r\n<br />\r\nDes compagnons pour vous Ã©pauler<br />\r\nDes compagnons d&#039;une variÃ©tÃ© d&#039;espÃ¨ces combattront Ã  vos cÃ´tÃ©s grÃ¢ce Ã  leurs propres assortiments de compÃ©tences. Qu&#039;il s&#039;agisse d&#039;un ancien mercenaire ou d&#039;un sorcier excentrique, ces compagnons feront partie intÃ©grante de votre pÃ©riple, et vos choix les modeleront au fil de votre assistance dans leurs quÃªtes.', '2024-02-07', 1, 'Gamesoft', 'Console/Ordinateur', 'Unity', 'Action', '2024-12-31', 987000, 'En cours', '2024-02-07', 'TEST', 'coyen etienne', 0.20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `manager`
--

INSERT INTO `manager` (`id`, `mdp`, `email`, `token`) VALUES
(15, '$2y$10$e7zg.eLYGcbNDXYxvoVYiOULIibGVu3SIIPikRG0WfmkJWur5z4FW', 'managerstest@test.fr', '20e50a76acab06d4d5d18c5eb6cdb9417faab9386f3585b84ed39577054fd3ac');

-- --------------------------------------------------------

--
-- Structure de la table `modification`
--

CREATE TABLE `modification` (
  `id` int(11) NOT NULL,
  `id_jeux_videos` int(11) DEFAULT NULL,
  `nouveau_budget` decimal(10,0) NOT NULL,
  `ancien_budget` decimal(10,0) NOT NULL,
  `date_modification` timestamp NOT NULL DEFAULT current_timestamp(),
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `modification`
--

INSERT INTO `modification` (`id`, `id_jeux_videos`, `nouveau_budget`, `ancien_budget`, `date_modification`, `commentaire`) VALUES
(11, NULL, 0, 0, '2024-02-02 13:37:24', ''),
(12, NULL, 0, 0, '2024-02-02 13:38:01', ''),
(13, NULL, 0, 0, '2024-02-02 13:40:29', ''),
(14, NULL, 32, 0, '2024-02-02 13:40:49', 'E'),
(15, NULL, 32, 0, '2024-02-02 13:41:09', 'E'),
(16, NULL, 3, 0, '2024-02-02 13:41:21', 'E'),
(19, NULL, 1, 0, '2024-02-02 13:49:05', 'A'),
(20, NULL, 1, 0, '2024-02-02 13:50:06', 'A'),
(21, NULL, 1, 0, '2024-02-02 13:50:14', 'Z'),
(22, NULL, 1, 0, '2024-02-02 13:50:30', 'Z'),
(23, NULL, 0, 0, '2024-02-05 15:02:19', ''),
(24, 31, 13502, 135000, '2024-02-06 15:04:59', 'modif budget 2'),
(25, 31, 13503, 13502, '2024-02-07 22:35:08', '');

-- --------------------------------------------------------

--
-- Structure de la table `producteurs`
--

CREATE TABLE `producteurs` (
  `id` int(11) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `producteurs`
--

INSERT INTO `producteurs` (`id`, `mdp`, `email`, `token`) VALUES
(12, '$2y$10$wgNIT2GB7wtHsQczMkEJR.4AH/prU4Y.Ek2b8h25IXaYRwKwAr5re', 'producteurstest@test.fr', '0f7224fc527260f5ab53b2676cd9f2399825ff8855f2e6789dd635bec5641668');

-- --------------------------------------------------------

--
-- Structure de la table `visiteurs`
--

CREATE TABLE `visiteurs` (
  `id` int(11) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `visiteurs`
--

INSERT INTO `visiteurs` (`id`, `mdp`, `email`, `pseudo`, `token`) VALUES
(14, '$2y$10$VEwuFnBPujX55quLzR8paeuqXQl5LMd.hAniGkYbOnNKsfJK6hWhy', 'visiteur@test.fr', 'eti3', ''),
(15, '$2y$10$L0tt.o.hH/YDTnQkugzbMun1hPlooFcTEXCZaxvanhI92FuBQvF6O', 'visiteur5@test.fr', 'Test5', ''),
(16, '$2y$10$Oxny4zHWVvZKqEEIggGXX.nLuz8BgE3M7YTJtO.xWQ1nMMLpvSS5O', 'visiteurtest@test.fr', 'test2', ''),
(17, '$2y$10$9nycnH.Jxa1uvzW50RCkUONGncYP/k8FTHs/k0x/mAR.sXhW8Qgvu', 'visiteur3@test.fr', 'test3', ''),
(18, '$2y$10$O8Dr5RYOf046eDhcsWA/9uMqGOIAKHiEyeIA5eR5Mq1WNv7q/ujIW', 'visiteurs10@test.fr', 'test10', '');

--
-- Index pour les tables déchargées
--

--
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `modification`
--
ALTER TABLE `modification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `producteurs`
--
ALTER TABLE `producteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
