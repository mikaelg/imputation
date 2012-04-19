<?php namespace be\imputation;

class Run {
	function __construct() {
		
		$controller = $_GET['controller'];
		
		
		if(!empty($controller)) {
			echo "test run: $controller";
			
			/**
			 * check controller name in cache_controllers table from db
			 * if controller not exists > check contoler in dir controller
			 * if exists in dir controller add to cache_controllers
			 * if not exists > 404
			 */
			
		}	
		else
			echo "404 : page not found";
		
		
	}
}
