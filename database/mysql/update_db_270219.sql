ALTER TABLE `users` ADD `is_admin` INT NOT NULL DEFAULT '0' AFTER `initals`;
-- -----------------------------------------------------
-- Table `viettesol`.`contacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`contacts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `middle_name` VARCHAR(45) NULL,
  `organize_name` VARCHAR(45) NULL,
  `address` VARCHAR(255) NULL,
  `email` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `fax` VARCHAR(45) NULL,
  `country` VARCHAR(255) NOT NULL,
  `website` VARCHAR(255) NULL,
  `note` TEXT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`contact_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`contact_type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`membership`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`membership` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `contact_id` INT NOT NULL,
  `join_date` DATE NULL,
  `start_date` DATE NULL,
  `end_date` DATE NULL,
  `num_of_term` INT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`payment_method`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`payment_method` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`member_payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`member_payment` (
  `id` INT NOT NULL,
  `member_id` INT NOT NULL,
  `amount` FLOAT NOT NULL,
  `unit` VARCHAR(45) NOT NULL,
  `received` DATETIME NOT NULL,
  `paied_for` VARCHAR(255) NOT NULL,
  `transaction_id` VARCHAR(255) NULL,
  `payment_method_id` INT NOT NULL,
  `status` VARCHAR(45) NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`contributions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`contributions` (
  `id` INT NOT NULL,
  `contact_id` INT NOT NULL,
  `amount` FLOAT NOT NULL,
  `unit` VARCHAR(45) NOT NULL,
  `received` DATETIME NOT NULL,
  `payment_method_id` INT NOT NULL,
  `status` VARCHAR(45) NOT NULL,
  `transaction_id` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`notifications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`notifications` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NULL,
  `sender_id` INT NOT NULL,
  `user_id` VARCHAR(45) NOT NULL,
  `status` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;