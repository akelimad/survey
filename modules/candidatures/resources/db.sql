CREATE TABLE `candidature_attachments` (
    `id_attachment` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `id_candidature` int(11) unsigned NOT NULL,
    `file_name` varchar(255) NOT NULL,
    `title` varchar(255) NULL DEFAULT NULL,
    `created_at` datetime DEFAULT NULL,
    `updated_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id_attachment`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;



ALTER TABLE `candidature` ADD `note_orale` DECIMAL(4,2) NULL DEFAULT NULL AFTER `notation`;
ALTER TABLE `candidature` ADD `note_ecrit` DECIMAL(4,2) NULL DEFAULT NULL AFTER `note_orale`;