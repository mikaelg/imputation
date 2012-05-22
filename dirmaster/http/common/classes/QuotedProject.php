<?php namespace Common;

class QuotedProject extends Project
{
	protected static $myExceptionClass = 'Common\QuoteProjectException';
	
	private static $fields = Array(	"budget" 	=> Array("type" =>"integer",		"mandatory" => true)
										);
	
	protected $budget;

    
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