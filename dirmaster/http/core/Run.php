<?php namespace be\imputation;

class Run {
	function __construct() {
		
		$controller = strval($_GET['controller']);
		Debugger :: debug_echo( 'test run: ' . $controller . '<br />');
		
		if($this -> is_valid_controller_from_db($controller))
		{
			/**
			 * check controller name in cache_controllers table from db
			 */
			 Debugger :: debug_echo('Database knows ' . $controller . '. Success!' );
			 
			 
		}
		elseif($this -> is_valid_controller_from_controller_dir($controller))
		{
			Debugger :: debug_echo('Database doesn\'t know ' . $controller . ' but it\'s a file in the controllers dir!');
			
			Debugger :: debug_echo('Let\'s add it to the database: ');
			
			
			echo ($this -> add_controller_to_db($controller)) ? 'Success' : 'Fail';
			
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

		$candidate_file = './controller/' . $_candidate_controller . 'Controller.php';
		//echo realpath($candidate_file);
		return(file_exists($candidate_file));
		
		
	
	}
}
