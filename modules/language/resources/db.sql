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