<?php namespace Common;


abstract class Collection extends \SplObjectStorage
{
	
	protected static $myExceptionClass = 'Common\CollectionException';
	

	/**
     * This function overrrides the method defined in SplObjectStorage, because we only want 
     * the correct objects here. get_called_class() will hold the ...Collection class name 
     * and if all goes well, so will {get_class($_candidate_object)."Collection"}. This way
     * an AddressCollection will only hold Address objects, a PersonCollection will only hold
     * Person objects, etc. Linguistically you can argue if the word before "Collection" needs
     * to be plural, but that's not really an issue IMHO.
     * 
     *
     * @access 						public
     * @param	$_candidate_object	Object with address data.
     * @return 						No value is returned.
     */
	public function attach($_candidate_object, $data = NULL)
	{
		$ccls = get_called_class();
		if( (get_class($_candidate_object)."Collection") != $ccls)
		{
			
			throw new $ccls::$myExceptionClass('Tried to add a ' . get_class($_candidate_object) . ' to a ' . $ccls);
		}
		else
		{
			parent::attach($_candidate_object, $data);
		}
	}
	
	
	/**
     * This function will get an item out of the collection by its id, assumed that every Entity
     * has an id property
     * 
     *
     * @access 						public
     * @param	$_candidate_object	Object with address data.
     * @return 						No value is returned.
     */
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