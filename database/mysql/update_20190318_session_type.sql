CREATE TABLE IF NOT EXISTS `viettesol`.`session_types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;
ALTER TABLE `session_types` ADD `length` INT NULL AFTER `description`, ADD `abstract_length` INT NULL AFTER `length`;
ALTER TABLE `session_types` ADD `conference_id` INT NOT NULL AFTER `abstract_length`;
