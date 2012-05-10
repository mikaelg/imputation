<?php namespace Common;

class Person extends Entity
{

	protected static $myExceptionClass = 'Common\PersonException';
	
	protected static $fields = Array(	"id"				=> Array("type" =>"integer",						"mandatory" => true),
										"lastname" 			=> Array("type" =>"string", 						"mandatory" => true),
										"firstname"			=> Array("type" =>"string", 						"mandatory" => true),
										"gender"			=> Array("type" =>"string", 						"mandatory" => true),
										"emailaddresses"	=> Array("type" =>"Common\EmailAddressCollection", 	"mandatory" => true),
										"addresses"			=> Array("type" =>"Common\AddressCollection", 		"mandatory" => false),
										"status" 			=> Array("type" =>"string", 						"mandatory" => true),
								);
	
	protected $id;
	protected $lastname;
	protected $firstname;
	protected $gender;
	protected $emailadresses;
	protected $adresses;
	protected $status;




}

?>