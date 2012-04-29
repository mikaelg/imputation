<?php namespace be\imputation;

require_once 'core/Router.php';
require_once 'controller/home.php';
//require_once 'controller/404.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Run extends Router {
	//const HOMEPAGE = "home";
	
	function __construct() {
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
			
			
			if(file_exists('controller/home.php')) {
				
				$t = new Home_controller('home');
				$t->getView();
			}
			else {
				print('FOAD');
			}
				 	
		}
		else
		{
			//print($this->getRouter());
			/**
			 * NEED SOME DYNAMIC CLASS INSTANTIATION HERE !!!!!!!!!!!!!
			 * 
			 */

			if(file_exists('controller/'.$this->getRouter().'.php')) {
				
				require_once 'controller/Login.php';
				
				$t = new Login_controller($this->getRouter());
				$t->getView();
				
			}
			else
			{
				print('rerutn 404 error page');
			}
			

			 
			
		}	
		
	}
	

}
