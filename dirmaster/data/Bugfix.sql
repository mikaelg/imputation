/* JOS : 28/04/2012
ALTER TABLE  `projects` ADD FOREIGN KEY (  `idParentProject` ) REFERENCES  `imputation`.`projects` (
`idProject`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE  `imputations` DROP FOREIGN KEY  `FK_Imputation_CostCentre` ;
ALTER TABLE  `imputations` CHANGE  `idCosCentre`  `idCostCentre` INT( 11 ) NOT NULL;
ALTER TABLE  `imputations` ADD FOREIGN KEY (  `idCostCentre` ) REFERENCES  `imputation`.`costcentres` (
`idCostCentre`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;
*/

/* MIG : 28/04/2012 */
ALTER TABLE `Imputation`.`Projects` DROP FOREIGN KEY `FK_Project_Project` ;
ALTER TABLE `Imputation`.`Projects` 
  ADD CONSTRAINT `FK_Project_Project`
  FOREIGN KEY (`idProject` )
  REFERENCES `Imputation`.`Projects` (`idParentProject` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;



ALTER TABLE `Imputation`.`Imputations` DROP FOREIGN KEY `FK_Imputation_CostCentre` ;
ALTER TABLE `Imputation`.`Imputations` CHANGE COLUMN `idCosCentre` `idCostCentre` INT(11) NOT NULL  , 
  ADD CONSTRAINT `FK_Imputation_CostCentre`
  FOREIGN KEY (`idCostCentre` )
  REFERENCES `Imputation`.`CostCentres` (`idCostCentre` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, DROP PRIMARY KEY 
, ADD PRIMARY KEY (`idImputation`, `idProject`, `idPerson`, `idCostCentre`) 
, DROP INDEX `FK_Imputation_CostCentre` 
, ADD INDEX `FK_Imputation_CostCentre` (`idCostCentre` ASC) ;


/* MIG : 19/05/2012 */
ALTER TABLE `Imputation`.`projects` 
ADD UNIQUE INDEX `name_UNIQUE` (`name` ASC) ;