-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('1','2') NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `urlname` varchar(255) NOT NULL,
  `registered` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `name`, `about`, `email`, `password`, `level`, `active`, `urlname`, `registered`) VALUES
(1,	'DNS Progress',	'Its about me.',	'dani@dnsprogress.com',	'c14bcebc5b4cd0c7fce90c3806188619',	'1',	'Y',	'dns-progress',	'2018-11-05 19:50:00');

-- 2018-11-06 01:18:39
