SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema viettesol
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `viettesol` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
-- -----------------------------------------------------
-- Schema viettesol-old-db
-- -----------------------------------------------------
USE `viettesol` ;

-- -----------------------------------------------------
-- Table `viettesol`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`news` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NULL,
  `code` VARCHAR(255) NOT NULL,
  `tags` VARCHAR(255) NULL,
  `last_update_by` INT NOT NULL,
  `short_content` VARCHAR(45) NULL,
  `short_description` TEXT NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`events` (
  `id` INT NOT NULL,
  `cover` VARCHAR(255) NULL,
  `title` VARCHAR(255) NULL,
  `body` TEXT NULL,
  `code` VARCHAR(45) NULL,
  `start_time` DATETIME NULL,
  `end_time` DATETIME NULL,
  `venue` TEXT NULL,
  `trainer` TEXT NULL,
  `registration` INT NULL,
  `description` TEXT NULL,
  `short_content` VARCHAR(255) NULL,
  `short_description` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `body` TEXT NULL,
  `user_id` INT NULL,
  `new_id` INT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `status` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`user_history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`user_history` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ip` VARCHAR(45) NOT NULL,
  `last_login` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`partners_sponsors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`partners_sponsors` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` TEXT NULL,
  `logo` TEXT NULL,
  `type` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`banners`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`banners` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `url` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`contact_form`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`contact_form` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `message` TEXT NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`advertisements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`advertisements` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `image` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `url` VARCHAR(255) NULL,
  `description` TEXT NOT NULL,
  `created_by` INT NOT NULL,
  `parent_id` VARCHAR(45) NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`conferences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`conferences` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `slogan` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `start_time` DATE NOT NULL,
  `end_time` DATE NOT NULL,
  `venue` TEXT NOT NULL,
  `description` TEXT NULL,
  `file_id` INT NULL,
  `path` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`tracks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`tracks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  `conference_id` INT NOT NULL,
  `abbrev` VARCHAR(45) NOT NULL,
  `policy` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`fees`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`fees` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(45) NULL,
  `before_time` DATE NULL,
  `description` TEXT NULL,
  `amount` INT NULL,
  `after_time` DATE NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`speakers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`speakers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(255) NOT NULL,
  `biography` TEXT NULL,
  `image` VARCHAR(255) NULL,
  `site_url` VARCHAR(255) NULL,
  `abstract` TEXT NULL,
  `attach_file` INT NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`registration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`registration` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(255) NOT NULL,
  `organization` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `payment_file_id` INT NOT NULL,
  `affiliation` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  `user_id` INT NULL,
  `role_id` INT NULL,
  `conference_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`announcements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`announcements` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NULL,
  `conference_id` INT NOT NULL,
  `expiry_date` DATE NULL,
  `status` VARCHAR(45) NULL,
  `short_description` TEXT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`review_form`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`review_form` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `attach_file` INT NULL,
  `status` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`criteria_review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`criteria_review` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `possible_values` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`prepared_emails`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`prepared_emails` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `subject` VARCHAR(255) NULL,
  `body` TEXT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`papers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`papers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `abstract` TEXT NOT NULL,
  `full_paper` TEXT NULL,
  `file_id` INT NULL,
  `track_id` INT NOT NULL,
  `status` VARCHAR(45) NULL,
  `author_id` INT NOT NULL,
  `co_authors` TEXT NULL,
  `save` TINYINT(4) NULL DEFAULT 1,
  `submission_progress` TINYINT(4) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `date_to_archive` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`time_block`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`time_block` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  `conference_id` INT NOT NULL,
  `color` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`buildings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`buildings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `abbrev` VARCHAR(45) NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`rooms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`rooms` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `building_id` INT NOT NULL,
  `abbrev` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`special_events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`special_events` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `date` DATE NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  `conference_id` INT NOT NULL,
  `room_id` INT NULL,
  `description` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`schedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`schedule` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `paper_id` INT NOT NULL,
  `time_block_id` INT NOT NULL,
  `room_id` INT NOT NULL,
  `status` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`organization`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`organization` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `logo` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`payments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  `updated_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`review_form_setting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`review_form_setting` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `review_form_id` INT NOT NULL,
  `criteria_review_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`paper_authors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`paper_authors` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NULL,
  `middle_name` VARCHAR(255) NULL,
  `last_name` VARCHAR(255) NULL,
  `affiliation` VARCHAR(255) NULL,
  `site_url` VARCHAR(255) NULL,
  `paper_id` INT NOT NULL,
  `email` VARCHAR(255) NULL,
  `country` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`review_assignments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`review_assignments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `paper_id` INT NOT NULL,
  `reviewer_id` INT NOT NULL,
  `recommendation` TINYINT(4) NULL DEFAULT NULL,
  `date_assigned` DATETIME NULL DEFAULT NULL,
  `date_notified` DATETIME NULL DEFAULT NULL,
  `date_confirmed` DATETIME NULL DEFAULT NULL,
  `date_completed` DATETIME NULL DEFAULT NULL,
  `date_acknowledged` DATETIME NULL DEFAULT NULL,
  `date_due` DATETIME NULL DEFAULT NULL,
  `review_form_id` INT NULL,
  `review_file_id` INT NULL,
  `declined` TINYINT(4) NOT NULL DEFAULT 0,
  `replaced` TINYINT(4) NOT NULL DEFAULT 0,
  `cancelled` TINYINT(4) NOT NULL DEFAULT 0,
  `data` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`files` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `file_name` VARCHAR(255) NULL,
  `file_type` VARCHAR(255) NULL,
  `file_size` BIGINT NULL,
  `original_file_name` VARCHAR(255) NULL,
  `type` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`paper_files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`paper_files` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `paper_id` INT NULL,
  `revision` INT NULL,
  `file_name` VARCHAR(255) NULL,
  `file_type` VARCHAR(255) NULL,
  `file_size` BIGINT NULL,
  `original_file_name` VARCHAR(255) NULL,
  `type` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`conference_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`conference_role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `conference_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`conference_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`conference_roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`papal_transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`papal_transactions` (
  `id` VARCHAR(17) NOT NULL,
  `txn_type` VARCHAR(20) NULL DEFAULT NULL,
  `payer_email` VARCHAR(127) NULL DEFAULT NULL,
  `receiver_email` VARCHAR(127) NULL DEFAULT NULL,
  `item_number` VARCHAR(127) NULL DEFAULT NULL,
  `payment_date` VARCHAR(127) NULL DEFAULT NULL,
  `payer_id` VARCHAR(13) NULL DEFAULT NULL,
  `receiver_id` VARCHAR(13) NULL DEFAULT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `code` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`resources`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`resources` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`role_resource`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`role_resource` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role_id` INT NOT NULL,
  `resource_id` INT NOT NULL,
  `action` VARCHAR(45) NOT NULL,
  `allow` INT NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`issues`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`issues` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `viettesol`.`sections`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `viettesol`.`sections` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  `issue_id` INT NOT NULL,
  `abbrev` VARCHAR(45) NOT NULL,
  `policy` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
