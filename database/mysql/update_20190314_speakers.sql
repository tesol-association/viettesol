ALTER TABLE `speakers` CHANGE `attach_file` `attach_file` VARCHAR(255) NOT NULL;
ALTER TABLE `speakers` ADD `conference_id` INT NOT NULL AFTER `attach_file`;
ALTER TABLE `speakers` ADD `affiliate` VARCHAR(255) NOT NULL AFTER `full_name`;
ALTER TABLE `speakers` CHANGE `attach_file` `attach_file` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;