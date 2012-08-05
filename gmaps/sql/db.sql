CREATE TABLE IF NOT EXISTS `tbl_places` (
  `place_id` int(10) NOT NULL AUTO_INCREMENT,
  `place` varchar(160) NOT NULL,
  `description` varchar(200) NOT NULL,
  `lat` float(15,11) NOT NULL,
  `lng` float(15,11) NOT NULL,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
