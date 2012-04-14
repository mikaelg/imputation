# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.44)
# Database: Imputation
# Generation Time: 2012-04-14 16:57:04 +0200
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Addresses`;

CREATE TABLE `Addresses` (
  `idAddress` int(11) NOT NULL AUTO_INCREMENT,
  `Version` int(11) NOT NULL,
  `idPostalCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `idCountry` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latidtude` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idAddress`,`Version`),
  KEY `FK_Address_PostalCode` (`idPostalCode`),
  KEY `FK_Address_Country` (`idCountry`),
  CONSTRAINT `FK_Address_Country` FOREIGN KEY (`idCountry`) REFERENCES `Country` (`idCountry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Address_PostalCode` FOREIGN KEY (`idPostalCode`) REFERENCES `PostalCode` (`idPostalCode`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table AddressTypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AddressTypes`;

CREATE TABLE `AddressTypes` (
  `idAddressType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idAddressType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `AddressTypes` WRITE;
/*!40000 ALTER TABLE `AddressTypes` DISABLE KEYS */;

INSERT INTO `AddressTypes` (`idAddressType`, `name`, `description`)
VALUES
	(1,'Company Adres',NULL),
	(2,'Facturatie Adres',NULL);

/*!40000 ALTER TABLE `AddressTypes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Companies`;

CREATE TABLE `Companies` (
  `idCompany` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `VAT` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `handelsregister` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idCompany`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table CompanyAddresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `CompanyAddresses`;

CREATE TABLE `CompanyAddresses` (
  `idCompany` int(11) NOT NULL,
  `idAddress` int(11) NOT NULL,
  `idAddressType` int(11) NOT NULL,
  PRIMARY KEY (`idCompany`,`idAddress`,`idAddressType`),
  KEY `FK_CompanyAddress_Company` (`idCompany`),
  KEY `FK_CompanyAddress_Address` (`idAddress`),
  KEY `FK_CompanyAddress_AddressType` (`idAddressType`),
  CONSTRAINT `FK_CompanyAddress_AddressType` FOREIGN KEY (`idAddressType`) REFERENCES `AddressTypes` (`idAddressType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CompanyAddress_Address` FOREIGN KEY (`idAddress`) REFERENCES `Addresses` (`idAddress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CompanyAddress_Company` FOREIGN KEY (`idCompany`) REFERENCES `Companies` (`idCompany`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table CompanyContactInformation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `CompanyContactInformation`;

CREATE TABLE `CompanyContactInformation` (
  `idCompany` int(11) NOT NULL,
  `idContactInfoType` int(11) NOT NULL,
  `value` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idCompany`,`idContactInfoType`),
  KEY `FK_CompanyContactInformation_Company` (`idCompany`),
  KEY `FK_CompanyContactInformation_ContactInfoType` (`idContactInfoType`),
  CONSTRAINT `FK_CompanyContactInformation_Company` FOREIGN KEY (`idCompany`) REFERENCES `Companies` (`idCompany`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CompanyContactInformation_ContactInfoType` FOREIGN KEY (`idContactInfoType`) REFERENCES `ContactInfoTypes` (`idContactInfoType`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table CompanyContacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `CompanyContacts`;

CREATE TABLE `CompanyContacts` (
  `idCompany` int(11) NOT NULL,
  `idPerson` int(11) NOT NULL,
  PRIMARY KEY (`idCompany`,`idPerson`),
  KEY `Company` (`idCompany`),
  KEY `CompanyContact` (`idCompany`),
  KEY `Person` (`idPerson`),
  CONSTRAINT `FK_CompanyContacts_Person` FOREIGN KEY (`idPerson`) REFERENCES `Persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CompanyContacts_Company` FOREIGN KEY (`idCompany`) REFERENCES `Companies` (`idCompany`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table ContactInfoTypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ContactInfoTypes`;

CREATE TABLE `ContactInfoTypes` (
  `idContactInfoType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idContactInfoType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `ContactInfoTypes` WRITE;
/*!40000 ALTER TABLE `ContactInfoTypes` DISABLE KEYS */;

INSERT INTO `ContactInfoTypes` (`idContactInfoType`, `name`, `description`)
VALUES
	(1,'Tel',NULL),
	(2,'Fax',NULL),
	(3,'Email',NULL),
	(4,'Skype',NULL),
	(5,'Twitter',NULL),
	(6,'Mobile',NULL),
	(7,'Facebook',NULL),
	(8,'Flickr',NULL);

/*!40000 ALTER TABLE `ContactInfoTypes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table CostCentres
# ------------------------------------------------------------

DROP TABLE IF EXISTS `CostCentres`;

CREATE TABLE `CostCentres` (
  `idCostCentre` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `cost` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idCostCentre`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `CostCentres` WRITE;
/*!40000 ALTER TABLE `CostCentres` DISABLE KEYS */;

INSERT INTO `CostCentres` (`idCostCentre`, `code`, `name`, `description`, `cost`)
VALUES
	(1,'PMF','programming frontend',NULL,NULL),
	(2,'PBE','programming backend',NULL,NULL),
	(3,'DES','design',NULL,NULL),
	(4,'ANA','analyse',NULL,NULL),
	(5,'PRM','projectmanagement',NULL,NULL),
	(6,'MEE','meeting',NULL,NULL),
	(7,'suppo','support',NULL,NULL);

/*!40000 ALTER TABLE `CostCentres` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Country
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Country`;

CREATE TABLE `Country` (
  `idCountry` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `Country` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idCountry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `Country` WRITE;
/*!40000 ALTER TABLE `Country` DISABLE KEYS */;

INSERT INTO `Country` (`idCountry`, `Country`)
VALUES
	('BE','België'),
	('DE','Duitsland'),
	('FR','France'),
	('NL','Nederland'),
	('UK','United Kingdom');

/*!40000 ALTER TABLE `Country` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Functions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Functions`;

CREATE TABLE `Functions` (
  `idFunction` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idFunction`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table Imputations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Imputations`;

CREATE TABLE `Imputations` (
  `idImputation` int(11) NOT NULL AUTO_INCREMENT,
  `idProject` int(11) NOT NULL,
  `idCompany` int(11) NOT NULL,
  `idPerson` int(11) NOT NULL,
  `idCosCentre` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `isBillable` binary(1) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idImputation`,`idProject`,`idCompany`,`idPerson`,`idCosCentre`),
  KEY `FK_Imputation_Project` (`idProject`),
  KEY `FK_Imputation_Company` (`idCompany`),
  KEY `FK_Imputation_Person` (`idPerson`),
  KEY `FK_Imputation_CostCentre` (`idCosCentre`),
  CONSTRAINT `FK_Imputation_CostCentre` FOREIGN KEY (`idCosCentre`) REFERENCES `CostCentres` (`idCostCentre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Imputation_Company` FOREIGN KEY (`idCompany`) REFERENCES `Companies` (`idCompany`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Imputation_Person` FOREIGN KEY (`idPerson`) REFERENCES `Persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Imputation_Project` FOREIGN KEY (`idProject`) REFERENCES `Projects` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table PersonAddresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `PersonAddresses`;

CREATE TABLE `PersonAddresses` (
  `idPerson` int(11) NOT NULL,
  `idAddress` int(11) NOT NULL,
  `idAddressType` int(11) NOT NULL,
  PRIMARY KEY (`idPerson`,`idAddress`,`idAddressType`),
  KEY `FK_PersonAddress_Person` (`idPerson`),
  KEY `FK_PersonAddress_Address` (`idAddress`),
  KEY `FK_PersonAddress_AddressType` (`idAddressType`),
  CONSTRAINT `FK_PersonAddress_AddressType` FOREIGN KEY (`idAddressType`) REFERENCES `AddressTypes` (`idAddressType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_PersonAddress_Address` FOREIGN KEY (`idAddress`) REFERENCES `Addresses` (`idAddress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_PersonAddress_Person` FOREIGN KEY (`idPerson`) REFERENCES `Persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table PersonContactInformation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `PersonContactInformation`;

CREATE TABLE `PersonContactInformation` (
  `idPerson` int(11) NOT NULL,
  `idContactInfoType` int(11) NOT NULL,
  `value` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idPerson`,`idContactInfoType`),
  KEY `PersonContactInfo` (`idContactInfoType`),
  KEY `Person` (`idPerson`),
  CONSTRAINT `FK_PersonContactInformation_Person` FOREIGN KEY (`idPerson`) REFERENCES `Persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_PersonContactInformation_ContactInfoType` FOREIGN KEY (`idContactInfoType`) REFERENCES `ContactInfoTypes` (`idContactInfoType`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table Persons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Persons`;

CREATE TABLE `Persons` (
  `idPerson` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` binary(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `isEmployee` binary(1) NOT NULL,
  `idCompany` int(11) NOT NULL,
  `idFunction` int(11) DEFAULT NULL,
  `startdateEmployment` datetime DEFAULT NULL,
  `enddateEmployment` datetime DEFAULT NULL,
  PRIMARY KEY (`idPerson`),
  KEY `FK_Person_Company` (`idCompany`),
  KEY `FK_Person_Function` (`idFunction`),
  CONSTRAINT `FK_Person_Company` FOREIGN KEY (`idCompany`) REFERENCES `Companies` (`idCompany`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Person_Function` FOREIGN KEY (`idFunction`) REFERENCES `Functions` (`idFunction`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table PostalCode
# ------------------------------------------------------------

DROP TABLE IF EXISTS `PostalCode`;

CREATE TABLE `PostalCode` (
  `idPostalCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `City` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPostalCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `PostalCode` WRITE;
/*!40000 ALTER TABLE `PostalCode` DISABLE KEYS */;

INSERT INTO `PostalCode` (`idPostalCode`, `City`)
VALUES
	('1000','Brussel'),
	('2000','Antwerpen'),
	('9000','Gent'),
	('9100','Sint-Niklaas');

/*!40000 ALTER TABLE `PostalCode` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ProjectContacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ProjectContacts`;

CREATE TABLE `ProjectContacts` (
  `idProject` int(11) NOT NULL,
  `idPerson` int(11) NOT NULL,
  PRIMARY KEY (`idProject`,`idPerson`),
  KEY `Project` (`idProject`),
  KEY `PersonContact` (`idPerson`),
  CONSTRAINT `FK_ProjectContact_Person` FOREIGN KEY (`idPerson`) REFERENCES `Persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ProjectContact_Project` FOREIGN KEY (`idProject`) REFERENCES `Projects` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table Projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Projects`;

CREATE TABLE `Projects` (
  `idProject` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `startdate` datetime NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `budget` decimal(10,0) DEFAULT NULL,
  `estimatedCost` decimal(10,0) DEFAULT NULL,
  `idCompany` int(11) NOT NULL,
  `idProjectType` int(11) NOT NULL,
  `idProjectStatus` int(11) NOT NULL,
  `idParentProject` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProject`),
  KEY `idProjectType` (`idProjectType`),
  KEY `idProjectStatus` (`idProjectStatus`),
  KEY `indexIdCompany` (`idCompany`,`idProjectType`,`idProjectStatus`),
  KEY `idParentProject` (`idParentProject`),
  KEY `FK_Project_Project` (`idProject`),
  CONSTRAINT `FK_Project_ProjectSatus` FOREIGN KEY (`idProjectStatus`) REFERENCES `ProjectStatuses` (`idProjectStatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Project_ProjectType` FOREIGN KEY (`idProjectType`) REFERENCES `ProjectTypes` (`idProjectType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Project_Project` FOREIGN KEY (`idProject`) REFERENCES `Projects` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table ProjectStatuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ProjectStatuses`;

CREATE TABLE `ProjectStatuses` (
  `idProjectStatus` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idProjectStatus`),
  KEY `index2` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `ProjectStatuses` WRITE;
/*!40000 ALTER TABLE `ProjectStatuses` DISABLE KEYS */;

INSERT INTO `ProjectStatuses` (`idProjectStatus`, `name`, `description`)
VALUES
	(1,'Open',NULL),
	(2,'Closed',NULL),
	(3,'On hold',NULL);

/*!40000 ALTER TABLE `ProjectStatuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ProjectTeamMembers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ProjectTeamMembers`;

CREATE TABLE `ProjectTeamMembers` (
  `idProject` int(11) NOT NULL,
  `idPerson` int(11) NOT NULL,
  PRIMARY KEY (`idProject`,`idPerson`),
  KEY `Project` (`idProject`),
  KEY `PersonTeam` (`idPerson`),
  CONSTRAINT `FK_ProjectTeamMember_Person` FOREIGN KEY (`idPerson`) REFERENCES `Persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ProjectTeamMember_Project` FOREIGN KEY (`idProject`) REFERENCES `Projects` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table ProjectTypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ProjectTypes`;

CREATE TABLE `ProjectTypes` (
  `idProjectType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idProjectType`),
  KEY `index2` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `ProjectTypes` WRITE;
/*!40000 ALTER TABLE `ProjectTypes` DISABLE KEYS */;

INSERT INTO `ProjectTypes` (`idProjectType`, `name`, `description`)
VALUES
	(1,'Website',NULL),
	(2,'Mobile app',NULL),
	(3,'Presentation',NULL),
	(4,'Print',NULL),
	(5,'Application',NULL),
	(6,'Servermanagement',NULL),
	(7,'Analyse',NULL),
	(8,'Design',NULL);

/*!40000 ALTER TABLE `ProjectTypes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
