<?php namespace be\imputation;

class AuthenticationModel extends Model {
	
	final public function checkLoginSession($_loginSession,$_remoteAddress){
		//$_SESSION['loginsession'] == $userid.'#'.md5($loginName.$userid.$_SERVER['REMOTE_ADDR'])
		
		$arr = explode("#", $_loginSession);
		
		if(empty($arr))
			return false;

		$sql = "SELECT idPerson, loginname, password, name, firstname FROM persons WHERE idPerson = :prid";
		$stmt = $this -> dal -> prepare($sql);
		$stmt -> bindValue(':prid', $arr[0], \PDO::PARAM_INT);
		$stmt -> execute();
		$row = $stmt -> fetch();

		if(empty($row))
			return false;
		
		try {
			if($arr[1] === md5($row['loginname'].$row['idPerson'].$_remoteAddress))
				return true;
			else 
				return false;

		}
		catch (\Exception $e){
			return false;
		}
		
		// if you ain't out of here yet, there definitely something wrong !!!!
		return false;
	}
	
	
	
	final protected function checkInDatabase($_uid, $_pwd){
	
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
	
}
