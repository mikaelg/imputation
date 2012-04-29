<?php namespace be\imputation;

//require_once 'core/Router.php';
//require_once 'controller/home.php';

class Run extends Router {
	//const HOMEPAGE = "home";
	
	function __construct() {
		parent::__construct($_GET);
		
		
		//Debugger :: debug_echo( 'test run: ' . $this->getRouter() . '<br />');
		
		if(!$this->getRouter()){
			/**
			 * this must be the homepage since there's no controller specified
			 */
			//Debugger :: debug_echo('dabug :: homepage');
			
			
			if(file_exists('controller/home.php')) {
				
				$t = new Home_controller('home');
				$t->getView();
			}
			else {
				print('FOAD');
			}
				 	
		}
		elseif($this -> is_valid_controller_from_db($this->getRouter()))
		{
			/**
			 * check controller name in cache_controllers table from db
			 */
			 Debugger :: debug_echo('Database knows ' . $this->getRouter(). '. Success!' );
			 
			 
			 
		}
		elseif($this -> is_valid_controller_from_controller_dir($this->getRouter()))
		{
			Debugger :: debug_echo('Database doesn\'t know ' . $this->getRouter() . ' but it\'s a file in the controllers dir!');
			Debugger :: debug_echo('Let\'s add it to the database: ');
			
			
			//echo ($this -> add_controller_to_db($this->getRouter())) ? 'Success' : 'Fail';
			
			/**
			 * if controller not exists > check contoller in dir controller
			 * if exists in dir controller add to cache_controllers
			 * if not exists > 404
			 */
			

			 
			
		}	
		else
		{
			Debugger :: debug_echo('This is no real controller; it\'s fake!');
			
			/**
			 * if not exists > 404
			 */
			echo '<br />404 : page not found';
		}
		
	}
	
	private function is_valid_controller_from_db($_candidate_controller)
	{

		$sql = "SELECT id FROM cache_controllers WHERE this is dummy code because that table doesn't exist yet so let's assume something";

		return false;
		

	}
	
	private function add_controller_to_db($_candidate_controller)
	{

		$sql = "INSERT INTO cache_controllers SET this is dummy code because that table doesn't exist yet so let's assume that the controller was found for now";
		return true;
		

	}
	
	private function is_valid_controller_from_controller_dir($_candidate_controller)
	{

		//$candidate_file = './controller/' . $_candidate_controller . 'Controller.php';
		//echo realpath($candidate_file);
		//return(file_exists($candidate_file));
		
		if(file_exists('controller/'.$this->getRouter().'.php')) {
			//.....
		}
	
	}
}
