<?php namespace be\imputation;

/**
 * 
 * @author gyselinckmikael
 *
 */
class Router {
	
	private $route;
	private $location;
	private $args = array();
	
	function __construct($_arg) {
		
		
		if(!empty($_arg))
		{	
			
			//$controller = htmlspecialchars($_arg['rt'], ENT_QUOTES);
			$_arg = explode('/',$_arg['rt']);
			
			//remove empty values from arguments
			foreach ($_arg as $k=>$v) {
				if(empty($v))
					unset($_arg[$k]);
			}
			$_arg = array_values($_arg);  // reindex the array
			
			// check if the first argument is location or controller
			$contrArg = 0;
			if(Settings::IsValidLocation($_arg[0])) {
				$contrArg = 1;
				$this->location = $_arg[0];
			}
			else {
				$this->location = Settings::DefaultLocation();
			}

			
			$controller = htmlspecialchars($_arg[$contrArg], ENT_QUOTES);
			$this->route = ucfirst(trim(strval($controller)));
			
			unset($_arg[$contrArg]); // remove controler item at index 0
			$this->args = array_values($_arg); // reindex the array
		}
		
		
	}
	
	public function getRouter() {
		if(empty($this->route))
			return false;
		else
			return $this->route;
	}
	
	public function getLocation(){
		if(empty($this->location))
			return false;
		else
			return $this->location;		
	}
	
	public function getArgs(){
		if(empty($this->args))
			return;
		else
			return $this->args;
	}
}
