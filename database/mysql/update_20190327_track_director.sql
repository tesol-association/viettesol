CREATE TABLE `viettesol`.`track_director` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `track_id` INT(11) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
