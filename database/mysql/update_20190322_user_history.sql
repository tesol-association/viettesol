ALTER TABLE `user_history` ADD `user_id` INT(11) NOT NULL AFTER `id`;
ALTER TABLE `user_history` ADD `user_agent` VARCHAR(255) NOT NULL AFTER `ip`;
ALTER TABLE `user_history` DROP `last_login`;
ALTER TABLE `users` ADD `last_login` TIMESTAMP NULL AFTER `remember_token`;