CREATE TABLE `language_strings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `language_string_trans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `language_string_id` int(11) unsigned NOT NULL,
  `language` varchar(4) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;