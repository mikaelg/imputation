<?php namespace Common;

class Employee extends Person
{

	protected static $myExceptionClass = 'Common\EmployeeException';
	
	
	protected static $fields = Array(	"functionDescription" 	=> Array("type" =>"string",		"mandatory" => /*true*/false),
										"employedSince" 		=> Array("type" =>"\DateTime",	"mandatory" => true)
										);

	
    protected $functionDescription;
    protected $employedSince;
    
    /**
     * this function overrides Entity::getFieldsArray(), because Employee needs to merge Person's $fields
     * array with its own complementary fields
     *
     * @access 					public
     * @author 					Jos Bolssens <marvelade@gmail.com>
     * @return 					Array
     */
    public static function getFieldsArray()
    {
    	return array_merge(parent::$fields, self::$fields);
    }

}

?>