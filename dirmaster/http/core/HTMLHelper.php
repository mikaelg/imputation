<?php namespace be\imputation;

class HTMLHelperException extends \Exception{ }
 
class HTMLHelper
{
	public static function createLink($_uri, $_anchortext = null, $_target = "_self", $_cssclass = null)
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
		
		$cssclass = "";
		if(!is_null($_cssclass))
			$cssclass = 'class="$_cssclass"';
	
		return '<a href="' . $_uri . '" target="' . $_target . '"' . $cssclass .'>' . htmlentities($_anchortext) . '</a>';
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
	
	public static function mig_createlink($_args  = array()){
		$href = "";
		$target = "";
		$legalTargetAttributeValues = array("_blank", "_self", "_parent", "_top");
		$class = "";
		$id = "";
		$style = "";
		$text = "";
		
		if(isset($_args['text']))
			$text = htmlentities($_args['text']);
		else
			throw new HTMLHelperException("must provide a text for the hyperlink");
			
			
		foreach ($_args as $a => $v) {

			switch($a){
				case "href":
					$href = 'href="'.$v.'" ';
					break;
				case "class":
					$class = 'class="' . $v . '" ';
					break;
				case "id":
					$id = 'id="' . $v . '" ';
					break;
				case "style":
					$style = 'style="' . $v . '" ';
					break;
				case "target":
					if(!in_array($_target,$legalTargetAttributeValues))
						throw new HTMLHelperException("Illegal value provided for target.");
					else
						$target = 'target="'. $v .'" ';
					break;
			}
		}
		
		return '<a ' . $href  . $target . $id . $class . $style .'>' . $text . '</a>';
		
	}
	
}