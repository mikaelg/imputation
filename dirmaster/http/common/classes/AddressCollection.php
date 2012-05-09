<?php namespace Common;

/**
* This class is used to contain Address objects. the SPL class SplObjectStorage provides this functionality
* by default, so we can extend that. The need for a separate getMembers method is not necessary since the
* SplObjectStorage object implements Iterable, so you can use it directly in a foreach loop. Chances are 
* (so I've read on the internet) that you have to issue a rewind() call before you can iterate it, but we'll 
* see what happens soon enough :).
* 
* 
*/

class AddressCollection extends \SplObjectStorage
{
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
			throw new AddressCollectionException('Tried to add a ' . get_class($_addressObject) . ' to a ' . __CLASS__);
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