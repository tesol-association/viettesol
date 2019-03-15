ALTER TABLE `conferences` CHANGE `file_id` `attach_file` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `buildings` ADD `conference_id` INT NOT NULL AFTER `abbrev`;

CREATE TABLE `conference_timeline` (
	`id` INT NOT NULL,
	`conference_id` INT NOT NULL,
	`author_registration_opened` DATE NOT NULL,
	`author_registration_closed` DATE NOT NULL,
	`submission_accepted` DATE NOT NULL,
	`submission_closed` DATE NOT NULL,
	`reviewer_registration_opened` DATE NOT NULL,
	`reviewer_registration_closed` DATE NOT NULL,
	`created_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;
ALTER TABLE `conference_timeline` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
