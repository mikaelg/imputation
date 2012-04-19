<?php namespace be\imputation;

class Run {
	function __construct() {
		
		$controler = $_GET['controler'];
		
		
		if(!empty($controler)) {
			echo "test run: $controler";
			
			/**
			 * check controler name in cache_controlers table from db
			 * if controler not exists > check contoler in dir controler
			 * if exists in dir controler add to cache_controlers
			 * if not exists > 404
			 */
			
		}	
		else
			echo "404 : page not found";
		
		
	}
}