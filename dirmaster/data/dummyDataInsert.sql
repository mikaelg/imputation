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
NULL , 'OWS', 'Organic Waste Systems', 'BE0433.270.195'
);

INSERT INTO `imputation`.`CompanyAddresses` (
`idCompany` ,
`idAddress` ,
`idAddressType`
)
VALUES (
'1', '1', '2'
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
NULL , '1', '9000', 'BE', 'Sint-Denijslaan 485', NULL , NULL

INSERT INTO `imputation`.`Companies` (
`idCompany` ,
`name` ,
`description` ,
`VAT`
)
VALUES (
NULL , 'Claerhout communicatiehuis', NULL , 'BE0443.475.684'
);


INSERT INTO `imputation`.`CompanyAddresses` (
`idCompany` ,
`idAddress` ,
`idAddressType`
)
VALUES (
'2', '2', '2'
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
NULL , 'Bolssens', 'Georges', NULL , NULL , '1', '2002-08-16', NULL , 'jos', '123456789'
);

INSERT INTO `imputation`.`Functions` (
`idFunction` ,
`name` ,
`description`
)
VALUES (
NULL , 'Developer', 'Developer'
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
NULL , 'Gyselinck', 'Mikael', NULL , NULL , '1', '2000-01-01', NULL , 'jos', '123456789'
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
)

INSERT INTO `imputation`.`CompanyPerson` (
`idCompany` ,
`idPerson` ,
`idFunction`
)
VALUES (
'2', '2', '1'
);