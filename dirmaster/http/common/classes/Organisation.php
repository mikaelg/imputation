<?php namespace Common;

abstract class Organisation extends Entity
{

	protected static $myExceptionClass = 'Common\OrganisationException';
	
	private static $fields = Array(	"id"				=> Array("type" =>"integer",					"mandatory" => true),
										"name" 				=> Array("type" =>"string", 					"mandatory" => true),
										"addresses"			=> Array("type" =>"\ArrayObject", 				"mandatory" => /*true*/false),
										"employees"			=> Array("type" =>"\ArrayObject", 				"mandatory" => /*true*/false)
								);
    
    protected $id;
    protected $name;
    protected $addresses;
    protected $employees;
    
    public static function getFieldsArray()
    {
    	return self::$fields;
    }
}

?>