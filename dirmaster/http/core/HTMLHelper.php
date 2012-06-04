<?php namespace be\imputation;

class HTMLHelperException extends \Exception{ }
 
class HTMLHelper
{
	public static function createLink($_uri, $_anchortext = null, $_target = "_self")
	{
		if(is_null($_anchortext))
		{
			$_anchortext = $_uri;
		}
		
		$legalTargetAttributeValues = array("_blank", "_self", "_parent", "_top");
		if(!in_array($_target,$legalTargetAttributeValues))
		{
			throw new HTMLHelperException("Illegal value provided for anchor target. If you used a frame name as a target, even more shame on you!");
			die();
		}
		
	
		return '<a href="' . $_uri . '" target="' . $_target . '">' . htmlentities($_anchortext) . '</a>';
	}
	
	public static function arrayToSelect($_selectName, $_optionValuesArray, $_defaultSelectedIndex = 0)
	{
		$retHtml = '<select name="' . $_selectName . '">' . "\n";
		
		foreach($_optionValuesArray as $val => $displayText)
		{
			$retHtml.=  '<option value="' . $val . '" ';
			$retHtml.=  $val == $_defaultSelectedIndex ? ' SELECTED' : '';
			$retHtml.= '>' . $displayText . '</option>' . "\n";
		}
		
		$retHtml.= '</select>' . "\n";
		
		return $retHtml;
		
	}
	
}