/*DROP TABLE IF EXISTS `lpn_pimpampoum`;*/
CREATE TABLE IF NOT EXISTS `lpn_pimpampoum` (
`id` INT NOT NULL AUTO_INCREMENT,
`type` varchar(100) DEFAULT NULL ,
`xml` longtext,
`codeClient` varchar(20) DEFAULT NULL ,
`codePiece` varchar(20) DEFAULT NULL ,
`toEmail` varchar(100) DEFAULT NULL ,
`fromEmail` varchar(100) DEFAULT NULL ,
`file` varchar(255) DEFAULT NULL ,
`date` INT NULL ,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `users_permission_definitions` (`key`)
VALUES ('lpn_permission_settings');