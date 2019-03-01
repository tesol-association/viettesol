DROP TABLE IF EXISTS categories;
-- -----------------------------------------------------
-- Table `viettesol`.`new_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`new_categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`event_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`event_categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`new_category_links`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`new_category_links` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `new_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`event_category_links`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`event_category_links` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;