<?php namespace Common;


class EmailAddress extends Entity
{
	protected static $myExceptionClass = 'Common\EmailAddressException';
	
	protected static $fields = Array(	"id"				=> Array("type" =>"integer",	"mandatory" => true),
										"email"				=> Array("type" =>"string",		"mandatory" => true),
								);
							
	protected $id;
	protected $email;
	
		
}
?>