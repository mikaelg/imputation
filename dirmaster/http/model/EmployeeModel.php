<?php namespace be\imputation;

class EmployeeModel extends Model {

	private $employeeId;
	private $p;
	
	public function __construct(){
		parent::__construct();
	}
	
	
	
	
	private function getEmployeeValuesById($_employeeId)
	{
		$sql = "SELECT empl.* FROM persons AS empl WHERE empl.idPerson = :empl_id AND isEmployee='1' LIMIT 1";
		$stmt = $this -> dal -> prepare($sql);
		$stmt -> bindValue(':empl_id', $_employeeId, \PDO::PARAM_STR);
		$stmt -> execute();
		$row = $stmt -> fetchAll();
		
		$this->empl = new \Common\Employee();
		
		$this -> getEmployeeData($this->empl);
		return $this->empl;
	}
	
	public function getEmployeeValues($_employeeLogin)
	{
		$sql = "SELECT empl.idPerson FROM persons AS empl WHERE empl.loginname = :empl_lgn AND isEmployee='1' LIMIT 1";
		$stmt = $this -> dal -> prepare($sql);
		$stmt -> bindValue(':empl_lgn', $_employeeLogin, \PDO::PARAM_STR);
		$stmt -> execute();
		$row = $stmt -> fetchAll();
		
		$this->employeeId = $row[0]["idPerson"];
		
		return $this->getEmployeeValuesById($row[0]["idPerson"]);
	}
	
	
	private function getEmployeeData(&$_emp_obj)
	{

		$sql = "SELECT empl.* FROM  `persons` as empl
				WHERE empl.idPerson = :empl_id LIMIT 1";
        $stmt = $this -> dal -> prepare($sql);
	    $stmt -> bindValue(':empl_id', $this->employeeId, \PDO::PARAM_STR);
	    $stmt -> execute();
	    $row = $stmt -> fetchAll();
	    
	    if($stmt -> errorCode() == "00000")
	    {
			$_emp_obj -> id 					= $row[0]["idPerson"];
			$_emp_obj -> lastname 				= $row[0]["name"];
			$_emp_obj -> firstname				= $row[0]["firstname"];
			$_emp_obj -> gender 				= is_null($row[0]["gender"]) ? '' : $row[0]["gender"];
			$_emp_obj -> employedSince			= new \DateTime($row[0]["startdateEmployment"]);
			return true;
		}
	    else
	    {
			throw new \Exception("Error #" . $stmt -> errorCode() . ' in query!');
			return false;
		}
	    
        
	}
	
	
	
	
	
	
}