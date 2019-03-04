ALTER TABLE `news` CHANGE `last_update_by` `last_updated_by` INT(11) NOT NULL;
ALTER TABLE `news` CHANGE `short_content` `short_content` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `news` DROP `short_description`;
ALTER TABLE `news` ADD `created_by` INT NOT NULL AFTER `last_updated_by`, ADD `status` VARCHAR(50) NOT NULL DEFAULT 'draft' COMMENT 'Mặc định là draft, khi trạng thái là published thì sẽ hiển thị ra cho người dùng nhìn thấy.' AFTER `created_by`;
ALTER TABLE `new_categories` ADD `slug` VARCHAR(100) NOT NULL AFTER `name`;
ALTER TABLE `news` CHANGE `code` `slug` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;