<?php namespace be\imputation;


/**
 * 
 * @author Jos
 *
 */
class ImputationModel extends Model {
	
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
			echo isset($this->formvars['projectId']) ? "isset T " : "isset nil ";
			
			echo Sanitize::checkSanity($this->formvars['projectId'], 'int') ? "checksanity T " : "checksanity nil ";
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
		
		if(isset($this->formvars['date']) && Sanitize::checkDateSanity($this->formvars['date'], 'int'))
		{
			$date = new \DateTime($this->formvars['date']);
		}
		else 
		{
			$warnings[] = "Date is not valid";

		}
		
		
		if(isset($this->formvars['numHours']) && $this->formvars['numHours'] != '' && Sanitize::checkSanity(floatval($this->formvars['numHours']), 'float'))
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