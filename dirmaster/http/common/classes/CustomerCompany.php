<?php namespace Common;

class CustomerCompany extends Organisation
{
	protected static $myExceptionClass = 'Common\CustomerCompanyException';
	
	// Leave this empty for now, but it's open for extension
	private static $fields = Array();

	final public static function getFieldsArray()
    {
    	return array_merge(parent::getFieldsArray(), self::$fields);
    }
}
?>