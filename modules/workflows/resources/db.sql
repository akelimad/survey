--
-- Structure de la table `root_departements`
--
CREATE TABLE `root_departements` (
  `id_departement` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id_departement`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;


--
-- Déchargement des données de la table `root_departements`
--
INSERT INTO `root_departements` (`id_departement`, `name`) VALUES
(1, 'Achats'),
(2, 'Logistique'),
(3, 'RH'),
(4, 'Prestations');


--
-- Déchargement des données de la table `root_roles`
--
ALTER TABLE `root_roles` ADD `id_departement` INT NULL DEFAULT NULL AFTER `id_type_role`;

--
-- Structure de la table `workflows`
--
CREATE TABLE `workflows` (
  `id_workflow` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `reference` varchar(64) NOT NULL,
  `custom` tinyint(4) NOT NULL DEFAULT '0',
  `value` text NOT NULL,
  PRIMARY KEY (`id_workflow`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;

--
-- Déchargement des données de la table `workflows`
--
INSERT INTO `workflows` (`id_workflow`, `name`, `reference`, `custom`, `value`) VALUES
(1, 'WF en 3 Etapes', '1505403350551', 0, '{\"name\":\"WF en 3 Etapes\",\"steps\":[{\"Id\":1,\"depId\":3,\"description\":\"\",\"top\":\"200px\",\"left\":\"320px\"},{\"Id\":2,\"depId\":1,\"description\":\"\",\"top\":\"200px\",\"left\":\"620px\"},{\"Id\":4,\"depId\":2,\"description\":\"\",\"top\":\"200px\",\"left\":\"920px\"}],\"results\":[{\"Id\":1,\"sourceId\":\"1\",\"targetId\":\"2\",\"sourceEndpoint\":\"Right\",\"targetEndpoint\":\"Left\"},{\"Id\":4,\"sourceId\":\"2\",\"targetId\":\"4\",\"sourceEndpoint\":\"Right\",\"targetEndpoint\":\"Left\"}]}'),
(2, 'WF en 2 Etapes', '1505403400723', 0, '{\"name\":\"WF en 2 Etapes\",\"steps\":[{\"Id\":1,\"depId\":4,\"description\":\"\",\"top\":\"100px\",\"left\":\"400px\"},{\"Id\":2,\"depId\":3,\"description\":\"\",\"top\":\"100px\",\"left\":\"680px\"}],\"results\":[{\"Id\":1,\"sourceId\":\"1\",\"targetId\":\"2\",\"sourceEndpoint\":\"Right\",\"targetEndpoint\":\"Left\"},{\"Id\":2,\"sourceId\":\"2\",\"targetId\":\"1\",\"sourceEndpoint\":\"Bottom\",\"targetEndpoint\":\"Left\"}]}'),
(3, 'WF en 4 Etapes', '1506416753965', 0, '{\"name\":\"WF en 4 Etapes\",\"steps\":[{\"Id\":1,\"depId\":1,\"description\":\"\",\"top\":\"180px\",\"left\":\"420px\"},{\"Id\":2,\"depId\":2,\"description\":\"\",\"top\":\"180px\",\"left\":\"780px\"},{\"Id\":3,\"depId\":3,\"description\":\"\",\"top\":\"420px\",\"left\":\"780px\"},{\"Id\":4,\"depId\":2,\"description\":\"\",\"top\":\"420px\",\"left\":\"1060px\"}],\"results\":[{\"Id\":1,\"sourceId\":\"1\",\"targetId\":\"2\",\"sourceEndpoint\":\"Right\",\"targetEndpoint\":\"Left\"},{\"Id\":2,\"sourceId\":\"2\",\"targetId\":\"3\",\"sourceEndpoint\":\"Bottom\",\"targetEndpoint\":\"Top\"},{\"Id\":3,\"sourceId\":\"3\",\"targetId\":\"4\",\"sourceEndpoint\":\"Right\",\"targetEndpoint\":\"Left\"},{\"Id\":4,\"sourceId\":\"4\",\"targetId\":\"1\",\"sourceEndpoint\":\"Bottom\",\"targetEndpoint\":\"Left\"}]}');


--
-- Structure de la table `workflow_history`
--
CREATE TABLE `workflow_history` (
  `id_history` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_workflow` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL,
  `status` varchar(64) NOT NULL,
  `note` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id_history`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;


--
-- Déchargement des données de la table `workflow_history`
--
INSERT INTO `workflow_history` (`id_history`, `id_workflow`, `id_offre`, `status`, `note`, `created_at`, `created_by`) VALUES
(16, 2, 2, 'open', '', '2017-09-25 17:53:06', 1),
(17, 1, 1, 'open', '', '2017-09-25 17:53:18', 1),
(20, 1, 4, 'open', '', '2017-10-17 15:21:21', 1),
(27, 1, 5, 'accepted', 'asddjsadj asdj asdjsdj ', '2017-10-19 13:40:46', 122),
(26, 1, 5, 'open', '', '2017-10-19 13:38:37', 1),
(52, 27, 27, 'open', '', '2017-11-01 08:20:27', 1),
(53, 2, 28, 'open', '', '2017-11-02 09:46:55', 1);


--
-- Structure de la table `workflow_takers`
--
CREATE TABLE `workflow_takers` (
  `id_offre` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `takers` text NOT NULL,
  PRIMARY KEY (`id_offre`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;

--
-- Déchargement des données de la table `workflow_takers`
--
INSERT INTO `workflow_takers` (`id_offre`, `takers`) VALUES
(5, '{\"3\":[\"122\"],\"1\":[\"123\"],\"2\":[\"124\"]}');
