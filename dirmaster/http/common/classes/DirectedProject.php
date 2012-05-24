<?php namespace Common;

class DirectedProject extends Project
{
	protected static $myExceptionClass = 'Common\DirectedProjectException';
	
	private static $fields = Array();
	
	/**
     * this function overrides Project::getFieldsArray(), because QuotedProject needs to merge Project's $fields
     * array with its own complementary fields
     *
     * @access 					public
     * @author 					Jos Bolssens <marvelade@gmail.com>
     * @return 					Array
     */
    final public static function getFieldsArray()
    {
    	return array_merge(parent::getFieldsArray(), self::$fields);
    }
}

?>