<?php namespace be\imputation;
require_once 'core/Controller.php';

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
		
		if(isset($_SESSION['loginsession']) && $_SESSION['loginsession'] != $userid.'#'.md5($loginName.$userid.$_SERVER['REMOTE_ADDR'])){
			//parent::__construct($_controller);
		}
		else {
		
		//header("Location: ?rt=oeeeeps");
		return;
		}
			
	}

}