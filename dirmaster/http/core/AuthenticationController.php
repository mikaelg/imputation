<?php namespace be\imputation;
//require_once 'core/Controller.php';

/**
 *
 * @author gyselinckmikael
 *
 */
abstract class AuthenticationController extends Controller{
	
	public function __construct($_controller,$_args  = array()){
		
	
		parent::__construct($_controller,$_args);
		
		/**
		 * check login and uid form loginsession against database.
		 */
		
		$amodel = new AuthenticationModel();
		
		
		if(isset($_SESSION['loginsession']) && $amodel->checkLoginSession($_SESSION['loginsession'], $_SERVER['REMOTE_ADDR'])  ){
			parent::__construct($_controller);
		}
		else {
    		//header("Location: /oeeeeps");
            //return;
			$this->setNewView("AccessDenied");
		}
			
	}
	
	public static function getFullUserName(){
		if(isset($_SESSION['fullname']))
			return $_SESSION['fullname'];
		else 
			return "NO USERNAME SET";
	}
	
	public static function loginStatus(){
		
		if(isset($_SESSION['loginsession'])){
			return true;
		}
		else {
			return false;
		}		
	}
	
	public static function  logout(){
		if(self::loginStatus()){
			unset($_SESSION['loginsession']);
		}
	}

}