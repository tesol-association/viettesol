ALTER TABLE `news` CHANGE `last_update_by` `last_updated_by` INT(11) NOT NULL;
ALTER TABLE `news` CHANGE `short_content` `short_content` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `news` DROP `short_description`;
ALTER TABLE `news` ADD `created_by` INT NOT NULL AFTER `last_updated_by`, ADD `status` VARCHAR(50) NOT NULL DEFAULT 'draft' COMMENT 'Mặc định là draft, khi trạng thái là published thì sẽ hiển thị ra cho người dùng nhìn thấy.' AFTER `created_by`;
ALTER TABLE `new_categories` ADD `slug` VARCHAR(100) NOT NULL AFTER `name`;
ALTER TABLE `news` CHANGE `code` `slug` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE `events` CHANGE `code` `slug` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

CREATE TABLE IF NOT EXISTS `viettesol`.`event_registation` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `affiliation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `highest_degree` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_notify` tinyint(4) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;