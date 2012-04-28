#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
# 
#   Aanmaken van ons eigen bedrijf (1))
#
#
INSERT INTO `imputation`.`Addresses` (
`idAddress` ,
`Version` ,
`idPostalCode` ,
`idCountry` ,
`address` ,
`longitude` ,
`latidtude`
)
VALUES (
NULL , '1', '9000', 'BE', 'Dok Noord 5', NULL , NULL
);

INSERT INTO `imputation`.`Companies` (
`idCompany` ,
`name` ,
`description` ,
`VAT`
)
VALUES (
NULL , 'Imputation BVBA', 'Dit is het fictieve bedrijf waarvoor we werken', 'BE0433.270.195'
);

INSERT INTO `imputation`.`CompanyAddresses` (
`idCompany` ,
`idAddress` ,
`idAddressType`
)
VALUES (
'1', '1', '1'
);


#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
# 
#   Aanmaken van fictieve klanten (2,3)
#
#
INSERT INTO `imputation`.`Addresses` (
`idAddress` ,
`Version` ,
`idPostalCode` ,
`idCountry` ,
`address` ,
`longitude` ,
`latidtude`
)
VALUES (
NULL , '1', '9000', 'BE', 'Voskenslaan 6', NULL , NULL
);

INSERT INTO `imputation`.`Companies` (
`idCompany` ,
`name` ,
`description` ,
`VAT`
)
VALUES (
NULL , 'ACME ', 'Dit is een heel belangrijke klant' , 'BE0345.678.901'
);


INSERT INTO `imputation`.`CompanyAddresses` (
`idCompany` ,
`idAddress` ,
`idAddressType`
)
VALUES (
'2', '2', '2'
);



INSERT INTO `imputation`.`Addresses` (
`idAddress` ,
`Version` ,
`idPostalCode` ,
`idCountry` ,
`address` ,
`longitude` ,
`latidtude`
)
VALUES (
NULL , '1', '9000', 'BE', 'Koepoortbrug 366', NULL , NULL
);

INSERT INTO `imputation`.`Companies` (
`idCompany` ,
`name` ,
`description` ,
`VAT`
)
VALUES (
NULL , 'Detectievebureau Janssen en Janssen ', 'Dit is ook een heel belangrijke klant' , 'BE0345.876.901'
);


INSERT INTO `imputation`.`CompanyAddresses` (
`idCompany` ,
`idAddress` ,
`idAddressType`
)
VALUES (
'3', '3', '2'
);


#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
# 
#   Aanmaken van verschillende functieomschrijvingen (1,2,3)
#
#


INSERT INTO `imputation`.`Functions` (
`idFunction` ,
`name` ,
`description`
)
VALUES (
NULL , 'Developer', 'Developer'
);

INSERT INTO `imputation`.`Functions` (
`idFunction` ,
`name` ,
`description`
)
VALUES (
NULL , 'Project Manager', 'Project Manager'
);

INSERT INTO `imputation`.`Functions` (
`idFunction` ,
`name` ,
`description`
)
VALUES (
NULL , 'Designer', 'Designer'
);


#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
# 
#   Aanmaken van verschillende werknemers
#
#
INSERT INTO `imputation`.`Persons` (
`idPerson` ,
`name` ,
`firstname` ,
`gender` ,
`birthday` ,
`isEmployee` ,
`startdateEmployment` ,
`enddateEmployment` ,
`loginname` ,
`password`
)
VALUES (
NULL , 'Bolssens', 'Georges', NULL , NULL , '1', '2002-08-16', NULL , 'jos', '123456789'
);



INSERT INTO `imputation`.`CompanyPerson` (
`idCompany` ,
`idPerson` ,
`idFunction`
)
VALUES (
'1', '1', '1'
);


INSERT INTO `imputation`.`Persons` (
`idPerson` ,
`name` ,
`firstname` ,
`gender` ,
`birthday` ,
`isEmployee` ,
`startdateEmployment` ,
`enddateEmployment` ,
`loginname` ,
`password`
)
VALUES (
NULL , 'Gyselinck', 'Mikael', NULL , NULL , '1', '2000-01-01', NULL , 'mig', '12345678'
);

INSERT INTO `imputation`.`CompanyPerson` (
`idCompany` ,
`idPerson` ,
`idFunction`
)
VALUES (
'1', '2', '1'
);



INSERT INTO `imputation`.`Persons` (
`idPerson` ,
`name` ,
`firstname` ,
`gender` ,
`birthday` ,
`isEmployee` ,
`startdateEmployment` ,
`enddateEmployment` ,
`loginname` ,
`password`
)
VALUES (
NULL , 'De Boer', 'Frank', NULL , NULL , '1', '2006-04-12', NULL , 'frb', '1234567'
);

INSERT INTO `imputation`.`CompanyPerson` (
`idCompany` ,
`idPerson` ,
`idFunction`
)
VALUES (
'1', '3', '1'
);

#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
# 
#   Aanmaken van een fictief project
#
#

INSERT INTO `imputation`.`projects` (
`idProject`, 
`name`, 
`description`, 
`startdate`, 
`enddate`, 
`budget`, 
`estimatedCost`, 
`idCompany`, 
`idProjectType`, 
`idProjectStatus`, 
`idParentProject`) 
VALUES (
NULL, 
'Corporate website acme.be', 
NULL, 
'2012-04-25 00:00:00', 
NULL, 
'15000', 
'13800', 
'2', 
'1', 
'1', 
NULL
);




#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
# 
#   Aanmaken van imputaties op fictief project
#
#
INSERT INTO `imputation`.`imputations` (`idImputation`, `idProject`, `idPerson`, `idCostCentre`, `start`, `end`, `isBillable`, `comment`) VALUES (NULL, '1', '1', '2', '2012-04-28 09:00:00', '2012-04-28 15:00:00', UNHEX(NULL), NULL);