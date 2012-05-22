<?php namespace Common;

class Contact extends Person
{
	protected static $myExceptionClass = 'Common\ContactException';
	
	// Leave this empty for now, but it's open for extension
	private static $fields = Array();


    
    /**
     * this function overrides Entity::getFieldsArray(), because Contact needs to merge Person's $fields
     * array with its own complementary fields
     *
     * @access 					public
     * @author 					Jos Bolssens <marvelade@gmail.com>
     * @return 					Array
     */
    final public static function getFieldsArray()
    {
    	return array_merge(parent::$fields, self::$fields);
    }
}

?>