<?php

$installer = $this;
$installer->startSetup();

$installer->run("
CREATE TABLE IF NOT EXISTS `alfresco_location` (
  `location_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_x` varchar(45) NOT NULL,
  `location_y` varchar(45) NOT NULL,
  `restaurant_name` text NOT NULL,
  `restaurant_address` text NOT NULL,
  `restaurant_phone` varchar(50) NOT NULL,
  `restaurant_email` text NOT NULL,
  `province_name` varchar(100) NOT NULL,
  `created_time` datetime,
  `update_time` datetime,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
");

$installer->endSetup();