ALTER TABLE `papers` ADD `status` VARCHAR(45) NOT NULL AFTER `track_id`;
ALTER TABLE `papers` ADD `title` VARCHAR(255) NOT NULL AFTER `id`;
ALTER TABLE `paper_authors` ADD `seq` INT NOT NULL AFTER `country`;
ALTER TABLE `paper_authors` CHANGE `seq` `seq` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `session_types` CHANGE `description` `description` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;
ALTER TABLE `papers` ADD `session_type_id` INT NOT NULL AFTER `track_id`;
/* 19/03/2019 */
RENAME TABLE paper_authors to authors;
ALTER TABLE `authors` DROP `seq`;

CREATE TABLE `viettesol`.`paper_author` (
`id` INT NOT NULL AUTO_INCREMENT ,
`paper_id` INT NOT NULL ,
`author_id` INT NOT NULL ,
`seq` INT NOT NULL ,
`created_at` TIMESTAMP NULL ,
`updated_at` TIMESTAMP NULL ,
PRIMARY KEY (`id`))
ENGINE = InnoDB;

ALTER TABLE `papers` DROP `author_id`;
ALTER TABLE `papers` DROP `co_authors`;

/* 20/03/2019 */
DROP TABLE ` review_form_setting`;
ALTER TABLE `review_form` CHANGE `attach_file` `attach_file` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `criteria_review` ADD `review_form_id` INT NOT NULL AFTER `id`;
/* 21/03/2019 */
ALTER TABLE `tracks` ADD `review_form_id` INT NULL AFTER `conference_id`;

/* 27/03/2019 */
ALTER TABLE `review_assignments` CHANGE `data` `reviewer_response` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `review_assignments` ADD `total` INT NULL AFTER `cancelled`;
ALTER TABLE `review_assignments` ADD `comment` TEXT NULL AFTER `cancelled`;
ALTER TABLE `review_assignments` DROP `review_form_id`;
ALTER TABLE `papers` ADD `submission_by` INT NOT NULL AFTER `submission_progress`;

/* 31/03/2019 */
CREATE TABLE `viettesol`.`track_decisions` ( `id` INT NOT NULL AUTO_INCREMENT ,
`paper_id` INT NOT NULL ,
`track_director_id` INT NOT NULL ,
`decision` INT NOT NULL COMMENT ' \'ACCEPTED\' => 0, \'REVISION\' => 1, \'REJECTED\' => 2,' ,
`date_decided` DATETIME NOT NULL , `created_at` TIMESTAMP NULL,
`updated_at` TIMESTAMP NULL ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

/* 02/04/2019 */
CREATE TABLE `viettesol`.`user_token` ( `id` INT NOT NULL AUTO_INCREMENT ,
`user_id` INT NOT NULL ,
`token` VARCHAR(255) NOT NULL ,
`expired_time` INT NOT NULL DEFAULT '15' ,
`created_at` TIMESTAMP NULL , `updated_at` TIMESTAMP NULL ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;
/* 02/04/2019 */
ALTER TABLE `prepared_emails` CHANGE `code` `email_key` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `prepared_emails` CHANGE `code` `email_key` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `prepared_emails` CHANGE `subject` `subject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `prepared_emails` CHANGE `body` `body` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

/* 23/04/2019 */
ALTER TABLE `conference_timeline` ADD `review_deadline` DATE NOT NULL AFTER `reviewer_registration_closed`;