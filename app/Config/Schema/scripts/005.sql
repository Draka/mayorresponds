USE `mayorresponds`;

ALTER TABLE  `questions` CHANGE  `actived`  `active` TINYINT( 1 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `questions` CHANGE  `active`  `active` TINYINT( 1 ) NOT NULL DEFAULT  '1';