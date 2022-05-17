ALTER TABLE `usuarios` ADD `edificio` TEXT NOT NULL AFTER `estado`, ADD `cuil` INT(11) NOT NULL AFTER `edificio`, ADD `interno` INT(11) NOT NULL AFTER `cuil`, ADD `contratacion` TEXT NOT NULL AFTER `interno`, ADD `tng` TEXT NOT NULL AFTER `contratacion`, ADD `obs` TEXT NOT NULL AFTER `tng`;

ALTER TABLE `dedicacion` CHANGE `obs` `obs` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

CREATE TABLE `gestion`.`temas` ( `id_tema` INT NOT NULL AUTO_INCREMENT , `nombre` TEXT NOT NULL , PRIMARY KEY (`id_tema`)) ENGINE = InnoDB;

INSERT INTO `temas` (`id_tema`, `nombre`) VALUES (NULL, 'tema 1'), (NULL, 'tema 2');

ALTER TABLE `proyectos` ADD `acta` TEXT NOT NULL AFTER `acta`;


-- cambios al 16/5 