CREATE TABLE `role_offre_entry` (
    `id_entry` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `id_role_offre` int(11) unsigned NOT NULL,
    `first_name` varchar(64) DEFAULT NULL,
    `last_name` varchar(64) DEFAULT NULL,
    `cin` varchar(12) DEFAULT NULL,
    `mobile` varchar(16) DEFAULT NULL,
    `attachments` text DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id_entry`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;