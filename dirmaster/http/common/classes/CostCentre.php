<?php namespace Common;

class CostCentre extends Entity
{

	protected static $myExceptionClass = 'Common\CostCentreException';
	
	private static $fields = Array(		"id"				=> Array("type" =>"integer",	"mandatory" => true),
										"shorthand" 		=> Array("type" =>"string", 	"mandatory" => true),
										"description"		=> Array("type" =>"string", 	"mandatory" => true),
			);
									
	
    protected $id;
	protected $shorthand;
	protected $description;
	
	final public static function getFieldsArray()
    {
    	return self::$fields;
    }



} 

?>