<?php namespace Common;


abstract class Collection extends \SplObjectStorage
{
	
	protected static $myExceptionClass = 'Common\CollectionException';

	/**
     * This function overrrides the method defined in SplObjectStorage, because we only want Address objects here.
     * 
     *
     * @access 					public
     * @param	$_addressObject	Object with address data.
     * @return 					No value is returned.
     */
	public function attach($_addressObject, $data = NULL)
	{
		if(get_class($_addressObject) != 'Common\Address')
		{
			$ccls = get_called_class();
			throw new $ccls::$myExceptionClass('Tried to add a ' . get_class($_addressObject) . ' to a ' . __CLASS__);
		}
		else
		{
			parent::attach($_addressObject, $data);
		}
	}
	
	
	
	public function getElementById($_id)
	{
		foreach($this as $o)
		{
			if($o -> id == $_id)
			{
				return $o;
			} 
		}
	}


}

?>