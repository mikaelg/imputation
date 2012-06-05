<?php namespace Common;

class Imputation extends Entity
{

	const TIMEDIFF_FORMAT_MINUTES = 1;
	const TIMEDIFF_FORMAT_FRACTIONAL_HOURS = 2;

    protected static $myExceptionClass = 'Common\ImputationException';
    
    private static $fields = Array(		"id"				=> Array("type" =>"integer",			"mandatory" => true),
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
	
	final public static function getFieldsArray()
    {
    	return self::$fields;
    }
	

	
	public function getSpentTime($_format = self::TIMEDIFF_FORMAT_FRACTIONAL_HOURS)
	{
		if(get_class($this -> to) == 'DateTime' && get_class($this -> from) == 'DateTime')
		{		
			$interval = $this -> to -> diff($this -> from);
			
			switch($_format)
			{
				case self::TIMEDIFF_FORMAT_FRACTIONAL_HOURS:
					return intval($interval -> h) + floatval($interval -> i / 60);
					//return intval($interval -> i);
				break;
				
				case self::TIMEDIFF_FORMAT_MINUTES:
					return $minutes;
				break;
				
				default:
					throw new self::$myExceptionClass("Illegal timediff format provided!!");
				break;
				
				
			}
		}
		else
		{
			throw new self::$myExceptionClass("from and to properties must be populated before calling getSpentTime()!\n
													from is a " . get_class($this -> from) . "\n
													to is a " . get_class($this -> to) . "\n");
		}
		
	}
	
	public function __set($_property, $value)
	{
		if($this -> valueMatchesPropertyType($_property, $value))
    	{
    		//echo "\n\nSetting: " . $_property . "\n";
    		//echo "\n\nFROM is a" . get_class($this -> from) . "\n";
    		//echo "\n\nTO is a" . get_class($this -> to) . "\n";
    		
    		if($_property == "from" && get_class($this -> to) == 'DateTime')
			{
				// trying to set the 'from' property while 'to' is already set. 
				$diff = $this -> to -> diff($value);
				if($diff -> format('%R') == "+")
				{
					throw new self::$myExceptionClass("Trying to set 'from' to a greater value than 'to'!");
					// reverse the order if to is smaller than from?
					//$this -> from = $this -> to;
					//$this -> to = $value;
				}
				else
				{
					parent::__set($_property, $value);
				}
				//echo "\n\nDIFF_SIGN: " . $diff -> format('%R') . "\n";
				
			}
			elseif($_property == "to" && get_class($this -> from) == 'DateTime')
			{
				// trying to set the 'to' property while 'from' is already set. 				
				$diff = $this -> from -> diff($value);
				if($diff -> format('%R') == "-")
				{
					throw new self::$myExceptionClass("Trying to set 'to' to a greater value than 'from'!");
					// reverse the order if to is smaller than from ? 
					//$this -> from = $this -> to;
					//$this -> to = $value;
				}
				else
				{
					parent::__set($_property, $value);
				}
				//*echo "\n\nDIFF_SIGN: " . $diff -> format('%R') . "\n";
			
			}
			else
			{
				// this is the first one of to and from that has been set.
				// Just st it and wait for the other one.
				//echo "\n\nSetting: " . $_property . " while sibling is still empty\n";
				parent::__set($_property, $value);
				
			}
    	
    	}
		
	}

}

?>