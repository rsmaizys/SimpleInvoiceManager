-- 
-- Sukurta duomenų struktūra lentelei `clients`
-- 

CREATE TABLE `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `invoices`
-- 

CREATE TABLE `invoices` (
  `id_invoice` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `subject` varchar(1000) DEFAULT NULL,
  `cost` varchar(10) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `id_status` varchar(1) DEFAULT '1',
  PRIMARY KEY (`id_invoice`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `status`
-- 

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Sukurta duomenų kopija lentelei `status`
-- 

INSERT INTO `status` (`id_status`, `name`, `description`) VALUES (1, 'Open', 'Active invoice, status open'),
(2, 'Closed', 'Invoice was payed, it''s closed now');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `users`
-- 

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

