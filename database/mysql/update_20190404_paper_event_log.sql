CREATE TABLE `viettesol`.`paper_event_log` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `paper_id` INT NOT NULL ,
    `user_id` INT NOT NULL ,
    `message` VARCHAR(255) NOT NULL ,
    `type` VARCHAR(255) NOT NULL ,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
    `updated_at` TIMESTAMP NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
ALTER TABLE `paper_event_log` CHANGE `message` `message` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
