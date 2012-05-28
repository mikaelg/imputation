<?php namespace be\imputation;

/**
 * check imput
 * @author gyselinckmikael
 *
 */
class  Sanitize {
	
	
	private static function cast(&$_value,$_type)
	{
		switch($_type)
		{
			case 'string':
			case 'str':
				$_value = (string) strval($_value);
			break;
			
			case 'integer':
			case 'int':
				$_value = (int) intval($_value);
			break;
			
			case 'float':
			case 'double':
				$_value = (float) floatval($_value);
			break;
			
			case 'boolean':
			case 'bool':
				$_value = self :: toBool($_value);
			break;
			
			default:
				throw new \Exception($_type . 'is an illegal type.');
			break;
		}
		
		
	}
	
	public static function checkSanity($_value,$_type,$_length=100)
	{
		if(is_null($_value) || empty($_value))
		{
			return false;
		}
		else
		{
			self::cast($_value,$_type);

			if(strlen($_value) > $_length)
			{
				echo "Too long! ";
				return false;
			}
			else
			{
				return true;
			}
		}
		
	}
	
	public static function checkDateSanity($_value)
	{
		// delimiters in separate array to be able to add/modify the supported input delimiters
		$supportedInputDelimiters = array('-','_','|');
		
		// initialize the SUPported INPut DELimiters presence flag to false
		$supInpDel_present = false;
		
		// Loop through supported input delimiters and see if the input has two similar ones in one run.
		// By doing a boolean OR function with the substr_count === 2 result (also bool), 
		// one hit will set the result to true forever, no matter what the other comparisons
		// come up with.		
		foreach($supportedInputDelimiters as $dlmtr)
		{
			$supInpDel_present = $supInpDel_present || (substr_count($_value, $dlmtr) === 2);
		}
		
		
		if(!$supInpDel_present)
		{
			return false;
		}
		else
		{
			$realDelim = '/';
			$_value = str_replace($supportedInputDelimiters, $realDelim, $_value);
			$dateparts = explode($realDelim, $_value);
			
			if(checkdate($dateparts[1], $dateparts[0], $dateparts[2]))
			{
				return $dateparts[2].$realDelim.$dateparts[1].$realDelim.$dateparts[0];
			}
			else
			{
				return false;
			}
		}
			
	}
	
	public static function toBool($_nb)
	{
		return (intval($_nb) > 0);
	}
	
	
	public static  function  mig_checkSanity($_value,$_type,$_length)
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
	
	public static function mig_checkDateSanity($_value,$_type,$_length){
		if(!self::mig_checkSanity($_value,$_type,$_length))
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