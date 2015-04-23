
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;


####################################################################################################
###################################### SPECIES TABLES ##########################################


-- ---------------------------------------------------------------------
-- sk_kingdom
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_kingdom`;

CREATE TABLE `sk_kingdom`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_phylum
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_phylum`;

CREATE TABLE `sk_phylum`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`kingdom_id` INTEGER NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_phylum_FI_1` (`kingdom_id`),
	CONSTRAINT `sk_phylum_FK_1`
		FOREIGN KEY (`kingdom_id`)
		REFERENCES `sk_kingdom` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_class
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_class`;

CREATE TABLE `sk_class`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`phylum_id` INTEGER NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`file_name` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_class_FI_1` (`phylum_id`),
	CONSTRAINT `sk_class_FK_1`
		FOREIGN KEY (`phylum_id`)
		REFERENCES `sk_phylum` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_order
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_order`;

CREATE TABLE `sk_order`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`class_id` INTEGER NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_order_FI_1` (`class_id`),
	CONSTRAINT `sk_order_FK_1`
		FOREIGN KEY (`class_id`)
		REFERENCES `sk_class` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_family
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_family`;

CREATE TABLE `sk_family`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`order_id` INTEGER NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_family_FI_1` (`order_id`),
	CONSTRAINT `sk_family_FK_1`
		FOREIGN KEY (`order_id`)
		REFERENCES `sk_order` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_genus
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_genus`;

CREATE TABLE `sk_genus`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`family_id` INTEGER NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_genus_FI_1` (`family_id`),
	CONSTRAINT `sk_genus_FK_1`
		FOREIGN KEY (`family_id`)
		REFERENCES `sk_family` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_species
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_species`;

CREATE TABLE `sk_species`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`genus_id` INTEGER NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sk_species_FI_2` (`genus_id`),
	CONSTRAINT `sk_species_FK_2`
		FOREIGN KEY (`genus_id`)
		REFERENCES `sk_genus` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_species_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_species_translation`;

CREATE TABLE  `sk_species_translation` 
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
        `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `how_to_find` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `sk_species_translation_unique_translation` (`translatable_id`,`locale`),
        KEY `IDX_species` (`translatable_id`),
        CONSTRAINT `FK_species` 
                FOREIGN KEY (`translatable_id`) 
                REFERENCES `sk_species` (`id`) 
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ---------------------------------------------------------------------
-- sk_kingdom_vernacular
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_kingdom_vernacular`;

CREATE TABLE `sk_kingdom_vernacular`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`kingdom_id` INTEGER NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`name` VARCHAR(80) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_kingdom_vernacular_FI_1` (`kingdom_id`),
	INDEX `sk_kingdom_vernacular_FI_2` (`locale`),
	CONSTRAINT `sk_kingdom_vernacular_FK_1`
		FOREIGN KEY (`kingdom_id`)
		REFERENCES `sk_kingdom` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_phylum_vernacular
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_phylum_vernacular`;

CREATE TABLE `sk_phylum_vernacular`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`phylum_id` INTEGER NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`name` VARCHAR(80) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_phylum_vernacular_FI_1` (`phylum_id`),
	CONSTRAINT `sk_phylum_vernacular_FK_1`
		FOREIGN KEY (`phylum_id`)
		REFERENCES `sk_phylum` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_class_vernacular
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_class_vernacular`;

CREATE TABLE `sk_class_vernacular`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`class_id` INTEGER NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`name` VARCHAR(80) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_class_vernacular_FI_1` (`class_id`),
	CONSTRAINT `sk_class_vernacular_FK_1`
		FOREIGN KEY (`class_id`)
		REFERENCES `sk_class` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_order_vernacular
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_order_vernacular`;

CREATE TABLE `sk_order_vernacular`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`order_id` INTEGER NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`name` VARCHAR(80) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_order_vernacular_FI_1` (`order_id`),
	CONSTRAINT `sk_order_vernacular_FK_1`
		FOREIGN KEY (`order_id`)
		REFERENCES `sk_order` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_family_vernacular
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_family_vernacular`;

CREATE TABLE `sk_family_vernacular`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`family_id` INTEGER NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`name` VARCHAR(80) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_family_vernacular_FI_1` (`family_id`),
	CONSTRAINT `sk_family_vernacular_FK_1`
		FOREIGN KEY (`family_id`)
		REFERENCES `sk_family` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_genus_vernacular
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_genus_vernacular`;

CREATE TABLE `sk_genus_vernacular`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`genus_id` INTEGER NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`name` VARCHAR(80) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_genus_vernacular_FI_1` (`genus_id`),
	CONSTRAINT `sk_genus_vernacular_FK_1`
		FOREIGN KEY (`genus_id`)
		REFERENCES `sk_genus` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





-- ---------------------------------------------------------------------
-- sk_species_scientific_name
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_species_scientific_name`;

CREATE TABLE `sk_species_scientific_name`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`species_id` INTEGER NOT NULL,
	`aphia_id` VARCHAR(8),
	`name` VARCHAR(255),
	`author` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `sk_species_scientific_name_FI_1` (`species_id`),
	CONSTRAINT `sk_species_scientific_name_FK_1`
		FOREIGN KEY (`species_id`)
		REFERENCES `sk_species` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_vernacular
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_vernacular`;

CREATE TABLE `sk_vernacular`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(55) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_species_species_vernacular
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_species_vernacular`;

CREATE TABLE `sk_species_vernacular`
(
	`species_id` INTEGER NOT NULL,
	`vernacular_id` INTEGER NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`species_id`,`vernacular_id`,`locale`),
	INDEX `sk_species_vernacular_FI_2` (`vernacular_id`),
	CONSTRAINT `sk_species_vernacular_FK_1`
		FOREIGN KEY (`species_id`)
		REFERENCES `sk_species` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_species_vernacular_FK_2`
		FOREIGN KEY (`vernacular_id`)
		REFERENCES `sk_vernacular` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




##############################################################################################
###################################### USERS TABLES ##########################################



-- ---------------------------------------------------------------------
-- sk_email_notification_time
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_email_notification_time`;

CREATE TABLE `sk_email_notification_time`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_email_notification_time_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_email_notification_time_i18n`;

CREATE TABLE `sk_email_notification_time_i18n`
(
	`name` VARCHAR(128) NOT NULL,
	`id` INTEGER NOT NULL,
	`culture` VARCHAR(7) NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `sk_email_notification_time_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `sk_email_notification_time` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sf_guard_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user`;

CREATE TABLE  `sf_guard_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `algorithm` varchar(128) NOT NULL DEFAULT 'sha1',
  `salt` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sf_guard_user_U_1` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_username
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_username`;

CREATE TABLE  `sk_username` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fos_user_id` int(11) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `new_password_hash` varchar(255) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pagina_web` varchar(255) DEFAULT NULL,
  `sexo` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `localidade` varchar(255) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `idioma_preferido` varchar(255) DEFAULT NULL,
  `email_notification_time_id` int(4) DEFAULT '2',
  `email_message_at_once` tinyint(4) DEFAULT '1',
  `email_comment_at_once` tinyint(4) DEFAULT '1',
  `fotografia` varchar(255) DEFAULT NULL,
  `email_update` tinyint(4) DEFAULT '1',
  `facebook_uid` varchar(20) DEFAULT NULL,
  `email_hash` varchar(255) DEFAULT NULL,
  `observations` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sk_username_U_1` (`email`),
  KEY `sk_username_FI_1` (`fos_user_id`),
  KEY `fk_email_notification` (`email_notification_time_id`),
  CONSTRAINT `fk_email_notification` FOREIGN KEY (`email_notification_time_id`) REFERENCES `sk_email_notification_time` (`id`),
  CONSTRAINT `sk_username_FK_1` FOREIGN KEY (`fos_user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


####################################################################################################
######################################## SPOTS TABLES ##############################################


-- ---------------------------------------------------------------------
-- sk_continent
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_continent`;

CREATE TABLE `sk_continent`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_continent_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_continent_translation`;

CREATE TABLE `sk_continent_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `sk_continent_translation_unique_translation` (`translatable_id`,`locale`),
        KEY `IDX_continent` (`translatable_id`),
        CONSTRAINT `FK_continent` 
                FOREIGN KEY (`translatable_id`) 
                REFERENCES `sk_continent` (`id`) 
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- ---------------------------------------------------------------------
-- sk_country
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_country`;

CREATE TABLE `sk_country`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`continent_id` INTEGER NOT NULL,
	`name` VARCHAR(255),
	`fips_code` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `sk_country_FI_1` (`continent_id`),
	CONSTRAINT `sk_country_FK_1`
		FOREIGN KEY (`continent_id`)
		REFERENCES `sk_continent` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_country_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_country_translation`;


CREATE TABLE `sk_country_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
        `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`overview` TEXT,
	`geography_and_climate` TEXT,
	`entry_requirements` TEXT,
	`health_and_safety` TEXT,
	`time_zone` TEXT,
	`communications` TEXT,
	`power_and_electricity` TEXT,
	`other_informations` TEXT,
        PRIMARY KEY (`id`),
        UNIQUE KEY `sk_country_translation_unique_translation` (`translatable_id`,`locale`),
        KEY `IDX_country` (`translatable_id`),
        CONSTRAINT `FK_country` 
                FOREIGN KEY (`translatable_id`) 
                REFERENCES `sk_country` (`id`) 
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;







-- ---------------------------------------------------------------------
-- sk_country_language
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_country_language`;

-- CREATE TABLE `sk_country_language`
-- (
-- 	`country_id` INTEGER NOT NULL,
-- 	`language` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
-- 	PRIMARY KEY (`country_id`,`language`),
-- 	INDEX `sk_country_language_FI_2` (`country_id`),
-- 	CONSTRAINT `sk_country_language_FK_1`
-- 		FOREIGN KEY (`country_id`)
-- 		REFERENCES `sk_country` (`id`)
-- 		ON UPDATE CASCADE
-- 		ON DELETE CASCADE
-- ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_country_currency
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_country_currency`;

-- CREATE TABLE `sk_country_currency`
-- (
-- 	`country_id` INTEGER NOT NULL,
-- 	`currency` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
-- 	PRIMARY KEY (`country_id`,`currency`),
-- 	INDEX `sk_country_currency_FI_4` (`country_id`),
-- 	CONSTRAINT `sk_country_currency_FK_1`
-- 		FOREIGN KEY (`country_id`)
-- 		REFERENCES `sk_country` (`id`)
-- 		ON UPDATE CASCADE
-- 		ON DELETE CASCADE
-- ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_region
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_region`;

CREATE TABLE `sk_region`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`country_id` INTEGER NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_region_FI_1` (`country_id`),
	CONSTRAINT `sk_region_FK_1`
		FOREIGN KEY (`country_id`)
		REFERENCES `sk_country` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_region_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_region_translation`;

CREATE TABLE `sk_region_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `sk_region_translation_unique_translation` (`translatable_id`,`locale`),
        KEY `IDX_region` (`translatable_id`),
        CONSTRAINT `FK_region` 
                FOREIGN KEY (`translatable_id`) 
                REFERENCES `sk_region` (`id`) 
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ---------------------------------------------------------------------
-- sk_location
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_location`;

CREATE TABLE `sk_location`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`region_id` INTEGER NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sk_location_FI_1` (`region_id`),
	CONSTRAINT `sk_location_FK_1`
		FOREIGN KEY (`region_id`)
		REFERENCES `sk_region` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ---------------------------------------------------------------------
-- sk_location_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_location_translation`;

CREATE TABLE `sk_location_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`description` TEXT,
	`water_temp` TEXT,
	`suit` TEXT,
	`visibility` TEXT,
	`climate` TEXT,
	`how_to_go` TEXT,
	`extra_dive` TEXT,
        `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `sk_location_translation_unique_translation` (`translatable_id`,`locale`),
        KEY `IDX_location` (`translatable_id`),
        CONSTRAINT `FK_location` 
                FOREIGN KEY (`translatable_id`) 
                REFERENCES `sk_location` (`id`) 
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_month
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_month`;

-- CREATE TABLE `sk_month`
-- (
-- 	`id` INTEGER NOT NULL AUTO_INCREMENT,
-- 	PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_month_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_month_translation`;

-- CREATE TABLE `sk_month_translation`
-- (
--         `id` INTEGER NOT NULL AUTO_INCREMENT,
--         `translatable_id` INTEGER NOT NULL,
--         `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
--         `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
--         PRIMARY KEY (`id`),
--         UNIQUE KEY `sk_month_translation_unique_translation` (`translatable_id`,`locale`),
--         KEY `IDX_month` (`translatable_id`),
--         CONSTRAINT `FK_month` 
--                 FOREIGN KEY (`translatable_id`) 
--                 REFERENCES `sk_month` (`id`) 
--               	ON UPDATE CASCADE
-- 		ON DELETE CASCADE
-- ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- ---------------------------------------------------------------------
-- sk_location_month
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_location_month`;

-- CREATE TABLE `sk_location_month`
-- (
-- 	`location_id` INTEGER NOT NULL,
-- 	`month_id` INTEGER NOT NULL,
-- 	PRIMARY KEY (`location_id`,`month_id`),
-- 	INDEX `sk_local_mes_FI_2` (`month_id`),
-- 	CONSTRAINT `sk_local_mes_FK_1`
-- 		FOREIGN KEY (`location_id`)
-- 		REFERENCES `sk_location` (`id`)
-- 		ON UPDATE CASCADE
-- 		ON DELETE CASCADE,
-- 	CONSTRAINT `sk_local_mes_FK_2`
-- 		FOREIGN KEY (`month_id`)
-- 		REFERENCES `sk_month` (`id`)
-- 		ON UPDATE CASCADE
-- 		ON DELETE CASCADE
-- ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_spot
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_spot`;

CREATE TABLE `sk_spot`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`location_id` INTEGER NOT NULL,
	`fos_user_id` INTEGER NOT NULL,
	`max_depth` INTEGER,
	`coordinate` VARCHAR(255) NOT NULL,
	`zoom` INTEGER NOT NULL,
	`is_aproved` TINYINT(1),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sk_spot_FI_1` (`location_id`),
	INDEX `sk_spot_FI_2` (`fos_user_id`),
	CONSTRAINT `sk_spot_FK_1`
		FOREIGN KEY (`location_id`)
		REFERENCES `sk_location` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_spot_FK_2`
		FOREIGN KEY (`fos_user_id`)
		REFERENCES `fos_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_spot_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_spot_translation`;

CREATE TABLE `sk_spot_translation`
(
	
	`id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
        `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `description` TEXT,
        `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `sk_spot_translation_unique_translation` (`translatable_id`,`locale`),
        KEY `IDX_spot` (`translatable_id`),
        CONSTRAINT `FK_spot` 
                FOREIGN KEY (`translatable_id`) 
                REFERENCES `sk_spot` (`id`) 
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;







####################################################################################################
###################################### PHOTOGRAPHY TABLES ##########################################


-- ---------------------------------------------------------------------
-- sk_photo_machine_brand, old sk_maquina
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_machine_brand`;

CREATE TABLE `sk_photo_machine_brand`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





-- ---------------------------------------------------------------------
-- sk_photo_machine_model, old sk_modelo
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_machine_model`;

CREATE TABLE `sk_photo_machine_model`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`brand_id` INTEGER NOT NULL,
	`image` VARCHAR(255),
	`type` VARCHAR(255),
	`megapixels` VARCHAR(255),
	`zoom_optic` VARCHAR(255),
	`mode_exposition` VARCHAR(255),
	`mode_metering` VARCHAR(255),
	`iso` VARCHAR(255),
	`white_balance` VARCHAR(255),
	`focus_macro` VARCHAR(255),
	`lcd` VARCHAR(255),
	`memory` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `sk_modelo_FI_1` (`brand_id`),
	CONSTRAINT `sk_modelo_FK_1`
		FOREIGN KEY (`brand_id`)
		REFERENCES `sk_photo_machine_brand` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- ---------------------------------------------------------------------
-- sk_creative_commons
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_creative_commons`;

CREATE TABLE `sk_creative_commons`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`image` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_creative_commons_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_creative_commons_translation`;

CREATE TABLE `sk_creative_commons_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
	`name` VARCHAR(255),
	`url` VARCHAR(255),
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_creative_translation_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_creative_commons_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_creative_commons` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






# validação=expert, sugestão=utilizador

# 1) utilizador pode sugerir sempre a especie na fotografia
# 2) se utilizador sugerir ir para grupo de experts assinantes dos grupo em que está validada
# 3) validação disponivel em cada fotografia para 3 validações.
# 4) novo campo date_taken, 1) ir ao exif, 2) data actual, 3) utilizador indica
# 5) 

-- ---------------------------------------------------------------------
-- sk_photo
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo`;

CREATE TABLE  `sk_photo` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `model_id` int(11) DEFAULT NULL,
        `fos_user_id` int(11) NOT NULL,
        `title` varchar(255) NOT NULL,
        `image` varchar(255) NOT NULL,
        `description` text,
        `species_id` int(11) DEFAULT NULL,
        `spot_id` int(11) DEFAULT NULL,
        `creative_id` int(11) DEFAULT NULL,
        `views` int(11) DEFAULT NULL,
        `taken_at` datetime DEFAULT NULL,
        `created_at` datetime DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `sk_fotografia_FI_1` (`model_id`),
        KEY `sk_fotografia_FI_2` (`fos_user_id`),
        KEY `sk_fotografia_FI_3` (`species_id`),
        KEY `sk_fotografia_FI_4` (`spot_id`),
        KEY `sk_fotografia_FI_6` (`creative_id`),
        CONSTRAINT `sk_fotografia_FK_1` FOREIGN KEY (`model_id`) REFERENCES `sk_photo_machine_model` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
        CONSTRAINT `sk_fotografia_FK_2` FOREIGN KEY (`fos_user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `sk_fotografia_FK_3` FOREIGN KEY (`species_id`) REFERENCES `sk_species` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
        CONSTRAINT `sk_fotografia_FK_4` FOREIGN KEY (`spot_id`) REFERENCES `sk_spot` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
        CONSTRAINT `sk_fotografia_ibfk_1` FOREIGN KEY (`creative_id`) REFERENCES `sk_creative_commons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ---------------------------------------------------------------------
-- sk_photo_expert_validation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_expert_validation`;
-- 
-- 
-- CREATE TABLE  `sk_photo_expert_validation` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `photo_id` int(11) DEFAULT NULL,
--   `fos_user_id` int(11) DEFAULT NULL,
--   `quality` int(11) DEFAULT NULL,
--   `is_validated` tinyint(1) DEFAULT NULL,
--   `created_at` datetime DEFAULT NULL,
--   PRIMARY KEY (`id`),
--   KEY `sk_photo_expert_validation_FI_1` (`photo_id`),
--   KEY `sk_photo_expert_validation_FI_2` (`fos_user_id`),
--   CONSTRAINT `sk_photo_expert_validation_FK_1` FOREIGN KEY (`photo_id`) REFERENCES `sk_photo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
--   CONSTRAINT `sk_photo_expert_validation_FK_2` FOREIGN KEY (`fos_user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
-- ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- 



-- ---------------------------------------------------------------------
-- sk_photo_like
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_like`;

CREATE TABLE  `sk_photo_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `fos_user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sk_photo_like_FI_1` (`photo_id`),
  KEY `sk_photo_like_FI_2` (`fos_user_id`),
  CONSTRAINT `sk_photo_like_FK_1` FOREIGN KEY (`photo_id`) REFERENCES `sk_photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sk_photo_like_FK_2` FOREIGN KEY (`fos_user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ---------------------------------------------------------------------
-- sk_photo_species_sugestion
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_species_sugestion`;

CREATE TABLE  `sk_photo_species_sugestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `species_id` int(11) DEFAULT NULL,
  `fos_user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sk_photo_species_sugestion_FI_1` (`photo_id`),
  KEY `sk_photo_species_sugestion_FI_2` (`species_id`),
  KEY `sk_photo_species_sugestion_FI_3` (`fos_user_id`),
  CONSTRAINT `sk_photo_species_sugestion_FK_1` FOREIGN KEY (`photo_id`) REFERENCES `sk_photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sk_photo_species_sugestion_FK_2` FOREIGN KEY (`species_id`) REFERENCES `sk_species` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `sk_photo_species_sugestion_FK_3` FOREIGN KEY (`fos_user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- ---------------------------------------------------------------------
-- sk_photo_species_validation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_species_validation`;

CREATE TABLE  `sk_photo_species_validation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `species_id` int(11) DEFAULT NULL,
  `fos_user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sk_photo_species_validation_FI_1` (`photo_id`),
  KEY `sk_photo_species_validation_FI_2` (`species_id`),
  KEY `sk_photo_species_validation_FI_3` (`fos_user_id`),
  CONSTRAINT `sk_photo_species_validation_FK_1` FOREIGN KEY (`photo_id`) REFERENCES `sk_photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sk_photo_species_validation_FK_2` FOREIGN KEY (`species_id`) REFERENCES `sk_species` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `sk_photo_species_validation_FK_3` FOREIGN KEY (`fos_user_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- ---------------------------------------------------------------------
-- sk_keyword
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_keyword`;

CREATE TABLE `sk_keyword`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`keyword` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_photo_keyword
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_keyword`;

CREATE TABLE `sk_photo_keyword`
(
	`photo_id` INTEGER NOT NULL,
	`keyword_id` INTEGER NOT NULL,
	PRIMARY KEY (`photo_id`,`keyword_id`),
        INDEX `sk_photo_keyword_FI_1` (`photo_id`),
        INDEX `sk_photo_keyword_FI_2` (`keyword_id`),
	CONSTRAINT `sk_photo_keyword_FK_1`
		FOREIGN KEY (`photo_id`)
		REFERENCES `sk_photo` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_keyword_FK_2`
		FOREIGN KEY (`keyword_id`)
		REFERENCES `sk_keyword` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






####################################################################################################
###################################### PHOTO CONTEST TABLES ########################################

-- ---------------------------------------------------------------------
-- sk_photo_contest
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest`;

CREATE TABLE `sk_photo_contest`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(80),
	`logo` VARCHAR(255),
	`image` VARCHAR(255),
	`begin_at` DATETIME NOT NULL,
	`end_at` DATETIME NOT NULL,
	`is_judge` TINYINT(1) DEFAULT 0,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_photo_contest_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_translation`;


CREATE TABLE `sk_photo_contest_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
	`description` VARCHAR(255),
	`rules` VARCHAR(255),
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_photo_contest_translation_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_photo_contest_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_photo_contest` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ---------------------------------------------------------------------
-- sk_photo_contest_judge
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_judge`;

CREATE TABLE `sk_photo_contest_judge`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`contest_id` INTEGER NOT NULL,
	`fos_user_id` INTEGER NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_photo_contest_judge_FI_1` (`contest_id`),
	INDEX `sk_photo_contest_judge_FI_2` (`fos_user_id`),
	CONSTRAINT `sk_photo_contest_judge_FK_1`
		FOREIGN KEY (`contest_id`)
		REFERENCES `sk_photo_contest` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_judge_FK_2`
		FOREIGN KEY (`fos_user_id`)
		REFERENCES `fos_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- ---------------------------------------------------------------------
-- sk_photo_contest_judge_translation
-- ---------------------------------------------------------------------


DROP TABLE IF EXISTS `sk_photo_contest_judge_translation`;

CREATE TABLE `sk_photo_contest_judge_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
	`description` TEXT,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_photo_contest_judge_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_photo_contest_judge_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_photo_contest_judge` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





-- ---------------------------------------------------------------------
-- sk_photo_contest_award
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_award`;

CREATE TABLE `sk_photo_contest_award`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`contest_id` INTEGER NOT NULL,
	`image` VARCHAR(255),
	`category_id` INTEGER,
	`winner_fos_user_id` INTEGER,
	`winner_photo_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `sk_photo_contest_award_FI_1` (`contest_id`),
	INDEX `sk_photo_contest_award_FI_2` (`category_id`),
	INDEX `sk_photo_contest_award_FI_3` (`winner_fos_user_id`),
	INDEX `sk_photo_contest_award_FI_4` (`winner_photo_id`),
	CONSTRAINT `sk_photo_contest_award_FK_1`
		FOREIGN KEY (`contest_id`)
		REFERENCES `sk_photo_contest` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_award_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `sk_photo_contest_category` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_award_FK_3`
		FOREIGN KEY (`winner_fos_user_id`)
		REFERENCES `fos_user` (`id`)
		ON UPDATE SET NULL
		ON DELETE SET NULL,
	CONSTRAINT `sk_photo_contest_award_FK_4`
		FOREIGN KEY (`winner_photo_id`)
		REFERENCES `sk_photo` (`id`)
		ON UPDATE SET NULL
		ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_photo_contest_award_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_award_translation`;

CREATE TABLE `sk_photo_contest_award_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
        `name` VARCHAR(80),
	`description` TEXT,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_photo_contest_award_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_photo_contest_award_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_photo_contest_award` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





-- ---------------------------------------------------------------------
-- sk_photo_contest_judge_award
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_judge_award`;

CREATE TABLE `sk_photo_contest_judge_award`
(
	`judge_id` INTEGER NOT NULL,
	`award_id` INTEGER NOT NULL,
	PRIMARY KEY (`judge_id`,`award_id`),
	INDEX `sk_photo_contest_judge_award_FI_2` (`award_id`),
	CONSTRAINT `sk_photo_contest_judge_award_FK_1`
		FOREIGN KEY (`judge_id`)
		REFERENCES `sk_photo_contest_judge` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_judge_award_FK_2`
		FOREIGN KEY (`award_id`)
		REFERENCES `sk_photo_contest_award` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_photo_contest_category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_category`;

CREATE TABLE `sk_photo_contest_category`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`contest_id` INTEGER NOT NULL,
	`image` VARCHAR(255),
--	`photo_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `sk_photo_contest_category_FI_1` (`contest_id`),
--	INDEX `sk_photo_contest_category_FI_2` (`photo_id`),
	CONSTRAINT `sk_photo_contest_category_FK_1`
		FOREIGN KEY (`contest_id`)
		REFERENCES `sk_photo_contest` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
-- 	CONSTRAINT `sk_photo_contest_category_FK_2`
-- 		FOREIGN KEY (`photo_id`)
-- 		REFERENCES `sk_photo` (`id`)
-- 		ON UPDATE SET NULL
-- 		ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_photo_contest_category_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_category_translation`;

CREATE TABLE `sk_photo_contest_category_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
        `name` VARCHAR(80),
	`description` TEXT,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_photo_contest_category_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_photo_contest_category_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_photo_contest_category` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- ---------------------------------------------------------------------
-- sk_photo_contest_sponsor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_sponsor`;

CREATE TABLE `sk_photo_contest_sponsor`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`contest_id` INTEGER NOT NULL,
	`image` VARCHAR(255),
	`name` VARCHAR(80),
	PRIMARY KEY (`id`),
	INDEX `sk_photo_contest_sponsor_FI_1` (`contest_id`),
	CONSTRAINT `sk_photo_contest_sponsor_FK_1`
		FOREIGN KEY (`contest_id`)
		REFERENCES `sk_photo_contest` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ---------------------------------------------------------------------
-- sk_photo_contest_sponsor_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_sponsor_translation`;

CREATE TABLE `sk_photo_contest_sponsor_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
	`description` TEXT,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_photo_contest_sponsor_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_photo_contest_sponsor_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_photo_contest_sponsor` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






-- ---------------------------------------------------------------------
-- sk_photo_contest_award_sponsor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_award_sponsor`;

CREATE TABLE `sk_photo_contest_award_sponsor`
(
	`award_id` INTEGER NOT NULL,
	`sponsor_id` INTEGER NOT NULL,
	PRIMARY KEY (`award_id`,`sponsor_id`),
	INDEX `sk_photo_contest_award_sponsor_FI_2` (`sponsor_id`),
	CONSTRAINT `sk_photo_contest_award_sponsor_FK_1`
		FOREIGN KEY (`award_id`)
		REFERENCES `sk_photo_contest_award` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_award_sponsor_FK_2`
		FOREIGN KEY (`sponsor_id`)
		REFERENCES `sk_photo_contest_sponsor` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_photo_contest_category_photo
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_category_photo`;

CREATE TABLE `sk_photo_contest_category_photo`
(
	`category_id` INTEGER NOT NULL,
	`photo_id` INTEGER NOT NULL,
	PRIMARY KEY (`category_id`,`photo_id`),
	INDEX `sk_photo_contest_category_photo_FI_1` (`category_id`),
        INDEX `sk_photo_contest_category_photo_FI_2` (`photo_id`),
	CONSTRAINT `sk_photo_contest_category_photo_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `sk_photo_contest_category` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_category_photo_FK_2`
		FOREIGN KEY (`photo_id`)
		REFERENCES `sk_photo` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_photo_contest_vote
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_vote`;

CREATE TABLE `sk_photo_contest_vote`
(
	`fos_user_id` INTEGER NOT NULL,
	`category_id` INTEGER NOT NULL,
	`photo_id` INTEGER NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`fos_user_id`,`category_id`,`photo_id`),
	INDEX `sk_photo_contest_vote_FI_2` (`category_id`),
	INDEX `sk_photo_contest_vote_FI_3` (`photo_id`),
	CONSTRAINT `sk_photo_contest_vote_FK_1`
		FOREIGN KEY (`fos_user_id`)
		REFERENCES `fos_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_vote_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `sk_photo_contest_category` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_vote_FK_3`
		FOREIGN KEY (`photo_id`)
		REFERENCES `sk_photo` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_photo_contest_category_judge_votation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_category_judge_votation`;

CREATE TABLE `sk_photo_contest_category_judge_votation`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`category_id` INTEGER NOT NULL,
	`judge_id` INTEGER NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sk_photo_contest_category_judge_votation_FI_1` (`category_id`),
	INDEX `sk_photo_contest_category_judge_votation_FI_2` (`judge_id`),
	CONSTRAINT `sk_photo_contest_category_judge_votation_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `sk_photo_contest_category` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_category_judge_votation_FK_2`
		FOREIGN KEY (`judge_id`)
		REFERENCES `sk_photo_contest_judge` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_photo_contest_category_judge_photo_vote
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_photo_contest_category_judge_photo_vote`;

CREATE TABLE `sk_photo_contest_category_judge_photo_vote`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`votation_id` INTEGER NOT NULL,
	`photo_id` INTEGER NOT NULL,
	`points` INTEGER NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_photo_contest_category_judge_photo_vote_FI_1` (`votation_id`),
	INDEX `sk_photo_contest_category_judge_photo_vote_FI_2` (`photo_id`),
	CONSTRAINT `sk_photo_contest_category_judge_photo_vote_FK_1`
		FOREIGN KEY (`votation_id`)
		REFERENCES `sk_photo_contest_category_judge_votation` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_photo_contest_category_judge_photo_vote_FK_2`
		FOREIGN KEY (`photo_id`)
		REFERENCES `sk_photo` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





####################################################################################################
###################################### IDENTIFICATION TABLES #######################################



-- ---------------------------------------------------------------------
-- sk_identification_criteria_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_criteria_type`;

CREATE TABLE `sk_identification_criteria_type`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_identification_criteria_type_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_criteria_type_translation`;

CREATE TABLE `sk_identification_criteria_type_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
	`name` VARCHAR(20) NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_identification_criteria_type_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_identification_criteria_type_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_identification_criteria_type` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;







-- ---------------------------------------------------------------------
-- sk_identification_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_group`;

CREATE TABLE `sk_identification_group`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`phylum_id` INTEGER,
	`class_id` INTEGER,
	`order_id` INTEGER,
	`family_id` INTEGER,
	`genus_id` INTEGER,
	`module_id` INTEGER NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_identification_group_FI_1` (`phylum_id`),
	INDEX `sk_identification_group_FI_2` (`class_id`),
	INDEX `sk_identification_group_FI_3` (`order_id`),
	INDEX `sk_identification_group_FI_4` (`family_id`),
	INDEX `sk_identification_group_FI_5` (`genus_id`),
	INDEX `sk_identification_group_FI_6` (`module_id`),
	CONSTRAINT `sk_identification_group_FK_1`
		FOREIGN KEY (`phylum_id`)
		REFERENCES `sk_phylum` (`id`)
		ON UPDATE SET NULL
		ON DELETE SET NULL,
	CONSTRAINT `sk_identification_group_FK_2`
		FOREIGN KEY (`class_id`)
		REFERENCES `sk_class` (`id`)
		ON UPDATE SET NULL
		ON DELETE SET NULL,
	CONSTRAINT `sk_identification_group_FK_3`
		FOREIGN KEY (`order_id`)
		REFERENCES `sk_order` (`id`)
		ON UPDATE SET NULL
		ON DELETE SET NULL,
	CONSTRAINT `sk_identification_group_FK_4`
		FOREIGN KEY (`family_id`)
		REFERENCES `sk_family` (`id`)
		ON UPDATE SET NULL
		ON DELETE SET NULL,
	CONSTRAINT `sk_identification_group_FK_5`
		FOREIGN KEY (`genus_id`)
		REFERENCES `sk_genus` (`id`)
		ON UPDATE SET NULL
		ON DELETE SET NULL,
	CONSTRAINT `sk_identification_group_FK_6`
		FOREIGN KEY (`module_id`)
		REFERENCES `sk_identification_module` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_identification_criteria
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_criteria`;

CREATE TABLE `sk_identification_criteria`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`type_id` INTEGER NOT NULL,
	`order_by` VARCHAR(5),
	`is_cumulative` TINYINT(1) DEFAULT 1,
	PRIMARY KEY (`id`),
	INDEX `sk_identification_criteria_FI_1` (`type_id`),
	CONSTRAINT `sk_identification_criteria_FK_1`
		FOREIGN KEY (`type_id`)
		REFERENCES `sk_identification_criteria_type` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_identification_criteria_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_criteria_translation`;

CREATE TABLE `sk_identification_criteria_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_identification_criteria_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_identification_criteria_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_identification_criteria` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- ---------------------------------------------------------------------
-- sk_identification_criteria_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_criteria_group`;

CREATE TABLE `sk_identification_criteria_group`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`group_id` INTEGER NOT NULL,
	`criteria_id` INTEGER NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_identification_criteria_group_FI_1` (`group_id`),
	INDEX `sk_identification_criteria_group_FI_2` (`criteria_id`),
	CONSTRAINT `sk_identification_criteria_group_FK_1`
		FOREIGN KEY (`group_id`)
		REFERENCES `sk_identification_group` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_identification_criteria_group_FK_2`
		FOREIGN KEY (`criteria_id`)
		REFERENCES `sk_identification_criteria` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_identification_master
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_master`;

CREATE TABLE `sk_identification_master`
(
	`is_active` TINYINT(1) DEFAULT 0,
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_identification_master_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_master_translation`;

CREATE TABLE `sk_identification_master_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_identification_master_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_identification_master_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_identification_master` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





-- ---------------------------------------------------------------------
-- sk_identification_module
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_module`;

CREATE TABLE `sk_identification_module`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`appstore_id` VARCHAR(255),
	`googleplay_id` VARCHAR(255),
	`master_id` INTEGER NOT NULL,
	`is_active` TINYINT(1) DEFAULT 0,
	`is_enabled` TINYINT(1) DEFAULT 0,
	`is_free` TINYINT(1) DEFAULT 0,
	`image` VARCHAR(255) NOT NULL,
        `created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sk_identification_module_FI_1` (`master_id`),
	CONSTRAINT `sk_identification_module_FK_1`
		FOREIGN KEY (`master_id`)
		REFERENCES `sk_identification_master` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_identification_module_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_module_translation`;

CREATE TABLE `sk_identification_module_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_identification_module_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_identification_module_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_identification_module` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- ---------------------------------------------------------------------
-- sk_identification_module_username
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_module_username`;

CREATE TABLE `sk_identification_module_username`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`module_id` INTEGER NOT NULL,
        `fos_user_id` INTEGER NOT NULL,
	`acquisition_type` INTEGER NOT NULL,
        `acquired_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sk_identification_module_username_FI_1` (`module_id`),
	CONSTRAINT `sk_identification_module_username_FK_1`
		FOREIGN KEY (`module_id`)
		REFERENCES `sk_identification_module` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_identification_module_username_FK_2`
		FOREIGN KEY (`fos_user_id`)
		REFERENCES `fos_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;









-- ---------------------------------------------------------------------
-- sk_identification_character
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_character`;

CREATE TABLE `sk_identification_character`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`criteria_id` INTEGER NOT NULL,
	`image` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `sk_identification_character_FI_1` (`criteria_id`),
	CONSTRAINT `sk_identification_character_FK_1`
		FOREIGN KEY (`criteria_id`)
		REFERENCES `sk_identification_criteria` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- ---------------------------------------------------------------------
-- sk_identification_character_translation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_character_translation`;

CREATE TABLE `sk_identification_character_translation`
(
        `id` INTEGER NOT NULL AUTO_INCREMENT,
        `translatable_id` INTEGER NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`id`),
        UNIQUE KEY `sk_identification_character_unique_translation` (`translatable_id`,`locale`),
	CONSTRAINT `sk_identification_character_translation_FK_1`
		FOREIGN KEY (`translatable_id`)
		REFERENCES `sk_identification_character` (`id`)
              	ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- ---------------------------------------------------------------------
-- sk_identification_species_character
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_species_character`;

CREATE TABLE `sk_identification_species_character`
(
	`species_id` INTEGER NOT NULL,
	`character_id` INTEGER NOT NULL,
	PRIMARY KEY (`species_id`,`character_id`),
	INDEX `sk_identification_species_character_FI_2` (`character_id`),
	CONSTRAINT `sk_identification_species_character_FK_1`
		FOREIGN KEY (`species_id`)
		REFERENCES `sk_species` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_identification_species_character_FK_2`
		FOREIGN KEY (`character_id`)
		REFERENCES `sk_identification_character` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_identification_genus_character
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_genus_character`;

CREATE TABLE `sk_identification_genus_character`
(
	`genus_id` INTEGER NOT NULL,
	`character_id` INTEGER NOT NULL,
	PRIMARY KEY (`genus_id`,`character_id`),
	INDEX `sk_identification_genus_character_FI_2` (`character_id`),
	CONSTRAINT `sk_identification_genus_character_FK_1`
		FOREIGN KEY (`genus_id`)
		REFERENCES `sk_genus` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_identification_genus_character_FK_2`
		FOREIGN KEY (`character_id`)
		REFERENCES `sk_identification_character` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_identification_family_character
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_family_character`;

CREATE TABLE `sk_identification_family_character`
(
	`family_id` INTEGER NOT NULL,
	`character_id` INTEGER NOT NULL,
	PRIMARY KEY (`family_id`,`character_id`),
	INDEX `sk_identification_family_character_FI_2` (`character_id`),
	CONSTRAINT `sk_identification_family_character_FK_1`
		FOREIGN KEY (`family_id`)
		REFERENCES `sk_family` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_identification_family_character_FK_2`
		FOREIGN KEY (`character_id`)
		REFERENCES `sk_identification_character` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_identification_order_character
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_order_character`;

CREATE TABLE `sk_identification_order_character`
(
	`order_id` INTEGER NOT NULL,
	`character_id` INTEGER NOT NULL,
	PRIMARY KEY (`order_id`,`character_id`),
	INDEX `sk_identification_order_character_FI_2` (`character_id`),
	CONSTRAINT `sk_identification_order_character_FK_1`
		FOREIGN KEY (`order_id`)
		REFERENCES `sk_order` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_identification_order_character_FK_2`
		FOREIGN KEY (`character_id`)
		REFERENCES `sk_identification_character` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_identification_class_character
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_class_character`;

CREATE TABLE `sk_identification_class_character`
(
	`class_id` INTEGER NOT NULL,
	`character_id` INTEGER NOT NULL,
	PRIMARY KEY (`class_id`,`character_id`),
	INDEX `sk_identification_class_character_FI_1` (`class_id`),
        INDEX `sk_identification_class_character_FI_2` (`character_id`),
	CONSTRAINT `sk_identification_class_character_FK_1`
		FOREIGN KEY (`class_id`)
		REFERENCES `sk_class` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_identification_class_character_FK_2`
		FOREIGN KEY (`character_id`)
		REFERENCES `sk_identification_character` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_identification_phylum_character
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_identification_phylum_character`;

CREATE TABLE `sk_identification_phylum_character`
(
	`phylum_id` INTEGER NOT NULL,
	`character_id` INTEGER NOT NULL,
	PRIMARY KEY (`phylum_id`,`character_id`),
	INDEX `sk_identification_phylum_character_FI_2` (`character_id`),
	CONSTRAINT `sk_identification_phylum_character_FK_1`
		FOREIGN KEY (`phylum_id`)
		REFERENCES `sk_phylum` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `sk_identification_phylum_character_FK_2`
		FOREIGN KEY (`character_id`)
		REFERENCES `sk_identification_character` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ---------------------------------------------------------------------
-- sk_especie_image_ref
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sk_species_image_ref`;

CREATE TABLE `sk_species_image_ref`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`species_id` INTEGER NOT NULL,
	`is_active` TINYINT(1) DEFAULT 1 NOT NULL,
	`is_primary` TINYINT(1) DEFAULT 0 NOT NULL,
	`image_url` TEXT,
	`image_src` TEXT,
	PRIMARY KEY (`id`),
	INDEX `sk_species_image_ref_FI_1` (`species_id`),
	CONSTRAINT `sk_species_image_ref_FK_1`
		FOREIGN KEY (`species_id`)
		REFERENCES `sk_species` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;







################################################################################################
###################################### SPECIES TABLES ##########################################
-- 
-- INSERT INTO skaphandrus4.sk_kingdom (id, name) SELECT id, designacao FROM skaphandrus3.sk_reino;
-- INSERT INTO skaphandrus4.sk_phylum (id, kingdom_id, name) SELECT id, reino_id, designacao FROM skaphandrus3.sk_filo;
-- INSERT INTO skaphandrus4.sk_class (id, phylum_id, name) SELECT id, filo_id, designacao FROM skaphandrus3.sk_classe;
-- INSERT INTO skaphandrus4.sk_order (id, class_id, name) SELECT id, classe_id, designacao FROM skaphandrus3.sk_ordem;
-- INSERT INTO skaphandrus4.sk_family (id, order_id, name) SELECT id, ordem_id, designacao FROM skaphandrus3.sk_familia;
-- INSERT INTO skaphandrus4.sk_genus (id, family_id, name) SELECT id, familia_id, designacao FROM skaphandrus3.sk_genero;
-- INSERT INTO skaphandrus4.sk_species (id, genus_id) SELECT id, genero_id FROM skaphandrus3.sk_especie;
-- INSERT INTO skaphandrus4.sk_species_translation (translatable_id, description, how_to_find, locale) SELECT id, descricao, how_to_find, culture FROM skaphandrus3.sk_especie_i18n;
-- INSERT INTO skaphandrus4.sk_kingdom_vernacular (kingdom_id, locale, name) SELECT sk_kingdom_vernacular.kingdom_id, sk_lingua.nome, sk_kingdom_vernacular.name FROM skaphandrus3.sk_kingdom_vernacular,skaphandrus3.sk_lingua WHERE sk_kingdom_vernacular.language_id=sk_lingua.id;
-- INSERT INTO skaphandrus4.sk_phylum_vernacular (phylum_id, locale, name) SELECT sk_phylum_vernacular.phylum_id, sk_lingua.nome, sk_phylum_vernacular.name FROM skaphandrus3.sk_phylum_vernacular,skaphandrus3.sk_lingua WHERE sk_phylum_vernacular.language_id=sk_lingua.id;
-- INSERT INTO skaphandrus4.sk_class_vernacular (class_id, locale, name) SELECT sk_class_vernacular.class_id, sk_lingua.nome, sk_class_vernacular.name FROM skaphandrus3.sk_class_vernacular,skaphandrus3.sk_lingua WHERE sk_class_vernacular.language_id=sk_lingua.id;
-- INSERT INTO skaphandrus4.sk_order_vernacular (order_id, locale, name) SELECT sk_order_vernacular.order_id, sk_lingua.nome, sk_order_vernacular.name FROM skaphandrus3.sk_order_vernacular,skaphandrus3.sk_lingua WHERE sk_order_vernacular.language_id=sk_lingua.id;
-- INSERT INTO skaphandrus4.sk_family_vernacular (family_id, locale, name) SELECT sk_family_vernacular.family_id, sk_lingua.nome, sk_family_vernacular.name FROM skaphandrus3.sk_family_vernacular,skaphandrus3.sk_lingua WHERE sk_family_vernacular.language_id=sk_lingua.id;
-- INSERT INTO skaphandrus4.sk_genus_vernacular (genus_id, locale, name) SELECT sk_genus_vernacular.genus_id, sk_lingua.nome, sk_genus_vernacular.name FROM skaphandrus3.sk_genus_vernacular,skaphandrus3.sk_lingua WHERE sk_genus_vernacular.language_id=sk_lingua.id;
-- INSERT INTO skaphandrus4.sk_species_scientific_name (species_id, aphia_id, name, author) SELECT especie_id, aphia_id, designacao, autor FROM skaphandrus3.sk_especie_designacao;
-- INSERT INTO skaphandrus4.sk_vernacular (id, name) SELECT id, name FROM skaphandrus3.sk_species_vernacular;
-- INSERT INTO skaphandrus4.sk_species_vernacular (species_id, vernacular_id, locale) SELECT sk_species_species_vernacular.species_id, sk_species_species_vernacular.vernacular_id, sk_lingua.nome FROM skaphandrus3.sk_species_species_vernacular,skaphandrus3.sk_lingua WHERE sk_species_species_vernacular.language_id=sk_lingua.id;
-- 
-- 
-- 
-- ####################################################################################################
-- ######################################## SPOTS TABLES ##############################################
-- 
-- INSERT INTO skaphandrus4.sk_continent (id) SELECT id FROM skaphandrus3.sk_continente;
-- INSERT INTO skaphandrus4.sk_continent_translation (translatable_id, name, locale) SELECT id, nome, culture FROM skaphandrus3.sk_continente_i18n;
-- INSERT INTO skaphandrus4.sk_country (id, continent_id, name, fips_code) SELECT id, continente_id, nome, fips_code FROM skaphandrus3.sk_pais;
-- INSERT INTO skaphandrus4.sk_country_translation (translatable_id, locale, overview,geography_and_climate,entry_requirements, health_and_safety,time_zone,  communications, power_and_electricity,  other_informations ) SELECT id, culture,  overview,geography_and_climate,entry_requirements, health_and_safety,time_zone,  communications, power_and_electricity,  other_informations FROM skaphandrus3.sk_pais_i18n;
-- INSERT INTO skaphandrus4.sk_region (id, country_id) SELECT id, pais_id FROM skaphandrus3.sk_zona;
-- INSERT INTO skaphandrus4.sk_region_translation (translatable_id, name, locale) SELECT id, nome, culture FROM skaphandrus3.sk_zona_i18n;
-- INSERT INTO skaphandrus4.sk_location (id, region_id) SELECT id, zona_id FROM skaphandrus3.sk_local;
-- INSERT INTO skaphandrus4.sk_location_translation (translatable_id, name, locale, description, water_temp, suit, visibility, climate, how_to_go, extra_dive) SELECT id, nome, culture, descricao, temp_agua, fato, visibilidade, clima, como_chegar, extra_mergulho FROM skaphandrus3.sk_local_i18n;
-- INSERT INTO skaphandrus4.sk_spot (id, location_id, fos_user_id, max_depth, coordinate, zoom, is_aproved, created_at, updated_at) SELECT id, local_id, username_id, profundidade_maxima, coordenada, zoom, aprovado, created_at, updated_at FROM skaphandrus3.sk_spot;
-- INSERT INTO skaphandrus4.sk_spot_translation (translatable_id, name, description, locale) SELECT id, nome, descricao, culture FROM skaphandrus3.sk_spot_i18n;
-- 
-- 
-- --INSERT INTO skaphandrus4.sk_month (id) SELECT id FROM skaphandrus3.sk_mes;
-- --INSERT INTO skaphandrus4.sk_month_translation (translatable_id, name, locale) SELECT id, nome, culture FROM skaphandrus3.sk_mes_i18n;
-- --INSERT INTO skaphandrus4.sk_country_language(country_id, language) select pais_id, sk_lingua.nome from skaphandrus3.sk_pais_lingua, skaphandrus3.sk_lingua where sk_pais_lingua.lingua_id = sk_lingua.id;
-- --INSERT INTO skaphandrus4.sk_country_currency(country_id, currency) select pais_id, sk_moeda.nome from skaphandrus3.sk_pais_moeda, skaphandrus3.sk_moeda where sk_pais_moeda.moeda_id = sk_moeda.id;
-- --INSERT INTO skaphandrus4.sk_location_month (location_id, month_id) SELECT local_id, mes_id FROM skaphandrus3.sk_local_mes;
-- 
-- ###############################################################################################
-- ######################################  USERS TABLES ##########################################
-- 
-- INSERT INTO skaphandrus4.sk_email_notification_time SELECT * FROM skaphandrus3.sk_email_notification_time;
-- INSERT INTO skaphandrus4.sk_email_notification_time_i18n SELECT * FROM skaphandrus3.sk_email_notification_time_i18n;
-- INSERT INTO skaphandrus4.sf_guard_user SELECT * FROM skaphandrus3.sf_guard_user;
-- --INSERT INTO skaphandrus4.fos_user SELECT * FROM skaphandrus3.sk_username;
-- 
-- 
-- 
-- ####################################################################################################
-- ###################################### PHOTOGRAPHY TABLES ##########################################
-- 
-- INSERT INTO skaphandrus4.sk_photo_machine_brand (id, name) SELECT id, marca FROM skaphandrus3.sk_maquina;
-- INSERT INTO skaphandrus4.sk_photo_machine_model (id, name, brand_id, image, type, megapixels, zoom_optic, mode_exposition, mode_metering, iso, white_balance, focus_macro, lcd, memory) SELECT id, nome, maquina_id, fotografia, tipo_camera, megapixels, zoom_optico, modos_exposicao, modos_metering, iso, balanco_brancos, alcance_focus_macro, tamanho_lcd, armazenamento FROM skaphandrus3.sk_modelo;
-- INSERT INTO skaphandrus4.sk_creative_commons (id, image) SELECT id, imagem FROM skaphandrus3.sk_creative_commons;
-- INSERT INTO skaphandrus4.sk_creative_commons_translation (translatable_id, name, url, locale) SELECT id, nome, url, culture FROM skaphandrus3.sk_creative_commons_i18n;
-- INSERT INTO skaphandrus4.sk_photo (id, model_id, fos_user_id, title, image, description, species_id, spot_id, creative_id, views, created_at  ) SELECT id, modelo_id, username_id, nome, imagem, descricao, especie_id, spot_id, creative_id, views, created_at  FROM skaphandrus3.sk_fotografia;
-- INSERT INTO skaphandrus4.sk_photo_species_validation (photo_id, species_id, fos_user_id, rating ) SELECT id, especie_id, expert_id, quality_status FROM skaphandrus3.sk_fotografia;
-- INSERT INTO skaphandrus4.sk_keyword SELECT * FROM skaphandrus3.sk_keyword;
-- INSERT INTO skaphandrus4.sk_photo_keyword (photo_id, keyword_id) SELECT fotografia_id, keyword_id FROM skaphandrus3.sk_fotografia_keyword;
-- 
-- 
-- ######################################################################################################
-- ###################################### PHOTO CONTEST TABLES ##########################################
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest (id, name, logo, image, begin_at, end_at, is_judge, created_at) SELECT id, name, logo, image, begin_at, end_at, is_judge, created_at FROM skaphandrus3.sk_photo_contest;
-- INSERT INTO skaphandrus4.sk_photo_contest_translation (translatable_id, description,rules, locale) SELECT id, description, rules, culture FROM skaphandrus3.sk_photo_contest_i18n;
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest_judge (id, contest_id, fos_user_id) SELECT id, contest_id, username_id FROM skaphandrus3.sk_photo_contest_judge;
-- INSERT INTO skaphandrus4.sk_photo_contest_judge_translation (translatable_id, description, locale) SELECT id, description, culture FROM skaphandrus3.sk_photo_contest_judge_i18n;
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest_award (id, contest_id, image, category_id, winner_fos_user_id, winner_photo_id) SELECT id, contest_id, image, category_id, winner_username_id, winner_fotografia_id FROM skaphandrus3.sk_photo_contest_award;
-- INSERT INTO skaphandrus4.sk_photo_contest_award_translation (translatable_id, name, description, locale) SELECT id, name, description, culture FROM skaphandrus3.sk_photo_contest_award_i18n;
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest_judge_award (judge_id, award_id) SELECT judge_id, award_id FROM skaphandrus3.sk_photo_contest_judge_award;
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest_category (id, contest_id, image ) SELECT id, contest_id, image FROM skaphandrus3.sk_photo_contest_category;
-- INSERT INTO skaphandrus4.sk_photo_contest_category_translation (translatable_id, name, description, locale) SELECT id, name, description, culture FROM skaphandrus3.sk_photo_contest_category_i18n;
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest_sponsor (id, contest_id, image, name) SELECT id, contest_id, image, name FROM skaphandrus3.sk_photo_contest_sponsor;
-- INSERT INTO skaphandrus4.sk_photo_contest_sponsor_translation (translatable_id, description, locale) SELECT id, description, culture FROM skaphandrus3.sk_photo_contest_sponsor_i18n;
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest_award_sponsor (award_id, sponsor_id) SELECT award_id, sponsor_id FROM skaphandrus3.sk_photo_contest_award_sponsor;
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest_category_photo (category_id, photo_id) SELECT category_id, fotografia_id FROM skaphandrus3.sk_photo_contest_category_fotografia;
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest_vote (fos_user_id, category_id, photo_id, created_at) SELECT username_id, category_id, fotografia_id, created_at FROM skaphandrus3.sk_photo_contest_vote;
-- 
-- INSERT INTO skaphandrus4.sk_photo_contest_category_judge_votation (id, category_id, judge_id, created_at, updated_at) SELECT id, category_id, judge_id, created_at, updated_at FROM skaphandrus3.sk_photo_contest_category_judge_votation;
-- INSERT INTO skaphandrus4.sk_photo_contest_category_judge_photo_vote (id, votation_id, photo_id, points) SELECT id, votation_id, fotografia_id, points FROM skaphandrus3.sk_photo_contest_category_judge_photo_vote;
-- 
-- 
-- 
-- ####################################################################################################
-- ###################################### IDENTIFICATION TABLES #######################################
-- 
-- INSERT INTO skaphandrus4.sk_identification_criteria_type (id) SELECT id FROM skaphandrus3.sk_identification_criteria_type;
-- INSERT INTO skaphandrus4.sk_identification_criteria_type_translation (translatable_id, name, locale) SELECT id, name, culture FROM skaphandrus3.sk_identification_criteria_type_i18n;
-- INSERT INTO skaphandrus4.sk_identification_group (id, phylum_id, class_id, order_id, family_id, genus_id, module_id) SELECT id, phylum_id, class_id, order_id, family_id, genus_id, module_id FROM skaphandrus3.sk_identification_group;
-- INSERT INTO skaphandrus4.sk_identification_criteria (id, type_id, order_by, is_cumulative ) SELECT id, type_id, order_by, is_cumulative FROM skaphandrus3.sk_identification_criteria;
-- INSERT INTO skaphandrus4.sk_identification_criteria_translation (translatable_id, name, locale) SELECT id, name, culture FROM skaphandrus3.sk_identification_criteria_i18n;
-- INSERT INTO skaphandrus4.sk_identification_criteria_group (id, group_id, criteria_id) SELECT id, group_id, criteria_id FROM skaphandrus3.sk_identification_criteria_group;
-- INSERT INTO skaphandrus4.sk_identification_master (id, is_active) SELECT id, is_active FROM skaphandrus3.sk_identification_master;
-- INSERT INTO skaphandrus4.sk_identification_master_translation (translatable_id, name, locale) SELECT id, name, culture FROM skaphandrus3.sk_identification_master_i18n;
-- INSERT INTO skaphandrus4.sk_identification_module (id, appstore_id, googleplay_id, master_id, is_active, is_enabled, image) SELECT id, appstore_id, googleplay_id, master_id, is_active, is_enabled, image_enabled FROM skaphandrus3.sk_identification_module;
-- INSERT INTO skaphandrus4.sk_identification_module_translation (translatable_id, name, locale) SELECT id, name, culture FROM skaphandrus3.sk_identification_module_i18n;
-- INSERT INTO skaphandrus4.sk_identification_character (id, criteria_id, image) SELECT id, criteria_id, image FROM skaphandrus3.sk_identification_character;
-- INSERT INTO skaphandrus4.sk_identification_character_translation (translatable_id, name, locale) SELECT id, name, culture FROM skaphandrus3.sk_identification_character_i18n;
-- INSERT INTO skaphandrus4.sk_identification_species_character (species_id, character_id) SELECT species_id, character_id FROM skaphandrus3.sk_identification_species_character;
-- INSERT INTO skaphandrus4.sk_identification_genus_character (genus_id, character_id) SELECT genus_id, character_id FROM skaphandrus3.sk_identification_genus_character;
-- INSERT INTO skaphandrus4.sk_identification_family_character (family_id, character_id) SELECT family_id, character_id FROM skaphandrus3.sk_identification_family_character;
-- INSERT INTO skaphandrus4.sk_identification_order_character (order_id, character_id) SELECT order_id, character_id FROM skaphandrus3.sk_identification_order_character;
-- INSERT INTO skaphandrus4.sk_identification_class_character (class_id, character_id) SELECT class_id, character_id FROM skaphandrus3.sk_identification_class_character;
-- INSERT INTO skaphandrus4.sk_identification_phylum_character (phylum_id, character_id) SELECT phylum_id, character_id FROM skaphandrus3.sk_identification_phylum_character;
-- 
-- INSERT INTO skaphandrus4.sk_species_image_ref (id, species_id, is_active, is_primary, image_url, image_src) SELECT id, especie_id, is_active, is_primary, image_url, image_src FROM skaphandrus3.sk_especie_image_ref;
-- 
-- 
-- 
-- 
-- # This restores the fkey checks, after having unset them earlier
-- SET FOREIGN_KEY_CHECKS = 1;
