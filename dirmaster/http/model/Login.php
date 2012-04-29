<?php namespace be\imputation;
require_once 'core/Model.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Login_model extends Model {
	
	public function __construct(){
		//print("FROM CONSTRUCTOR Login_model");
	} 
	
	public function checkLoginCredentials()
	{
		$formGuid;
		$loginName;
		$password;
		$warnings = array();
		
		
		/**
		 * sanitize your imput!
		 * 
		 * if formGuid is not set there was no post => quit
		 * if formGuid is set check if it is valid or throw exception.
		 */
		if(isset($_POST['formGuid']) && Sanitize::checkSanity($_POST['formGuid'], 'string', 100)){
			$formGuid = $_POST['formGuid'];
			if($formGuid != '1234567890')
				throw new Exception("fatal form error!");
		}
		else 
			return;
		
		if(isset($_POST['loginName']) && Sanitize::checkSanity($_POST['loginName'], 'string', 100)){
			$loginName = $_POST['loginName'];
		}
		else {
			$warnings[] = "Loginname is not valid";
		}
		
		if(isset($_POST['password']) && Sanitize::checkSanity($_POST['password'], 'string', 20)){
			$password = $_POST['password'];
		}
		else {
			$warnings[] = "Password is not valid";
		}
		
		if(count($warnings) > 0){
			return $warnings;
		}
		else {
			/**
			 * TODO check against database
			 */
			if($password != "test" || $loginName != "mig"){
				
				$warnings[] = "Your credentials are not found!";
				return $warnings;
			}
			else {
				// put user id in session.
				return true;
			}
		}
		
	
	}
	
}