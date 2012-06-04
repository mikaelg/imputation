<?php namespace Common;

class Address extends Entity
{
	protected static $myExceptionClass = 'Common\AddressException';
	
	private static $fields = Array(	"id"				=> Array("type" =>"integer",	"mandatory" => true),
										"country" 			=> Array("type" =>"string", 	"mandatory" => true),
										"city"				=> Array("type" =>"string", 	"mandatory" => true),
										"street"			=> Array("type" =>"string", 	"mandatory" => true),
										"number"			=> Array("type" =>"string", 	"mandatory" => true),
										"box"				=> Array("type" =>"string", 	"mandatory" => false),
										"province" 			=> Array("type" =>"string", 	"mandatory" => true),
										"organisationId" 	=> Array("type" =>"integer",	"mandatory" => true),
										"addressTypeId"		=> Array("type" =>"integer",	"mandatory" => true),
								);
							
	protected $id;
	protected $country; 			
	protected $city;			
	protected $street;
	protected $number;
	protected $box;
	protected $province;
	protected $organisationId;
	protected $addressTypeId;
	
	final public static function getFieldsArray()
    {
    	return self::$fields;
    }
	
}
?>