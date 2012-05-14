# ************************************************************
# sequel pro sql dump
# version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# host: 127.0.0.1 (mysql 5.1.44)
# database: imputation
# generation time: 2012-05-01 19:34:59 +0200
# ************************************************************


/*!40101 set @old_character_set_client=@@character_set_client */;
/*!40101 set @old_character_set_results=@@character_set_results */;
/*!40101 set @old_collation_connection=@@collation_connection */;
/*!40101 set names utf8 */;
/*!40014 set @old_foreign_key_checks=@@foreign_key_checks, foreign_key_checks=0 */;
/*!40101 set @old_sql_mode=@@sql_mode, sql_mode='no_auto_value_on_zero' */;
/*!40111 set @old_sql_notes=@@sql_notes, sql_notes=0 */;


# dump of table addresses
# ------------------------------------------------------------

drop table if exists `addresses`;

create table `addresses` (
  `idaddress` int(11) not null auto_increment,
  `version` int(11) not null,
  `idpostalcode` varchar(10) collate utf8_unicode_ci not null,
  `idcountry` varchar(4) collate utf8_unicode_ci not null,
  `address` varchar(500) collate utf8_unicode_ci not null,
  `longitude` varchar(200) collate utf8_unicode_ci default null,
  `latidtude` varchar(200) collate utf8_unicode_ci default null,
  primary key (`idaddress`,`version`),
  key `fk_address_postalcode` (`idpostalcode`),
  key `fk_address_country` (`idcountry`),
  constraint `fk_address_country` foreign key (`idcountry`) references `country` (`idcountry`) on delete no action on update no action,
  constraint `fk_address_postalcode` foreign key (`idpostalcode`) references `postalcode` (`idpostalcode`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `addresses` write;
/*!40000 alter table `addresses` disable keys */;

insert into `addresses` (`idaddress`, `version`, `idpostalcode`, `idcountry`, `address`, `longitude`, `latidtude`)
values
	(1,1,'9000','BE','Dok Noord 5',NULL,NULL),
	(2,1,'9000','BE','Voskenslaan 6',NULL,NULL),
	(3,1,'9000','BE','Koepoortbrug 366',NULL,NULL);

/*!40000 alter table `addresses` enable keys */;
unlock tables;


# dump of table addresstypes
# ------------------------------------------------------------

drop table if exists `addresstypes`;

create table `addresstypes` (
  `idaddresstype` int(11) not null auto_increment,
  `name` varchar(200) collate utf8_unicode_ci not null,
  `description` text collate utf8_unicode_ci,
  primary key (`idaddresstype`)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `addresstypes` write;
/*!40000 alter table `addresstypes` disable keys */;

insert into `addresstypes` (`idaddresstype`, `name`, `description`)
values
	(1,'Company Adres',NULL),
	(2,'Facturatie Adres',NULL);


/*!40000 alter table `addresstypes` enable keys */;
unlock tables;


# dump of table companies
# ------------------------------------------------------------

drop table if exists `companies`;

create table `companies` (
  `idcompany` int(11) not null auto_increment,
  `name` varchar(200) collate utf8_unicode_ci not null,
  `description` text collate utf8_unicode_ci,
  `vat` varchar(45) collate utf8_unicode_ci default null,
  primary key (`idcompany`),
  unique key `vat_unique` (`vat`),
  key `name` (`name`)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `companies` write;
/*!40000 alter table `companies` disable keys */;

insert into `companies` (`idcompany`, `name`, `description`, `vat`)
values
	(1,'Imputation BVBA','Dit is het fictieve bedrijf waarvoor we werken','BE0433.270.195'),
	(2,'ACME ','Dit is een heel belangrijke klant','BE0345.678.901'),
	(3,'Detectievebureau Janssen en Janssen ','Dit is ook een heel belangrijke klant','BE0345.876.91');

/*!40000 alter table `companies` enable keys */;
unlock tables;


# dump of table companyaddresses
# ------------------------------------------------------------

drop table if exists `companyaddresses`;

create table `companyaddresses` (
  `idcompany` int(11) not null,
  `idaddress` int(11) not null,
  `idaddresstype` int(11) not null,
  primary key (`idcompany`,`idaddress`,`idaddresstype`),
  key `fk_companyaddress_company` (`idcompany`),
  key `fk_companyaddress_address` (`idaddress`),
  key `fk_companyaddress_addresstype` (`idaddresstype`),
  constraint `fk_companyaddress_address` foreign key (`idaddress`) references `addresses` (`idaddress`) on delete no action on update no action,
  constraint `fk_companyaddress_addresstype` foreign key (`idaddresstype`) references `addresstypes` (`idaddresstype`) on delete no action on update no action,
  constraint `fk_companyaddress_company` foreign key (`idcompany`) references `companies` (`idcompany`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `companyaddresses` write;
/*!40000 alter table `companyaddresses` disable keys */;

insert into `companyaddresses` (`idcompany`, `idaddress`, `idaddresstype`)
values
	(1,1,1),
	(2,2,2),
	(3,3,2);

/*!40000 alter table `companyaddresses` enable keys */;
unlock tables;


# dump of table companycontactinformation
# ------------------------------------------------------------

drop table if exists `companycontactinformation`;

create table `companycontactinformation` (
  `idcompany` int(11) not null,
  `idcontactinfotype` int(11) not null,
  `value` varchar(200) collate utf8_unicode_ci not null,
  `description` text collate utf8_unicode_ci,
  primary key (`idcompany`,`idcontactinfotype`),
  key `fk_companycontactinformation_company` (`idcompany`),
  key `fk_companycontactinformation_contactinfotype` (`idcontactinfotype`),
  constraint `fk_companycontactinformation_company` foreign key (`idcompany`) references `companies` (`idcompany`) on delete no action on update no action,
  constraint `fk_companycontactinformation_contactinfotype` foreign key (`idcontactinfotype`) references `contactinfotypes` (`idcontactinfotype`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;



# dump of table companycontacts
# ------------------------------------------------------------

drop table if exists `companycontacts`;

create table `companycontacts` (
  `idcompany` int(11) not null,
  `idperson` int(11) not null,
  primary key (`idcompany`,`idperson`),
  key `company` (`idcompany`),
  key `companycontact` (`idcompany`),
  key `person` (`idperson`),
  constraint `fk_companycontacts_company` foreign key (`idcompany`) references `companies` (`idcompany`) on delete no action on update no action,
  constraint `fk_companycontacts_person` foreign key (`idperson`) references `persons` (`idperson`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;



# dump of table companyperson
# ------------------------------------------------------------

drop table if exists `companyperson`;

create table `companyperson` (
  `idcompany` int(11) not null,
  `idperson` int(11) not null,
  `idfunction` int(11) default null,
  primary key (`idcompany`,`idperson`),
  key `fk_companyperson_person` (`idcompany`),
  key `fk_companyperson_company` (`idcompany`),
  constraint `fk_companyperson_company` foreign key (`idcompany`) references `companies` (`idcompany`) on delete no action on update no action,
  constraint `fk_companyperson_person` foreign key (`idcompany`) references `persons` (`idperson`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `companyperson` write;
/*!40000 alter table `companyperson` disable keys */;

insert into `companyperson` (`idcompany`, `idperson`, `idfunction`)
values
	(1,1,1),
	(1,2,1),
	(1,3,1);

/*!40000 alter table `companyperson` enable keys */;
unlock tables;


# dump of table contactinfotypes
# ------------------------------------------------------------

drop table if exists `contactinfotypes`;

create table `contactinfotypes` (
  `idcontactinfotype` int(11) not null auto_increment,
  `name` varchar(200) collate utf8_unicode_ci not null,
  `description` text collate utf8_unicode_ci,
  primary key (`idcontactinfotype`)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `contactinfotypes` write;
/*!40000 alter table `contactinfotypes` disable keys */;

insert into `contactinfotypes` (`idcontactinfotype`, `name`, `description`)
values
	(1,'Tel',NULL),
	(2,'Fax',NULL),
	(3,'Email',NULL),
	(4,'Skype',NULL),
	(5,'Twitter',NULL),
	(6,'Mobile',NULL),
	(7,'Facebook',NULL),
	(8,'Flickr',NULL);


/*!40000 alter table `contactinfotypes` enable keys */;
unlock tables;


# dump of table costcentres
# ------------------------------------------------------------

drop table if exists `costcentres`;

create table `costcentres` (
  `idcostcentre` int(11) not null auto_increment,
  `code` varchar(5) collate utf8_unicode_ci default null,
  `name` varchar(200) collate utf8_unicode_ci default null,
  `description` text collate utf8_unicode_ci,
  `cost` decimal(10,0) default null,
  primary key (`idcostcentre`),
  unique key `code_unique` (`code`)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `costcentres` write;
/*!40000 alter table `costcentres` disable keys */;

insert into `costcentres` (`idcostcentre`, `code`, `name`, `description`, `cost`)
values
	(1,'PFE','programming frontend',NULL,NULL),
	(2,'PBE','programming backend',NULL,NULL),
	(3,'DES','design',NULL,NULL),
	(4,'ANA','analysis',NULL,NULL),
	(5,'PRM','projectmanagement',NULL,NULL),
	(6,'MEE','meeting',NULL,NULL),
	(7,'SUP','support',NULL,NULL);


/*!40000 alter table `costcentres` enable keys */;
unlock tables;


# dump of table country
# ------------------------------------------------------------

drop table if exists `country`;

create table `country` (
  `idcountry` varchar(4) collate utf8_unicode_ci not null,
  `country` varchar(200) collate utf8_unicode_ci not null default '',
  `prinatblename` varchar(200) collate utf8_unicode_ci default null,
  `iso3` char(3) collate utf8_unicode_ci default null,
  `numcode` smallint(6) default null,
  primary key (`idcountry`)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `country` write;
/*!40000 alter table `country` disable keys */;

insert into `country` (`idcountry`, `country`, `prinatblename`, `iso3`, `numcode`)
values
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

/*!40000 alter table `country` enable keys */;
unlock tables;


# dump of table functions
# ------------------------------------------------------------

drop table if exists `functions`;

create table `functions` (
  `idfunction` int(11) not null auto_increment,
  `name` varchar(200) collate utf8_unicode_ci not null,
  `description` text collate utf8_unicode_ci,
  primary key (`idfunction`),
  key `name` (`name`)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `functions` write;
/*!40000 alter table `functions` disable keys */;

insert into `functions` (`idfunction`, `name`, `description`)
values
	(1,'Developer','Developer'),
	(2,'Project Manager','Project Manager'),
	(3,'Designer','Designer');

/*!40000 alter table `functions` enable keys */;
unlock tables;


# dump of table imputations
# ------------------------------------------------------------

drop table if exists `imputations`;

create table `imputations` (
  `idimputation` int(11) not null auto_increment,
  `idproject` int(11) not null,
  `idperson` int(11) not null,
  `idcostcentre` int(11) not null,
  `start` datetime not null,
  `end` datetime not null,
  `isbillable` binary(1) default null,
  `comment` text collate utf8_unicode_ci,
  primary key (`idimputation`,`idproject`,`idperson`,`idcostcentre`),
  key `fk_imputation_project` (`idproject`),
  key `fk_imputation_person` (`idperson`),
  key `fk_imputation_costcentre` (`idcostcentre`),
  constraint `fk_imputation_costcentre` foreign key (`idcostcentre`) references `costcentres` (`idcostcentre`) on delete no action on update no action,
  constraint `fk_imputation_person` foreign key (`idperson`) references `persons` (`idperson`) on delete no action on update no action,
  constraint `fk_imputation_project` foreign key (`idproject`) references `projects` (`idproject`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;



# dump of table personaddresses
# ------------------------------------------------------------

drop table if exists `personaddresses`;

create table `personaddresses` (
  `idperson` int(11) not null,
  `idaddress` int(11) not null,
  `idaddresstype` int(11) not null,
  primary key (`idperson`,`idaddress`,`idaddresstype`),
  key `fk_personaddress_person` (`idperson`),
  key `fk_personaddress_address` (`idaddress`),
  key `fk_personaddress_addresstype` (`idaddresstype`),
  constraint `fk_personaddress_address` foreign key (`idaddress`) references `addresses` (`idaddress`) on delete no action on update no action,
  constraint `fk_personaddress_addresstype` foreign key (`idaddresstype`) references `addresstypes` (`idaddresstype`) on delete no action on update no action,
  constraint `fk_personaddress_person` foreign key (`idperson`) references `persons` (`idperson`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;



# dump of table personcontactinformation
# ------------------------------------------------------------

drop table if exists `personcontactinformation`;

create table `personcontactinformation` (
  `idperson` int(11) not null,
  `idcontactinfotype` int(11) not null,
  `value` varchar(200) collate utf8_unicode_ci not null,
  `description` text collate utf8_unicode_ci,
  primary key (`idperson`,`idcontactinfotype`),
  key `personcontactinfo` (`idcontactinfotype`),
  key `person` (`idperson`),
  constraint `fk_personcontactinformation_contactinfotype` foreign key (`idcontactinfotype`) references `contactinfotypes` (`idcontactinfotype`) on delete no action on update no action,
  constraint `fk_personcontactinformation_person` foreign key (`idperson`) references `persons` (`idperson`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;



# dump of table persons
# ------------------------------------------------------------

drop table if exists `persons`;

create table `persons` (
  `idperson` int(11) not null auto_increment,
  `name` varchar(200) collate utf8_unicode_ci not null,
  `firstname` varchar(200) collate utf8_unicode_ci not null,
  `gender` binary(1) default null,
  `birthday` date default null,
  `isemployee` binary(1) not null,
  `startdateemployment` datetime default null,
  `enddateemployment` datetime default null,
  `loginname` varchar(200) collate utf8_unicode_ci not null,
  `password` varchar(45) collate utf8_unicode_ci not null,
  primary key (`idperson`),
  unique key `loginname_unique` (`loginname`)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `persons` write;
/*!40000 alter table `persons` disable keys */;

insert into `persons` (`idperson`, `name`, `firstname`, `gender`, `birthday`, `isemployee`, `startdateemployment`, `enddateemployment`, `loginname`, `password`)
values
	(1,'Bolssens','Georges',NULL,NULL,X'31','2002-08-16 00:00:00',NULL,'jos','123456789'),
	(2,'Gyselinck','Mikael',NULL,NULL,X'31','2000-01-01 00:00:00',NULL,'mig','12345678'),
	(3,'De Boer','Frank',NULL,NULL,X'31','2006-04-12 00:00:00',NULL,'frb','1234567');

/*!40000 alter table `persons` enable keys */;
unlock tables;


# dump of table postalcode
# ------------------------------------------------------------

drop table if exists `postalcode`;

create table `postalcode` (
  `idpostalcode` varchar(10) collate utf8_unicode_ci not null,
  `city` varchar(200) collate utf8_unicode_ci not null,
  `idcountry` varchar(4) collate utf8_unicode_ci not null,
  primary key (`idpostalcode`),
  key `fk_postalcode_country` (`idcountry`),
  constraint `fk_postalcode_country` foreign key (`idcountry`) references `country` (`idcountry`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `postalcode` write;
/*!40000 alter table `postalcode` disable keys */;

insert into `postalcode` (`idpostalcode`, `city`, `idcountry`)
values
	('1000','Brussel','BE'),
	('2000','Antwerpen','BE'),
	('9000','Gent','BE'),
	('9100','Sint-Niklaas','BE');

/*!40000 alter table `postalcode` enable keys */;
unlock tables;


# dump of table projectcontacts
# ------------------------------------------------------------

drop table if exists `projectcontacts`;

create table `projectcontacts` (
  `idproject` int(11) not null,
  `idperson` int(11) not null,
  primary key (`idproject`,`idperson`),
  key `project` (`idproject`),
  key `personcontact` (`idperson`),
  constraint `fk_projectcontact_person` foreign key (`idperson`) references `persons` (`idperson`) on delete no action on update no action,
  constraint `fk_projectcontact_project` foreign key (`idproject`) references `projects` (`idproject`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;



# dump of table projects
# ------------------------------------------------------------

drop table if exists `projects`;

create table `projects` (
  `idproject` int(11) not null auto_increment,
  `name` varchar(200) collate utf8_unicode_ci not null,
  `description` text collate utf8_unicode_ci,
  `startdate` datetime not null,
  `enddate` datetime default null,
  `budget` decimal(10,0) default null,
  `estimatedcost` decimal(10,0) default null,
  `idcompany` int(11) not null,
  `idprojecttype` int(11) not null,
  `idprojectstatus` int(11) not null,
  `idparentproject` int(11) default null,
  primary key (`idproject`),
  key `idprojecttype` (`idprojecttype`),
  key `idprojectstatus` (`idprojectstatus`),
  key `indexidcompany` (`idcompany`,`idprojecttype`,`idprojectstatus`),
  key `idparentproject` (`idparentproject`),
  key `fk_project_project` (`idproject`),
  constraint `fk_project_project` foreign key (`idproject`) references `projects` (`idparentproject`) on delete no action on update no action,
  constraint `fk_project_projectsatus` foreign key (`idprojectstatus`) references `projectstatuses` (`idprojectstatus`) on delete no action on update no action,
  constraint `fk_project_projecttype` foreign key (`idprojecttype`) references `projecttypes` (`idprojecttype`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;



# dump of table projectstatuses
# ------------------------------------------------------------

drop table if exists `projectstatuses`;

create table `projectstatuses` (
  `idprojectstatus` int(11) not null auto_increment,
  `name` varchar(200) collate utf8_unicode_ci not null,
  `description` text collate utf8_unicode_ci,
  primary key (`idprojectstatus`),
  key `index2` (`name`)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `projectstatuses` write;
/*!40000 alter table `projectstatuses` disable keys */;

insert into `projectstatuses` (`idprojectstatus`, `name`, `description`)
values
	(1,'Open',NULL),
	(2,'Closed',NULL),
	(3,'On hold',NULL);

/*!40000 alter table `projectstatuses` enable keys */;
unlock tables;


# dump of table projectteammembers
# ------------------------------------------------------------

drop table if exists `projectteammembers`;

create table `projectteammembers` (
  `idproject` int(11) not null,
  `idperson` int(11) not null,
  primary key (`idproject`,`idperson`),
  key `project` (`idproject`),
  key `personteam` (`idperson`),
  constraint `fk_projectteammember_person` foreign key (`idperson`) references `persons` (`idperson`) on delete no action on update no action,
  constraint `fk_projectteammember_project` foreign key (`idproject`) references `projects` (`idproject`) on delete no action on update no action
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;



# dump of table projecttypes
# ------------------------------------------------------------

drop table if exists `projecttypes`;

create table `projecttypes` (
  `idprojecttype` int(11) not null auto_increment,
  `name` varchar(200) collate utf8_unicode_ci not null,
  `description` text collate utf8_unicode_ci,
  primary key (`idprojecttype`),
  key `index2` (`name`)
) engine=innodb default charset=utf8 collate=utf8_unicode_ci;

lock tables `projecttypes` write;
/*!40000 alter table `projecttypes` disable keys */;

insert into `projecttypes` (`idprojecttype`, `name`, `description`)
values
	(1,'Website',NULL),
	(2,'Mobile app',NULL),
	(3,'Presentation',NULL),
	(4,'Print',NULL),
	(5,'Application',NULL),
	(6,'Servermanagement',NULL),
	(7,'Analyse',NULL),
	(8,'Design',NULL);

/*!40000 alter table `projecttypes` enable keys */;
unlock tables;



/*!40111 set sql_notes=@old_sql_notes */;
/*!40101 set sql_mode=@old_sql_mode */;
/*!40014 set foreign_key_checks=@old_foreign_key_checks */;
/*!40101 set character_set_client=@old_character_set_client */;
/*!40101 set character_set_results=@old_character_set_results */;
/*!40101 set collation_connection=@old_collation_connection */;
