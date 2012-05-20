<?php namespace be\imputation;

/**
 * check imput
 * @author gyselinckmikael
 *
 */
class  Sanitize {
	
	public static  function  checkSanity($_value,$_type,$_length)
	{
		$isType = 'is_'.$_type;
		
		if(!$isType($_value)){
			return false;
		}
		elseif(empty($_value)){
			return false;
		}
		elseif(strlen($_value) > $_length){
			return false;
		}
		else {
			return true;
		}
	}
	
	public static function checkDateSanity($_value,$_type,$_length){
		if(!self::checkSanity($_value,$_type,$_length))
			return;
		
		$delim = '/';
		$_value = str_replace(array('-','_','|'), $delim, $_value);
		$dateparts = explode($delim, $_value);
		
		if(checkdate($dateparts[1], $dateparts[0], $dateparts[2]))
			return $dateparts[2].$delim.$dateparts[1].$delim.$dateparts[0];
		else
			return;
		
	}
	
}