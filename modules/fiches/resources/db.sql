CREATE TABLE `fiches` (
    `id_fiche` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `reference` varchar(64) NOT NULL,
    `fiche_type` int(11) NOT NULL DEFAULT 0,
    `name` varchar(64) NOT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id_fiche`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE `fiche_blocks` (
    `id_block` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(64) NOT NULL,
    `fiche_type` int(11) NOT NULL DEFAULT 0,
    `fields_type` varchar(64) NOT NULL DEFAULT 'checkbox',
    `show_observations` tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id_block`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE `fiche_items` (
    `id_item` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `id_fiche` int(11) unsigned NOT NULL,
    `id_block` int(11) unsigned NOT NULL,
    `name` varchar(64) NOT NULL,
    PRIMARY KEY (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE `fiche_offre` (
    `id_fiche` int(11) unsigned NOT NULL,
    `id_offre` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE `fiche_candidature` (
    `id_fiche_candidature` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `id_candidature` int(11) unsigned NOT NULL,
    `id_evaluator` int(11) unsigned NOT NULL,
    `comments` varchar(255) DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id_fiche_candidature`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE `fiche_candidature_results` (
    `id_result` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `id_fiche_candidature` int(11) unsigned NOT NULL,
    `id_item` int(11) unsigned NOT NULL,
    `id_block` int(11) unsigned NOT NULL,
    `value` varchar(255) DEFAULT NULL,
    `observations` text DEFAULT NULL,
    PRIMARY KEY (`id_result`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;


INSERT INTO `fiches` (`id_fiche`, `reference`, `fiche_type`, `name`, `created_at`, `updated_at`) VALUES
(1, 'NMMOQXX', 0, 'Formations et expériences', '2017-11-29 17:28:20', '2017-11-30 10:17:59'),
(2, '17K0CQK', 1, 'Compétences', '2017-11-29 17:29:35', '2017-11-30 10:15:20');


INSERT INTO `fiche_blocks` (`id_block`, `name`, `fiche_type`, `fields_type`, `show_observations`) VALUES
(1, 'Diplôme', 0, 'checkbox', 0),
(2, 'Expérience professionnelle', 0, 'checkbox', 0),
(3, 'Dossier de candidature complet', 0, 'checkbox', 0),
(4, 'Compétences techniques', 1, 'number', 1),
(5, 'Compétences comportementales', 1, 'number', 1),
(6, 'Compétences managériales', 1, 'number', 1);


INSERT INTO `fiche_items` (`id_item`, `id_fiche`, `id_block`, `name`) VALUES
(1, 1, 1, 'Diplôme d’études supérieures (Bac+5) en finance'),
(2, 1, 2, 'Avec expérience professionnelle'),
(3, 1, 3, 'Curriculum vitae et lettre de motivation'),
(4, 2, 4, 'Connaissance du cadre légal et règlementaire régissant le marché'),
(5, 2, 5, 'Contrôle émotionnel'),
(6, 2, 6, 'Compréhension des organisations'),
(7, 2, 6, 'Adaptabilité'),
(8, 1, 2, 'Sans expérience professionnelle'),
(9, 2, 4, 'Connaissance du fonctionnement du marché des capitaux et des ins'),
(10, 2, 5, 'Resistance au stress'),
(11, 2, 5, 'Enthousiasme / auto motivation'),
(12, 2, 5, 'Ecoute / Empathie'),
(13, 2, 6, 'Sens de l’initiative'),
(14, 2, 6, 'Sens de l’innovation'),
(15, 1, 1, 'Actuariat'),
(16, 1, 1, 'Statistiques ou en audit délivré par une grande école d’ingénieu'),
(17, 1, 1, 'Lauréat en 2016 ou en 2017'),
(18, 1, 3, 'Copie conforme des diplômes (Bac+5), avec attestation d’équivale'),
(19, 1, 3, 'Copie conforme de la Carte Nationale d’Identité'),
(20, 1, 3, 'Copie conforme des attestations de travail ou de stages, le cas ');