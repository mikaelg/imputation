<?php namespace be\imputation;
//require_once 'core/Model.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class LogoutModel extends Model {
	
	public function __construct(){

		
	} 
	
	public function generateFormGuid(){
		//print("FROM CONSTRUCTOR Login_model");
		// Deze dienen we on-the-fly te genereren wanneer pagin voor eerste keer wordt opgeroepen.
		if(!isset($_POST['formGuid'])){
			return '1234567890';
		}
	}
	
	public function Logout()
	{
		//session_unset();
		//session_destroy();
		
		AuthenticationController::logout();
		// return the oposite : if loginStatus is logged in (= true) return false ...
		if(AuthenticationController::loginStatus())
			return false;
		else	
			return true

	}
	
	
}