<?php namespace be\imputation;

/**
 * 
 * @author gyselinckmikael
 *
 */
class Router {
	
	private $route;
	private $args = array();
	
	function __construct($_arg) {
		
		
		if(!empty($_arg))
		{
			
			//$controller = htmlspecialchars($_arg['rt'], ENT_QUOTES);
			$_arg = explode('/',$_arg['rt']);
			$controller = htmlspecialchars($_arg[0], ENT_QUOTES);
			$this->route = ucfirst(trim(strval($controller)));
			$this->args = $_arg;
		}
		
		
	}
	
	public function getRouter() {
		if(empty($this->route))
			return false;
		else
			return $this->route;
	}
	
	public function getArgs(){
		return $this->args;
	}
}
