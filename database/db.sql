DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `cities` (`id`, `name`) VALUES ('ESXX0016', 'A Coruña');
INSERT INTO `cities` (`id`, `name`) VALUES ('ESCT0001', 'Barcelona');
INSERT INTO `cities` (`id`, `name`) VALUES ('ESXX0006', 'Bilbao');
INSERT INTO `cities` (`id`, `name`) VALUES ('ESXX0656', 'Castro-Urdiales');
INSERT INTO `cities` (`id`, `name`) VALUES ('ESMX0001', 'Madrid');
INSERT INTO `cities` (`id`, `name`) VALUES ('ESXX0004', 'Sevilla');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL UNIQUE,
  `password` varchar(128),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Test', 'test@user.com', '139538af6a07e82effacafee56576239c723215da82bcbc7cac92732c3d5f2c1dec3710846e8cf591d9d2917932b8f6b3f78b5857ef605934a86cace59246f5c');