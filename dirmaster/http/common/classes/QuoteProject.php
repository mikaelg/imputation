<?php namespace Common;

class QuoteProject extends Project
{
	protected static $myExceptionClass = 'Common\QuotedProjectException';

	public function __construct(){
		$this->addProperty("budget", "integer", true);
		
		//print_r(self::$fields,false);
	}
}

?>