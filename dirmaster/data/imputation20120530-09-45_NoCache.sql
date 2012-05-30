# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.44)
# Database: imputation
# Generation Time: 2012-05-30 09:45:55 +0200
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
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
  CONSTRAINT `FK_Address_Country` FOREIGN KEY (`idCountry`) REFERENCES `country` (`idCountry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Address_PostalCode` FOREIGN KEY (`idPostalCode`) REFERENCES `postalcode` (`idPostalCode`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;

INSERT INTO `addresses` (`idAddress`, `Version`, `idPostalCode`, `idCountry`, `address`, `longitude`, `latidtude`)
VALUES
	(1,1,'9000','BE','Dok Noord 5',NULL,NULL),
	(2,1,'9000','BE','Voskenslaan 6',NULL,NULL),
	(3,1,'9000','BE','Koepoortbrug 366',NULL,NULL);

/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table addresstypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addresstypes`;

CREATE TABLE `addresstypes` (
  `idAddressType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idAddressType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `addresstypes` WRITE;
/*!40000 ALTER TABLE `addresstypes` DISABLE KEYS */;

INSERT INTO `addresstypes` (`idAddressType`, `name`, `description`)
VALUES
	(1,'Company Adres',NULL),
	(2,'Facturatie Adres',NULL);

/*!40000 ALTER TABLE `addresstypes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table companies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `idCompany` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `VAT` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idCompany`),
  UNIQUE KEY `VAT_UNIQUE` (`VAT`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;

INSERT INTO `companies` (`idCompany`, `name`, `description`, `VAT`)
VALUES
	(1,'Imputation BVBA','Dit is het fictieve bedrijf waarvoor we werken','BE0433.270.195'),
	(2,'ACME ','Dit is een heel belangrijke klant','BE0345.678.901'),
	(3,'Detectievebureau Janssen en Janssen ','Dit is ook een heel belangrijke klant','BE0345.876.91');

/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table companyaddresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companyaddresses`;

CREATE TABLE `companyaddresses` (
  `idCompany` int(11) NOT NULL,
  `idAddress` int(11) NOT NULL,
  `idAddressType` int(11) NOT NULL,
  PRIMARY KEY (`idCompany`,`idAddress`,`idAddressType`),
  KEY `FK_CompanyAddress_Company` (`idCompany`),
  KEY `FK_CompanyAddress_Address` (`idAddress`),
  KEY `FK_CompanyAddress_AddressType` (`idAddressType`),
  CONSTRAINT `FK_CompanyAddress_Address` FOREIGN KEY (`idAddress`) REFERENCES `addresses` (`idAddress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CompanyAddress_AddressType` FOREIGN KEY (`idAddressType`) REFERENCES `addresstypes` (`idAddressType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CompanyAddress_Company` FOREIGN KEY (`idCompany`) REFERENCES `companies` (`idCompany`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `companyaddresses` WRITE;
/*!40000 ALTER TABLE `companyaddresses` DISABLE KEYS */;

INSERT INTO `companyaddresses` (`idCompany`, `idAddress`, `idAddressType`)
VALUES
	(1,1,1),
	(2,2,2),
	(3,3,2);

/*!40000 ALTER TABLE `companyaddresses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table companycontactinformation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companycontactinformation`;

CREATE TABLE `companycontactinformation` (
  `idCompany` int(11) NOT NULL,
  `idContactInfoType` int(11) NOT NULL,
  `value` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idCompany`,`idContactInfoType`),
  KEY `FK_CompanyContactInformation_Company` (`idCompany`),
  KEY `FK_CompanyContactInformation_ContactInfoType` (`idContactInfoType`),
  CONSTRAINT `FK_CompanyContactInformation_Company` FOREIGN KEY (`idCompany`) REFERENCES `companies` (`idCompany`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CompanyContactInformation_ContactInfoType` FOREIGN KEY (`idContactInfoType`) REFERENCES `contactinfotypes` (`idContactInfoType`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table companycontacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companycontacts`;

CREATE TABLE `companycontacts` (
  `idCompany` int(11) NOT NULL,
  `idPerson` int(11) NOT NULL,
  PRIMARY KEY (`idCompany`,`idPerson`),
  KEY `Company` (`idCompany`),
  KEY `CompanyContact` (`idCompany`),
  KEY `Person` (`idPerson`),
  CONSTRAINT `FK_CompanyContacts_Company` FOREIGN KEY (`idCompany`) REFERENCES `companies` (`idCompany`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CompanyContacts_Person` FOREIGN KEY (`idPerson`) REFERENCES `persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table companyperson
# ------------------------------------------------------------

DROP TABLE IF EXISTS `companyperson`;

CREATE TABLE `companyperson` (
  `idCompany` int(11) NOT NULL,
  `idPerson` int(11) NOT NULL,
  `idFunction` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCompany`,`idPerson`),
  KEY `FK_CompanyPerson_Person` (`idCompany`),
  KEY `FK_CompanyPerson_Company` (`idCompany`),
  CONSTRAINT `FK_CompanyPerson_Company` FOREIGN KEY (`idCompany`) REFERENCES `companies` (`idCompany`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CompanyPerson_Person` FOREIGN KEY (`idCompany`) REFERENCES `persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `companyperson` WRITE;
/*!40000 ALTER TABLE `companyperson` DISABLE KEYS */;

INSERT INTO `companyperson` (`idCompany`, `idPerson`, `idFunction`)
VALUES
	(1,1,1),
	(1,2,1),
	(1,3,1);

/*!40000 ALTER TABLE `companyperson` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contactinfotypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contactinfotypes`;

CREATE TABLE `contactinfotypes` (
  `idContactInfoType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idContactInfoType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `contactinfotypes` WRITE;
/*!40000 ALTER TABLE `contactinfotypes` DISABLE KEYS */;

INSERT INTO `contactinfotypes` (`idContactInfoType`, `name`, `description`)
VALUES
	(1,'Tel',NULL),
	(2,'Fax',NULL),
	(3,'Email',NULL),
	(4,'Skype',NULL),
	(5,'Twitter',NULL),
	(6,'Mobile',NULL),
	(7,'Facebook',NULL),
	(8,'Flickr',NULL);

/*!40000 ALTER TABLE `contactinfotypes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table costcentres
# ------------------------------------------------------------

DROP TABLE IF EXISTS `costcentres`;

CREATE TABLE `costcentres` (
  `idCostCentre` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `cost` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idCostCentre`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `costcentres` WRITE;
/*!40000 ALTER TABLE `costcentres` DISABLE KEYS */;

INSERT INTO `costcentres` (`idCostCentre`, `code`, `name`, `description`, `cost`)
VALUES
	(1,'PFE','programming frontend',NULL,NULL),
	(2,'PBE','programming backend',NULL,NULL),
	(3,'DES','design',NULL,NULL),
	(4,'ANA','analysis',NULL,NULL),
	(5,'PRM','projectmanagement',NULL,NULL),
	(6,'MEE','meeting',NULL,NULL),
	(7,'SUP','support',NULL,NULL);

/*!40000 ALTER TABLE `costcentres` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table country
# ------------------------------------------------------------

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `idCountry` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `prinatblename` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso3` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idCountry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;

INSERT INTO `country` (`idCountry`, `country`, `prinatblename`, `iso3`, `numcode`)
VALUES
	('AD','ANDORRA','Andorra','AND',20),
	('AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE',784),
	('AF','AFGHANISTAN','Afghanistan','AFG',4),
	('AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG',28),
	('AI','ANGUILLA','Anguilla','AIA',660),
	('AL','ALBANIA','Albania','ALB',8),
	('AM','ARMENIA','Armenia','ARM',51),
	('AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT',530),
	('AO','ANGOLA','Angola','AGO',24),
	('AQ','ANTARCTICA','Antarctica',NULL,NULL),
	('AR','ARGENTINA','Argentina','ARG',32),
	('AS','AMERICAN SAMOA','American Samoa','ASM',16),
	('AT','AUSTRIA','Austria','AUT',40),
	('AU','AUSTRALIA','Australia','AUS',36),
	('AW','ARUBA','Aruba','ABW',533),
	('AZ','AZERBAIJAN','Azerbaijan','AZE',31),
	('BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH',70),
	('BB','BARBADOS','Barbados','BRB',52),
	('BD','BANGLADESH','Bangladesh','BGD',50),
	('BE','BELGIUM','Belgium','BEL',56),
	('BF','BURKINA FASO','Burkina Faso','BFA',854),
	('BG','BULGARIA','Bulgaria','BGR',100),
	('BH','BAHRAIN','Bahrain','BHR',48),
	('BI','BURUNDI','Burundi','BDI',108),
	('BJ','BENIN','Benin','BEN',204),
	('BM','BERMUDA','Bermuda','BMU',60),
	('BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN',96),
	('BO','BOLIVIA','Bolivia','BOL',68),
	('BR','BRAZIL','Brazil','BRA',76),
	('BS','BAHAMAS','Bahamas','BHS',44),
	('BT','BHUTAN','Bhutan','BTN',64),
	('BV','BOUVET ISLAND','Bouvet Island',NULL,NULL),
	('BW','BOTSWANA','Botswana','BWA',72),
	('BY','BELARUS','Belarus','BLR',112),
	('BZ','BELIZE','Belize','BLZ',84),
	('CA','CANADA','Canada','CAN',124),
	('CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL),
	('CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD',180),
	('CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF',140),
	('CG','CONGO','Congo','COG',178),
	('CH','SWITZERLAND','Switzerland','CHE',756),
	('CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV',384),
	('CK','COOK ISLANDS','Cook Islands','COK',184),
	('CL','CHILE','Chile','CHL',152),
	('CM','CAMEROON','Cameroon','CMR',120),
	('CN','CHINA','China','CHN',156),
	('CO','COLOMBIA','Colombia','COL',170),
	('CR','COSTA RICA','Costa Rica','CRI',188),
	('CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL),
	('CU','CUBA','Cuba','CUB',192),
	('CV','CAPE VERDE','Cape Verde','CPV',132),
	('CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL),
	('CY','CYPRUS','Cyprus','CYP',196),
	('CZ','CZECH REPUBLIC','Czech Republic','CZE',203),
	('DE','GERMANY','Germany','DEU',276),
	('DJ','DJIBOUTI','Djibouti','DJI',262),
	('DK','DENMARK','Denmark','DNK',208),
	('DM','DOMINICA','Dominica','DMA',212),
	('DO','DOMINICAN REPUBLIC','Dominican Republic','DOM',214),
	('DZ','ALGERIA','Algeria','DZA',12),
	('EC','ECUADOR','Ecuador','ECU',218),
	('EE','ESTONIA','Estonia','EST',233),
	('EG','EGYPT','Egypt','EGY',818),
	('EH','WESTERN SAHARA','Western Sahara','ESH',732),
	('ER','ERITREA','Eritrea','ERI',232),
	('ES','SPAIN','Spain','ESP',724),
	('ET','ETHIOPIA','Ethiopia','ETH',231),
	('FI','FINLAND','Finland','FIN',246),
	('FJ','FIJI','Fiji','FJI',242),
	('FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK',238),
	('FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM',583),
	('FO','FAROE ISLANDS','Faroe Islands','FRO',234),
	('FR','FRANCE','France','FRA',250),
	('GA','GABON','Gabon','GAB',266),
	('GB','UNITED KINGDOM','United Kingdom','GBR',826),
	('GD','GRENADA','Grenada','GRD',308),
	('GE','GEORGIA','Georgia','GEO',268),
	('GF','FRENCH GUIANA','French Guiana','GUF',254),
	('GH','GHANA','Ghana','GHA',288),
	('GI','GIBRALTAR','Gibraltar','GIB',292),
	('GL','GREENLAND','Greenland','GRL',304),
	('GM','GAMBIA','Gambia','GMB',270),
	('GN','GUINEA','Guinea','GIN',324),
	('GP','GUADELOUPE','Guadeloupe','GLP',312),
	('GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ',226),
	('GR','GREECE','Greece','GRC',300),
	('GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL),
	('GT','GUATEMALA','Guatemala','GTM',320),
	('GU','GUAM','Guam','GUM',316),
	('GW','GUINEA-BISSAU','Guinea-Bissau','GNB',624),
	('GY','GUYANA','Guyana','GUY',328),
	('HK','HONG KONG','Hong Kong','HKG',344),
	('HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL),
	('HN','HONDURAS','Honduras','HND',340),
	('HR','CROATIA','Croatia','HRV',191),
	('HT','HAITI','Haiti','HTI',332),
	('HU','HUNGARY','Hungary','HUN',348),
	('ID','INDONESIA','Indonesia','IDN',360),
	('IE','IRELAND','Ireland','IRL',372),
	('IL','ISRAEL','Israel','ISR',376),
	('IN','INDIA','India','IND',356),
	('IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL),
	('IQ','IRAQ','Iraq','IRQ',368),
	('IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN',364),
	('IS','ICELAND','Iceland','ISL',352),
	('IT','ITALY','Italy','ITA',380),
	('JM','JAMAICA','Jamaica','JAM',388),
	('JO','JORDAN','Jordan','JOR',400),
	('JP','JAPAN','Japan','JPN',392),
	('KE','KENYA','Kenya','KEN',404),
	('KG','KYRGYZSTAN','Kyrgyzstan','KGZ',417),
	('KH','CAMBODIA','Cambodia','KHM',116),
	('KI','KIRIBATI','Kiribati','KIR',296),
	('KM','COMOROS','Comoros','COM',174),
	('KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA',659),
	('KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK',408),
	('KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR',410),
	('KW','KUWAIT','Kuwait','KWT',414),
	('KY','CAYMAN ISLANDS','Cayman Islands','CYM',136),
	('KZ','KAZAKHSTAN','Kazakhstan','KAZ',398),
	('LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO',418),
	('LB','LEBANON','Lebanon','LBN',422),
	('LC','SAINT LUCIA','Saint Lucia','LCA',662),
	('LI','LIECHTENSTEIN','Liechtenstein','LIE',438),
	('LK','SRI LANKA','Sri Lanka','LKA',144),
	('LR','LIBERIA','Liberia','LBR',430),
	('LS','LESOTHO','Lesotho','LSO',426),
	('LT','LITHUANIA','Lithuania','LTU',440),
	('LU','LUXEMBOURG','Luxembourg','LUX',442),
	('LV','LATVIA','Latvia','LVA',428),
	('LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY',434),
	('MA','MOROCCO','Morocco','MAR',504),
	('MC','MONACO','Monaco','MCO',492),
	('MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA',498),
	('MG','MADAGASCAR','Madagascar','MDG',450),
	('MH','MARSHALL ISLANDS','Marshall Islands','MHL',584),
	('MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD',807),
	('ML','MALI','Mali','MLI',466),
	('MM','MYANMAR','Myanmar','MMR',104),
	('MN','MONGOLIA','Mongolia','MNG',496),
	('MO','MACAO','Macao','MAC',446),
	('MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP',580),
	('MQ','MARTINIQUE','Martinique','MTQ',474),
	('MR','MAURITANIA','Mauritania','MRT',478),
	('MS','MONTSERRAT','Montserrat','MSR',500),
	('MT','MALTA','Malta','MLT',470),
	('MU','MAURITIUS','Mauritius','MUS',480),
	('MV','MALDIVES','Maldives','MDV',462),
	('MW','MALAWI','Malawi','MWI',454),
	('MX','MEXICO','Mexico','MEX',484),
	('MY','MALAYSIA','Malaysia','MYS',458),
	('MZ','MOZAMBIQUE','Mozambique','MOZ',508),
	('NA','NAMIBIA','Namibia','NAM',516),
	('NC','NEW CALEDONIA','New Caledonia','NCL',540),
	('NE','NIGER','Niger','NER',562),
	('NF','NORFOLK ISLAND','Norfolk Island','NFK',574),
	('NG','NIGERIA','Nigeria','NGA',566),
	('NI','NICARAGUA','Nicaragua','NIC',558),
	('NL','NETHERLANDS','Netherlands','NLD',528),
	('NO','NORWAY','Norway','NOR',578),
	('NP','NEPAL','Nepal','NPL',524),
	('NR','NAURU','Nauru','NRU',520),
	('NU','NIUE','Niue','NIU',570),
	('NZ','NEW ZEALAND','New Zealand','NZL',554),
	('OM','OMAN','Oman','OMN',512),
	('PA','PANAMA','Panama','PAN',591),
	('PE','PERU','Peru','PER',604),
	('PF','FRENCH POLYNESIA','French Polynesia','PYF',258),
	('PG','PAPUA NEW GUINEA','Papua New Guinea','PNG',598),
	('PH','PHILIPPINES','Philippines','PHL',608),
	('PK','PAKISTAN','Pakistan','PAK',586),
	('PL','POLAND','Poland','POL',616),
	('PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM',666),
	('PN','PITCAIRN','Pitcairn','PCN',612),
	('PR','PUERTO RICO','Puerto Rico','PRI',630),
	('PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL),
	('PT','PORTUGAL','Portugal','PRT',620),
	('PW','PALAU','Palau','PLW',585),
	('PY','PARAGUAY','Paraguay','PRY',600),
	('QA','QATAR','Qatar','QAT',634),
	('RE','REUNION','Reunion','REU',638),
	('RO','ROMANIA','Romania','ROM',642),
	('RU','RUSSIAN FEDERATION','Russian Federation','RUS',643),
	('RW','RWANDA','Rwanda','RWA',646),
	('SA','SAUDI ARABIA','Saudi Arabia','SAU',682),
	('SB','SOLOMON ISLANDS','Solomon Islands','SLB',90),
	('SC','SEYCHELLES','Seychelles','SYC',690),
	('SD','SUDAN','Sudan','SDN',736),
	('SE','SWEDEN','Sweden','SWE',752),
	('SG','SINGAPORE','Singapore','SGP',702),
	('SH','SAINT HELENA','Saint Helena','SHN',654),
	('SI','SLOVENIA','Slovenia','SVN',705),
	('SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM',744),
	('SK','SLOVAKIA','Slovakia','SVK',703),
	('SL','SIERRA LEONE','Sierra Leone','SLE',694),
	('SM','SAN MARINO','San Marino','SMR',674),
	('SN','SENEGAL','Senegal','SEN',686),
	('SO','SOMALIA','Somalia','SOM',706),
	('SR','SURINAME','Suriname','SUR',740),
	('ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP',678),
	('SV','EL SALVADOR','El Salvador','SLV',222),
	('SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR',760),
	('SZ','SWAZILAND','Swaziland','SWZ',748),
	('TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA',796),
	('TD','CHAD','Chad','TCD',148),
	('TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL),
	('TG','TOGO','Togo','TGO',768),
	('TH','THAILAND','Thailand','THA',764),
	('TJ','TAJIKISTAN','Tajikistan','TJK',762),
	('TK','TOKELAU','Tokelau','TKL',772),
	('TL','TIMOR-LESTE','Timor-Leste',NULL,NULL),
	('TM','TURKMENISTAN','Turkmenistan','TKM',795),
	('TN','TUNISIA','Tunisia','TUN',788),
	('TO','TONGA','Tonga','TON',776),
	('TR','TURKEY','Turkey','TUR',792),
	('TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO',780),
	('TV','TUVALU','Tuvalu','TUV',798),
	('TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN',158),
	('TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA',834),
	('UA','UKRAINE','Ukraine','UKR',804),
	('UG','UGANDA','Uganda','UGA',800),
	('UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL),
	('US','UNITED STATES','United States','USA',840),
	('UY','URUGUAY','Uruguay','URY',858),
	('UZ','UZBEKISTAN','Uzbekistan','UZB',860),
	('VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT',336),
	('VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT',670),
	('VE','VENEZUELA','Venezuela','VEN',862),
	('VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB',92),
	('VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR',850),
	('VN','VIET NAM','Viet Nam','VNM',704),
	('VU','VANUATU','Vanuatu','VUT',548),
	('WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF',876),
	('WS','SAMOA','Samoa','WSM',882),
	('YE','YEMEN','Yemen','YEM',887),
	('YT','MAYOTTE','Mayotte',NULL,NULL),
	('ZA','SOUTH AFRICA','South Africa','ZAF',710),
	('ZM','ZAMBIA','Zambia','ZMB',894),
	('ZW','ZIMBABWE','Zimbabwe','ZWE',716);

/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table functions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `functions`;

CREATE TABLE `functions` (
  `idFunction` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idFunction`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `functions` WRITE;
/*!40000 ALTER TABLE `functions` DISABLE KEYS */;

INSERT INTO `functions` (`idFunction`, `name`, `description`)
VALUES
	(1,'Developer','Developer'),
	(2,'Project Manager','Project Manager'),
	(3,'Designer','Designer');

/*!40000 ALTER TABLE `functions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table imputations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `imputations`;

CREATE TABLE `imputations` (
  `idImputation` int(11) NOT NULL AUTO_INCREMENT,
  `idProject` int(11) NOT NULL,
  `idPerson` int(11) NOT NULL,
  `idCostCentre` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `isBillable` binary(1) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idImputation`,`idProject`,`idPerson`,`idCostCentre`),
  KEY `FK_Imputation_Project` (`idProject`),
  KEY `FK_Imputation_Person` (`idPerson`),
  KEY `FK_Imputation_CostCentre` (`idCostCentre`),
  CONSTRAINT `FK_Imputation_CostCentre` FOREIGN KEY (`idCostCentre`) REFERENCES `costcentres` (`idCostCentre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Imputation_Person` FOREIGN KEY (`idPerson`) REFERENCES `persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Imputation_Project` FOREIGN KEY (`idProject`) REFERENCES `projects` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table personaddresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personaddresses`;

CREATE TABLE `personaddresses` (
  `idPerson` int(11) NOT NULL,
  `idAddress` int(11) NOT NULL,
  `idAddressType` int(11) NOT NULL,
  PRIMARY KEY (`idPerson`,`idAddress`,`idAddressType`),
  KEY `FK_PersonAddress_Person` (`idPerson`),
  KEY `FK_PersonAddress_Address` (`idAddress`),
  KEY `FK_PersonAddress_AddressType` (`idAddressType`),
  CONSTRAINT `FK_PersonAddress_Address` FOREIGN KEY (`idAddress`) REFERENCES `addresses` (`idAddress`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_PersonAddress_AddressType` FOREIGN KEY (`idAddressType`) REFERENCES `addresstypes` (`idAddressType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_PersonAddress_Person` FOREIGN KEY (`idPerson`) REFERENCES `persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table personcontactinformation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personcontactinformation`;

CREATE TABLE `personcontactinformation` (
  `idPerson` int(11) NOT NULL,
  `idContactInfoType` int(11) NOT NULL,
  `value` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idPerson`,`idContactInfoType`),
  KEY `PersonContactInfo` (`idContactInfoType`),
  KEY `Person` (`idPerson`),
  CONSTRAINT `FK_PersonContactInformation_ContactInfoType` FOREIGN KEY (`idContactInfoType`) REFERENCES `contactinfotypes` (`idContactInfoType`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_PersonContactInformation_Person` FOREIGN KEY (`idPerson`) REFERENCES `persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table persons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `persons`;

CREATE TABLE `persons` (
  `idPerson` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gender` binary(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `isEmployee` binary(1) NOT NULL,
  `startdateEmployment` datetime DEFAULT NULL,
  `enddateEmployment` datetime DEFAULT NULL,
  `loginname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `plainpassword` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPerson`),
  UNIQUE KEY `loginname_UNIQUE` (`loginname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `persons` WRITE;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;

INSERT INTO `persons` (`idPerson`, `name`, `firstname`, `gender`, `birthday`, `isEmployee`, `startdateEmployment`, `enddateEmployment`, `loginname`, `password`, `plainpassword`)
VALUES
	(1,'Bolssens','Georges',NULL,NULL,X'31','2002-08-16 00:00:00',NULL,'jos','25f9e794323b453885f5181f1b624d0b','123456789'),
	(2,'Gyselinck','Mikael',NULL,NULL,X'31','2000-01-01 00:00:00',NULL,'mig','25d55ad283aa400af464c76d713c07ad','12345678'),
	(3,'De Boer','Frank',NULL,NULL,X'31','2006-04-12 00:00:00',NULL,'frb','fcea920f7412b5da7be0cf42b8c93759','1234567');

/*!40000 ALTER TABLE `persons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table postalcode
# ------------------------------------------------------------

DROP TABLE IF EXISTS `postalcode`;

CREATE TABLE `postalcode` (
  `idPostalCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `City` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `idCountry` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPostalCode`),
  KEY `FK_PostalCode_Country` (`idCountry`),
  CONSTRAINT `FK_PostalCode_Country` FOREIGN KEY (`idCountry`) REFERENCES `country` (`idCountry`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `postalcode` WRITE;
/*!40000 ALTER TABLE `postalcode` DISABLE KEYS */;

INSERT INTO `postalcode` (`idPostalCode`, `City`, `idCountry`)
VALUES
	('1000','Brussel','BE'),
	('2000','Antwerpen','BE'),
	('9000','Gent','BE'),
	('9100','Sint-Niklaas','BE');

/*!40000 ALTER TABLE `postalcode` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projectcontacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projectcontacts`;

CREATE TABLE `projectcontacts` (
  `idProject` int(11) NOT NULL,
  `idPerson` int(11) NOT NULL,
  PRIMARY KEY (`idProject`,`idPerson`),
  KEY `Project` (`idProject`),
  KEY `PersonContact` (`idPerson`),
  CONSTRAINT `FK_ProjectContact_Person` FOREIGN KEY (`idPerson`) REFERENCES `persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ProjectContact_Project` FOREIGN KEY (`idProject`) REFERENCES `projects` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `projectcontacts` WRITE;
/*!40000 ALTER TABLE `projectcontacts` DISABLE KEYS */;

INSERT INTO `projectcontacts` (`idProject`, `idPerson`)
VALUES
	(1,2);

/*!40000 ALTER TABLE `projectcontacts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
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
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `idProjectType` (`idProjectType`),
  KEY `idProjectStatus` (`idProjectStatus`),
  KEY `indexIdCompany` (`idCompany`,`idProjectType`,`idProjectStatus`),
  CONSTRAINT `FK_Project_ProjectSatus` FOREIGN KEY (`idProjectStatus`) REFERENCES `projectstatuses` (`idProjectStatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Project_ProjectType` FOREIGN KEY (`idProjectType`) REFERENCES `projecttypes` (`idProjectType`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;

INSERT INTO `projects` (`idProject`, `name`, `description`, `startdate`, `enddate`, `budget`, `estimatedCost`, `idCompany`, `idProjectType`, `idProjectStatus`, `idParentProject`)
VALUES
	(1,'testproject','testproject','2012-05-14 00:00:00',NULL,NULL,NULL,2,2,1,NULL),
	(2,'testproject2','testproject2','2012-05-15 00:00:00',NULL,666,NULL,2,2,1,NULL);

/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projectstatuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projectstatuses`;

CREATE TABLE `projectstatuses` (
  `idProjectStatus` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idProjectStatus`),
  KEY `index2` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `projectstatuses` WRITE;
/*!40000 ALTER TABLE `projectstatuses` DISABLE KEYS */;

INSERT INTO `projectstatuses` (`idProjectStatus`, `name`, `description`)
VALUES
	(1,'Open',NULL),
	(2,'Closed',NULL),
	(3,'On hold',NULL);

/*!40000 ALTER TABLE `projectstatuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projectteammembers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projectteammembers`;

CREATE TABLE `projectteammembers` (
  `idProject` int(11) NOT NULL,
  `idPerson` int(11) NOT NULL,
  `idFunction` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProject`,`idPerson`),
  KEY `Project` (`idProject`),
  KEY `PersonTeam` (`idPerson`),
  KEY `FK_ProjectTeamMember_Function` (`idFunction`),
  CONSTRAINT `FK_ProjectTeamMember_Function` FOREIGN KEY (`idFunction`) REFERENCES `functions` (`idFunction`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ProjectTeamMember_Person` FOREIGN KEY (`idPerson`) REFERENCES `persons` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ProjectTeamMember_Project` FOREIGN KEY (`idProject`) REFERENCES `projects` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `projectteammembers` WRITE;
/*!40000 ALTER TABLE `projectteammembers` DISABLE KEYS */;

INSERT INTO `projectteammembers` (`idProject`, `idPerson`, `idFunction`)
VALUES
	(1,2,1),
	(1,1,2),
	(1,3,3);

/*!40000 ALTER TABLE `projectteammembers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projecttypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projecttypes`;

CREATE TABLE `projecttypes` (
  `idProjectType` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idProjectType`),
  KEY `index2` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `projecttypes` WRITE;
/*!40000 ALTER TABLE `projecttypes` DISABLE KEYS */;

INSERT INTO `projecttypes` (`idProjectType`, `name`, `description`)
VALUES
	(1,'Website',NULL),
	(2,'Mobile app',NULL),
	(3,'Presentation',NULL),
	(4,'Print',NULL),
	(5,'Application',NULL),
	(6,'Servermanagement',NULL),
	(7,'Analyse',NULL),
	(8,'Design',NULL);

/*!40000 ALTER TABLE `projecttypes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
