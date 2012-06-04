<?php namespace be\imputation;


/**
 * 
 * @author Jos
 *
 */
class ImputationModel extends AuthenticationModel {
	
	public function __construct($_args  = array()){
		parent::__construct($_args);
	}
	
	public function getProjects()
	{
		return ProjectModel :: getProjects();
	} 
	
	public function getCostCentres()
	{
		return CostCentreModel :: getCostCentres();
	}
	
	public function saveImputationToDB()
	{
		//echo '<pre>' . print_r($this->formvars,true) . '</pre>';
		//echo '<pre>' . print_r($_SESSION,true) . '</pre>';
		
		try
		{
			$sql = "INSERT INTO imputations SET
					idProject = :idProject,
					idPerson = :idPerson,
					idCostCentre = :idCostCentre,
					start = :start,
					end = :end,
					isBillable = :isBillable,
					comment = :comment;";
					
					
			
			$stmt = $this->dal->prepare($sql);
			
			$stmt -> bindValue(':idProject', intval($this->formvars['projectId']), \PDO::PARAM_INT);
			$stmt -> bindValue(':idPerson', intval(self::getUserId()), \PDO::PARAM_INT);
			$stmt -> bindValue(':idCostCentre', intval($this->formvars['costCentre']), \PDO::PARAM_INT);
			
			$startDateTime = (self::dutchDate2isoDate($this->formvars['date'])) . " 00:00";
			//echo "<br />start : " . $startDateTime;
			$stmt -> bindValue(':start', $startDateTime, \PDO::PARAM_STR);
			
			$endDateTimeUTC = strtotime(self::dutchDate2isoDate($this->formvars['date'])) + (floatval($this->formvars['numHours']) * 60 * 60);
			$endDateTime = date("Y\-m\-d h\:i", $endDateTimeUTC);
			//echo "<br />end : " . $endDateTime;
			$stmt -> bindValue(':end', $endDateTime, \PDO::PARAM_STR);
			
			
			$stmt -> bindValue(':isBillable', intval($this->formvars['invoiceable']), \PDO::PARAM_INT);
			$stmt -> bindValue(':comment', strip_tags(strval($this->formvars['comments'])), \PDO::PARAM_STR);
		
			$stmt -> execute();
			
			if($stmt -> errorCode() === '00000')
			{
				return true;
			}
			else
			{
				return $stmt -> errorCode();
			}
		}
		catch (\PDOException $e)
		{
			die("FATAL ERROR: PDO Exception: " . $e->getMessage());
		}
	}
	
	public static function dutchDate2isoDate($d)
	{
		$dateparts = explode('/', $d);
		return $dateparts[2] . '-' . $dateparts[1] . '-' . $dateparts[0]; 
	}
	
	public function checkImputationValues()
	{
		/**
		 * sanitize your imput!
		 * 
		 * if formGuid is not set there was no post => quit
		 * if formGuid is set check if it is valid or throw exception.
		 */
		
		
		$warnings = array();
		
		if(isset($this->formvars['formGuid']) && Sanitize::checkSanity($this->formvars['formGuid'], 'string'))
		{
			$formGuid = $this->formvars['formGuid'];
			if($formGuid != '1234567890')
				throw new \Exception("fatal form error!");
		}
		
		
		
		if(isset($this->formvars['projectId']) && intval($this->formvars['projectId']) != 0 && Sanitize::checkSanity(intval($this->formvars['projectId']), 'int'))
		{
			$projectId = intval($this->formvars['projectId']);
		}
		else 
		{
			$warnings[] = "Project is not valid";
		}
		
		
		if(isset($this->formvars['costCentre']) && intval($this->formvars['costCentre']) != 0 && Sanitize::checkSanity(intval($this->formvars['costCentre']), 'int'))
		{
			$costCentre = intval($this->formvars['costCentre']);
		}
		else 
		{
			$warnings[] = "Cost Centre is not valid";
		}
		
		if(isset($this->formvars['date']) && Sanitize::checkDateSanity($this->formvars['date']))
		{
			$date = $this->formvars['date'];
		}
		else 
		{
			$warnings[] = "Date is not valid";
		}
		
		
		if(isset($this->formvars['numHours']) && $this->formvars['numHours'] != '' && intval($this->formvars['numHours'])>0 && Sanitize::checkSanity(floatval($this->formvars['numHours']), 'float'))
		{
			$numHours = floatval(abs($this->formvars['numHours']));
		}
		else 
		{
			$warnings[] = "Number of hours is not valid";
		}
		
				
		if(isset($this->formvars['invoiceable']) && Sanitize::checkSanity(intval($this->formvars['invoiceable']), 'int'))
		{
			$invoiceable = Sanitize::toBool($this->formvars['invoiceable']);
		}
		else 
		{
			
			$warnings[] = "invoiceable is not valid";
		}
		
		$comments = strval($this->formvars['comments']);
		
		
		
				
		
		
		if(count($warnings) == 0)
		{
			return true;
		}
		else
		{
			return $warnings;
		}
		
		
		
	
	}

	
}