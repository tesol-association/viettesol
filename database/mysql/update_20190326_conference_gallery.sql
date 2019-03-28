CREATE TABLE `viettesol`.`conference_gallery` (
`id` INT NOT NULL AUTO_INCREMENT,
`conference_id` INT NOT NULL,
`image_url` VARCHAR(255) NOT NULL,
`created_by` INT NOT NULL,
`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
`updated_at` TIMESTAMP NULL,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;
