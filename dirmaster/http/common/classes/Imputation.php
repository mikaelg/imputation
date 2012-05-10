<?php namespace Common;

class Imputation extends Entity
{
    protected static $myExceptionClass = 'Common\ImputationException';
    
    protected static $fields = Array(	"id"				=> Array("type" =>"integer",			"mandatory" => true),
										"employee" 			=> Array("type" =>"Common\Employee", 	"mandatory" => true),
										"from"				=> Array("type" =>"\DateTime", 			"mandatory" => true),
										"to"				=> Array("type" =>"\DateTime", 			"mandatory" => true),
										"costCentre"		=> Array("type" =>"Common\CostCentre",	"mandatory" => true),
										"project"			=> Array("type" =>"Common\Project", 	"mandatory" => true),
										"action" 			=> Array("type" =>"string", 			"mandatory" => true),
										"isBillable" 		=> Array("type" =>"bool",				"mandatory" => true),
										"comment"			=> Array("type" =>"string",				"mandatory" => true),
								);
    
	protected $id;
	protected $employee;
	protected $from;
	protected $to;
	protected $costCentre;
	protected $project;
	protected $action;
	protected $isBillable;
	protected $comment;
	
	public function CalculateCost()
	{
        
       
	}
	
	public function getSpentTime()
	{
	
	}

}

?>