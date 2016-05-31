# SQL Dump for wgbacklinks module
# PhpMyAdmin Version: 4.0.4
# http://www.phpmyadmin.net
#
# Host: localhost
# Generated on: Thu May 05, 2016 to 8:16
# Server version: 5.6.16
# PHP Version: 5.5.11

#
# Structure table for `wgbacklinks_providers` 6
#

CREATE TABLE `wgbacklinks_providers` (
  `provider_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `provider_name` VARCHAR(100) NOT NULL DEFAULT '',
  `provider_url` VARCHAR(200) NOT NULL DEFAULT '',
  `provider_key` VARCHAR(100) NOT NULL DEFAULT '',
  `provider_submitter` INT(10) NOT NULL DEFAULT '0',
  `provider_date_created` INT(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`provider_id`)
) ENGINE=InnoDB;

#
# Structure table for `wgbacklinks_sites` 9
#

CREATE TABLE `wgbacklinks_sites` (
  `site_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_name` VARCHAR(100) NOT NULL DEFAULT '',
  `site_descr` VARCHAR(500)  DEFAULT '',
  `site_url` VARCHAR(200) NULL DEFAULT '',
  `site_uniqueid` VARCHAR(100) NULL DEFAULT '',
  `site_submitter` VARCHAR(200) NULL DEFAULT '',
  `site_date_created` INT(10) NOT NULL DEFAULT '0',
  `site_active` TINYINT(1) NOT NULL DEFAULT '0',
  `site_shared` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB;

#
# Structure table for `wgbacklinks_clients` 5
#

CREATE TABLE `wgbacklinks_clients` (
  `client_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_url` VARCHAR(200) NULL DEFAULT '',
  `client_key` VARCHAR(200) NOT NULL DEFAULT '',
  `client_submitter` VARCHAR(200) NOT NULL DEFAULT '',
  `client_date_created` INT(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB;

