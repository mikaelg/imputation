<?php namespace be\imputation;

/**
 * 
 * @author gyselinckmikael
 *
 */
class Router {
	
	private $route;
	
	function __construct($_arg) {
		
		
		if(!empty($_arg))
		{
			$controller = htmlspecialchars($_arg['rt'], ENT_QUOTES);
			$this->route = ucfirst(trim(strval($controller)));
		}
		
		
	}
	
	public function getRouter() {
		if(empty($this->route))
			return false;
		else
			return $this->route;
	}
}
