<?php namespace be\imputation;
//require_once 'core/Model.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class LoginModel extends Model {
	
	public function __construct($_args  = array()){
		parent::__construct($_args);
	} 
	

	
	public function loginStatus(){
		return AuthenticationController::loginStatus();
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
		if(isset($this->formvars['formGuid']) && Sanitize::checkSanity($this->formvars['formGuid'], 'string')){
			$formGuid = $this->formvars['formGuid'];
			if($formGuid != '1234567890')
				throw new Exception("fatal form error!");
		}
		else 
			return;
		
		if(isset($this->formvars['loginName']) && Sanitize::checkSanity($this->formvars['loginName'], 'string')){
			$loginName = $this->formvars['loginName'];
		}
		else {
			$warnings[] = "Loginname is not valid";
		}
		
		if(isset($this->formvars['password']) && Sanitize::checkSanity($this->formvars['password'], 'string', 20)){
			$password = $this->formvars['password'];
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
				$userid = "12345";
				
				//session_start();
				$_SESSION['loginsession'] = $userid.'#'.md5($loginName.$userid.$_SERVER['REMOTE_ADDR']);
				
				
				return true;
			}
		}
		
	
	}
	
}