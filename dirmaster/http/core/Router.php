<?php namespace be\imputation;

class Router {
	
	private $route;
	
	function __construct($_arg) {
		
		if(!empty($_arg))
		$this->route = trim(strval($_arg['rt']));
		
		
	}
	
	public function getRouter() {
		if(empty($this->route))
			return false;
		else
			return $this->route;
	}
}
