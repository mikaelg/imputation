<?php namespace be\imputation;
//require_once 'core/Controller.php';

/**
 *
 * @author gyselinckmikael
 *
 */
abstract class AuthenticationController extends Controller{
	
	public function __construct($_controller,$_args  = array()){
		
		/**
		 * check login and uid against database. 
		 * Should this be done in a AuthenticationModel ?
		 * Don't know if this is OK by MVC police?
		 */
		
		$userid = "12345";
		$loginName = "mig";
		
		parent::__construct($_controller,$_args);
		
		if(isset($_SESSION['loginsession']) && $_SESSION['loginsession'] == $userid.'#'.md5($loginName.$userid.$_SERVER['REMOTE_ADDR'])){
			parent::__construct($_controller);
		}
		else {
    		header("Location: /oeeeeps");
            return;
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