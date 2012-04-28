ALTER TABLE  `projects` ADD FOREIGN KEY (  `idParentProject` ) REFERENCES  `imputation`.`projects` (
`idProject`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE  `imputations` DROP FOREIGN KEY  `FK_Imputation_CostCentre` ;
ALTER TABLE  `imputations` CHANGE  `idCosCentre`  `idCostCentre` INT( 11 ) NOT NULL;
ALTER TABLE  `imputations` ADD FOREIGN KEY (  `idCostCentre` ) REFERENCES  `imputation`.`costcentres` (
`idCostCentre`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;