<?php namespace be\imputation;
//require_once 'core/Model.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class LoginModel extends AuthenticationModel {
	
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
			//print_r($this->checkInDatabse($loginName, $password));
			
			$result = $this->checkInDatabase($loginName,$password );
			
			//if($password != "test" || $loginName != "mig"){
			if($result === false){
				
				
				$warnings[] = "Your credentials are not found!";
				return $warnings;
			}
			else {
				// put user id in session.
				$userid = $result['loginid'];
				
				//session_start();
				$_SESSION['loginsession'] = self::createLoginSessionString($userid, $loginName);
				$_SESSION['fullname'] = $result['fullname'];
				//$_SESSION['userid'] = $userid;
				
				
				
				return true;
			}
		}
		
	
	}

	
	/*
	private function checkInDatabase($_uid, $_pwd){
		
		$encPwd = md5($_pwd);
		//print ("ENCRYPTED PASWORD: ".$encPwd . " STOP");
		
		$sql = "SELECT idPerson, loginname, password, name, firstname FROM persons WHERE loginname = :pruid AND password =  :prpwd";
		$stmt = $this -> dal -> prepare($sql);
		$stmt -> bindValue(':pruid', $_uid, \PDO::PARAM_STR);
		$stmt -> bindValue(':prpwd', $encPwd, \PDO::PARAM_STR);
		$stmt -> execute();
		$row = $stmt -> fetch();
		
		if(empty($row))
			return false;
		
		try {
			if(strtolower($row['loginname']) === strtolower($_uid) && $row['password'] === $encPwd ){
				$result = array();
				$result['loginid'] = $row['idPerson'];
				$result['fullname'] = $row['firstname']." ".$row['name'];
				return $result;
			}
		}
		catch (\Exception $e){
			return false;
		}
		 
		// if you ain't out of here yet, there definitely something wrong !!!!
		return false;
	}
	*/
	
}