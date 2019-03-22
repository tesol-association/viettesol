CREATE TABLE IF NOT EXISTS `viettesol`.`conference_partners_sponsers` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET armscii8 NOT NULL,
  `description` text CHARACTER SET armscii8,
  `logo` text CHARACTER SET armscii8 NOT NULL,
  `type` varchar(45) CHARACTER SET armscii8 NOT NULL,
  `conference_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `conference_partners_sponsers`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `conference_partners_sponsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
