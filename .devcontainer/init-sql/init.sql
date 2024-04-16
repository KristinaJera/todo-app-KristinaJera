-- Lägg till din exporterade SQL kod här




SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `todos`;
CREATE TABLE `todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `taskDescription` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `checked` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



INSERT INTO `todos` (`id`, `title`, `taskDescription`, `date_time`, `checked`) VALUES
(52,	'HTML',	'Hypertext Markup Language',	'2024-01-27 20:35:26',	0),
(53,	'CSS',	'Cascading Style sheets',	'2024-01-27 20:36:21',	0),
(54,	'JavaScript',	'DOM manipulation',	'2024-01-27 20:37:25',	0),
(55,	'PHP',	'Hypertext Preprocessor',	'2024-01-27 20:38:32',	0),
(56,	'Laravel',	'Artisan Console',	'2024-01-27 20:39:28',	1);

-- 2024-01-28 20:15:51


