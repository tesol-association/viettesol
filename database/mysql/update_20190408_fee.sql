ALTER TABLE `fees` DROP `amount`;
ALTER TABLE `fees` CHANGE `price_before_time` `before_time` INT(11) NOT NULL;
ALTER TABLE `fees` CHANGE `price_after_time` `after_time` INT(11) NOT NULL;
ALTER TABLE `fees` CHANGE `category` `category` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `fees` ADD `conference_id` INT(11) NOT NULL AFTER `price_after_time`;
ALTER TABLE `fees` ADD `time` DATE NOT NULL AFTER `category`;
