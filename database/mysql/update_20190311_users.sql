ALTER TABLE `users` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;