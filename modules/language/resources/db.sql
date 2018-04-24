CREATE TABLE `languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `iso_code` varchar(4) NOT NULL,
  `short_name` varchar(10) NOT NULL,
  `direction` tinyint(1) NOT NULL DEFAULT 0,
  `date_format` varchar(10) NOT NULL,
  `datetime_format` varchar(12) NOT NULL,
  `default_lang` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 CHARACTER SET utf8 COLLATE utf8_general_ci;

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


INSERT INTO `languages` (`id`, `name`, `code`, `iso_code`, `short_name`, `direction`, `date_format`, `datetime_format`, `default_lang`, `active`) VALUES
(1, 'Français', 'fr_FR', 'fr', 'FR', 0, 'd.m.Y', 'd.m.Y H:i:s', 1, 1),
(2, 'English', 'en_US', 'en', 'EN', 0, 'Y-m-d', 'Y-m-d H:i:s', 0, 1),
(3, 'اللغة العربية ', 'ar_AR', 'ar', 'AR', 1, 'd.m.Y', 'd.m.Y H:i:s', 0, 0),
(4, 'Español', 'es_ES', 'es', 'ES', 0, 'd.m.Y', 'd.m.Y H:i:s', 0, 0);