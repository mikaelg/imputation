<?php namespace be\imputation;


//require_once 'core/Router.php';
//require_once 'controller/home.php';
//require_once 'controller/404.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Run extends Router {
	//const HOMEPAGE = "home";
	
	function __construct() {
		session_start();
		parent::__construct($_GET);
		
		/**
		 * CACHING WERKEN WE HIER NIET UIT : is een db lookup sneller dan een file_Exists?
		 * lijk met wel interessant als de hele pagina wordt gecached.
		 * 
		 * check controller in db
		 * if controller not exists > check contoller in dir controller
		 * if exists in dir controller add to cache_controllers
		 * if not exists > 404
		 */
		
		if(!$this->getRouter()){
			/**
			 * this must be the homepage since there's no controller specified
			 */
			
			
			if(file_exists('controller/HomeController.php')) {
				
				$t = new HomeController('Home');
				$t->getView();
			}
			else {
				print('FOAD');
			}
				 	
		}
		else
		{


			if(file_exists('controller/'.$this->getRouter().'Controller.php')) {
				
				//require_once 'controller/'.$this->getRouter().'.php';
				$t;
				
				
				/**
				 * public pags
				 */
				$class = __NAMESPACE__.'\\'.$this->getRouter().'Controller';
				$t = new $class($this->getRouter(),$this->getArgs());
				
				/*
				switch ($this->getRouter()) {
					case 'Login':
						$t = new Login_controller($this->getRouter());
						break;
					case 'Home':
						$t = new Home_controller($this->getRouter());
						break;
					case 'Overview':
						$t = new Overview_controller($this->getRouter());
						break;
					case 'Project':
						$t = new Project_controller($this->getRouter());
						break;
				}
				*/
					
				
				
				$t->getView();
				
			}
			else
			{
				print('rerutn 404 error page');
			}
			

			 
			
		}	
		
	}
	

}
