CREATE TABLE `viettesol`.`user_conference_roles` ( 
`id` INT NOT NULL AUTO_INCREMENT ,
 `user_id` INT NOT NULL ,
 `conference_role_id` INT NOT NULL ,
 `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
 `updated_at` TIMESTAMP NULL ,
 PRIMARY KEY (`id`)) ENGINE = InnoDB;