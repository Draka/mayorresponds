USE `mayorresponds`;

CREATE TABLE IF NOT EXISTS `supports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `key_confirm` varchar(16) NOT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `browser_name` varchar(60) DEFAULT NULL,
  `browser_version` varchar(60) DEFAULT NULL,
  `os_name` varchar(60) DEFAULT NULL,
  `os_version` varchar(60) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key_confirm` (`key_confirm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  `key_confirm` varchar(16) NOT NULL,
  `vote_plus` tinyint(1) NOT NULL DEFAULT '0',
  `vote_minus` tinyint(1) NOT NULL DEFAULT '0',
  `vote_abuse` int(11) NOT NULL DEFAULT '0',
  `anonymous` tinyint(1) NOT NULL,
  `browser_name` varchar(60) DEFAULT NULL,
  `browser_version` varchar(60) DEFAULT NULL,
  `os_name` varchar(60) DEFAULT NULL,
  `os_version` varchar(60) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key_confirm` (`key_confirm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE  `votes` ADD INDEX (  `user_id` );
ALTER TABLE  `votes` ADD  `answer_id` INT UNSIGNED NOT NULL AFTER  `user_id`;
ALTER TABLE  `votes` ADD INDEX (  `answer_id` );

ALTER TABLE  `supports` ADD INDEX (  `user_id` );
ALTER TABLE  `supports` ADD INDEX (  `question_id` );

ALTER TABLE  `votes` CHANGE  `key_confirm`  `key_confirm` VARCHAR( 16 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE  `supports` CHANGE  `key_confirm`  `key_confirm` VARCHAR( 16 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;