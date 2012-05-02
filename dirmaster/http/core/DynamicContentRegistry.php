<?php namespace be\imputation;
/**
 * usage
 * 
 * SET::
 * $registry = new DynamicContentRegistry;
 * $registry->foo = "foo";
 * 
 * GET::
 * $foo = $registry->foo;
 * 
 * @author gyselinckmikael
 *
 */

class DynamicContentRegistry {

	private $dynamicContent = array();

	/**
	 * add value, update not allowed > use update function
	 * @param unknown_type $key
	 * @param unknown_type $val
	 * @return boolean
	 */
	public function __set($key, $val) {
		
		if(array_key_exists($key, $this->dynamicContent))
			return false;
		else
		{
			$this->dynamicContent[$key] = $val;
			return true;
		}
	}
	
	public function __get($key)
	{
		if (array_key_exists($key, $this->dynamicContent)) {
			return $this->dynamicContent[$key];
		}
	
		//  throw an exception
		//throw new OutOfBoundsException($key);
		return false;
	}
	
	/**
	 * Update regsitry value
	 * @param unknown_type $_key
	 * @param unknown_type $_value
	 */
	public function update($_key,$_value){
		$this->dynamicContent[$key] = $val;
	}
}