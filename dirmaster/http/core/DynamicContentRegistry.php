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

	public function __set($key, $val) {
		$this->dynamicContent[$key] = $val;
	}
	
	public function __get($key)
	{
		if (array_key_exists($key, $this->dynamicContent)) {
			return $this->dynamicContent[$key];
		}
	
		//  throw an exception
		throw new OutOfBoundsException($key);
	}
}