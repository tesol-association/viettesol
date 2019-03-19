ALTER TABLE `papers` ADD `title` VARCHAR(255) NOT NULL AFTER `id`;
ALTER TABLE `paper_authors` ADD `seq` INT NOT NULL AFTER `country`;
ALTER TABLE `paper_authors` CHANGE `seq` `seq` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `session_types` CHANGE `description` `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;
