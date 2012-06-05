<?php namespace Common;

class Project extends Entity
{
	
	protected static $myExceptionClass = 'Common\ProjectException';

	private static $fields = Array(	"id"					=> Array("type" =>"integer",					"mandatory" => true),
										"name" 					=> Array("type" =>"string", 					"mandatory" => true),
										"type"					=> Array("type" =>"string",						"mandatory" => true),
										"parentProject"			=> Array("type" =>"Common\Project", 			"mandatory" => false),
										"projectTeam"			=> Array("type" =>"\ArrayObject",				"mandatory" => true),
										"customerCompany"		=> Array("type" =>"Common\CustomerCompany",		"mandatory" => false),
										"startDate"				=> Array("type" =>"\DateTime", 					"mandatory" => true),
										"endDate"				=> Array("type" =>"\DateTime",					"mandatory" => false),
										"status"				=> Array("type" =>"string",						"mandatory" => true),
										"budget"				=> Array("type" =>"float",						"mandatory" => false),
										"estimatedCost"			=> Array("type" =>"float",						"mandatory" => false),
										"totalCost"				=> Array("type" =>"float",						"mandatory" => false),
										"contacts"				=> Array("type" =>"\ArrayObject",				"mandatory" => false),
								);
	
	
    
    protected $id;
	protected $name;
	protected $type;
	protected $parentProject;
	protected $projectTeam;
	protected $customerCompany;
	protected $startDate;
	protected $endDate;
	protected $status;
	protected $totalCost;
	protected $contacts;
	
	public static function getFieldsArray()
    {
    	return self::$fields;
    }

		
	public function numberOfProjectTeamMembers()
	{
		return count($this -> projectTeam);
	}
	


} 

?>