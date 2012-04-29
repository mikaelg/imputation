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
	
}