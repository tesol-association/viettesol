ALTER TABLE `speakers` CHANGE `attach_file` `attach_file` VARCHAR(255) NOT NULL;
ALTER TABLE `speakers` ADD `conference_id` INT NOT NULL AFTER `attach_file`;