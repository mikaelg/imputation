<?php namespace Common;

abstract class Organisation extends Entity
{

	protected static $myExceptionClass = 'Common\OrganisationException';
	
	protected static $fields = Array(	"id"				=> Array("type" =>"integer",					"mandatory" => true),
										"name" 				=> Array("type" =>"string", 					"mandatory" => true),
										"addresses"			=> Array("type" =>"Common\AddressCollection", 	"mandatory" => true),
										"employees"			=> Array("type" =>"Common\PersonCollection", 	"mandatory" => true)
								);
    
    public $id;
    public $name;
    public $addresses;
    public $employees;
}

?>