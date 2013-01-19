USE `mayorresponds`;

ALTER TABLE  `users` CHANGE  `facebook_id`  `facebook_id` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
CHANGE  `twitter_user`  `twitter_user` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

ALTER TABLE  `users` ADD INDEX (  `facebook_id` );
ALTER TABLE  `users` ADD INDEX (  `twitter_user` );

ALTER TABLE  `users` ADD  `key_confirm` VARCHAR( 16 ) NULL AFTER  `confirm`;
ALTER TABLE  `users` ADD INDEX (  `key_confirm` );

ALTER TABLE  `questions` ADD  `key_confirm` VARCHAR( 16 ) NULL AFTER  `confirm`;
ALTER TABLE  `questions` ADD INDEX (  `key_confirm` );

ALTER TABLE  `questions` ADD INDEX (  `user_id` );
ALTER TABLE  `questions` ADD INDEX (  `city_id` );

ALTER TABLE  `mayors` ADD INDEX (  `city_id` );
ALTER TABLE  `mayors` ADD INDEX (  `user_id` );

ALTER TABLE  `votes` ADD  `key_confirm` VARCHAR( 16 ) NOT NULL AFTER  `confirm`;
ALTER TABLE  `votes` ADD INDEX (  `key_confirm` );