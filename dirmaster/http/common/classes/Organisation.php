<?php namespace Common;

abstract class Organisation extends Entity
{

	protected static $myExceptionClass = 'Common\OrganisationException';
	
	protected static $fields = Array(	"id"				=> Array("type" =>"integer",					"mandatory" => true),
										"name" 				=> Array("type" =>"string", 					"mandatory" => true),
										"addresses"			=> Array("type" =>"\ArrayObject", 				"mandatory" => true),
										"employees"			=> Array("type" =>"\ArrayObject", 	"mandatory" => true)
								);
    
    public $id;
    public $name;
    public $addresses;
    public $employees;
}

?>