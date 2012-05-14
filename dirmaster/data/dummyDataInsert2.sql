

INSERT INTO  `imputation`.`projects` (

`idProject` ,
`name` ,
`description` ,
`startdate` ,
`enddate` ,
`budget` ,
`estimatedCost` ,
`idCompany` ,
`idProjectType` ,
`idProjectStatus` ,
`idParentProject`
)
VALUES (
NULL ,  'testproject',  'testproject',  '2012-05-14 00:00:00', NULL , NULL , NULL ,  '2',  '2',  '1', NULL
)

INSERT INTO `imputation`.`projectteammembers` (`idProject`, `idPerson`) VALUES ('1', '1');
INSERT INTO `imputation`.`projectteammembers` (`idProject`, `idPerson`) VALUES ('1', '2');
INSERT INTO `imputation`.`projectteammembers` (`idProject`, `idPerson`) VALUES ('1', '3');

INSERT INTO `imputation`.`projectcontacts` (`idProject`, `idPerson`) VALUES ('1', '2');