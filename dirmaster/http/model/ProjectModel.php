<?php namespace be\imputation;

class ProjectModel extends Model {

	const FETCH_IMPUTATIONABLE_PROJECTS = 1;
	const FETCH_NON_IMPUTATIONABLE_PROJECTS = 2;
	const FETCH_ALL = 2;
	

	private $p;
	
	public function __construct(){
		parent::__construct();
	}
	
	public static function getProjects($_mode = self::FETCH_IMPUTATIONABLE_PROJECTS)
	{
		switch($_mode)
		{
			case self::FETCH_IMPUTATIONABLE_PROJECTS:
			default:
				$cond = " p.idProjectStatus = 1 ";
			break;
			
			case self::FETCH_NON_IMPUTATIONABLE_PROJECTS:
				$cond = " p.idProjectStatus IN (2,3) ";
			break;
			
			case self::FETCH_ALL:
				$cond = " 1 ";
			break;
			
			
		}
	
		$sql = "SELECT p.idProject FROM projects AS p WHERE " . $cond . " ";
		
		//echo $sql;
		
		$stmt = self::createDal() -> prepare($sql);
		$stmt -> execute();
		
		$retArr = array();
		$row = $stmt -> fetchAll();
		foreach ($row as $data)
		{
			$retArr[] = self::getProjectValuesById($data['idProject']);
		}
		
		//echo count($retArr) . " projects in query!";
		
		return $retArr;
		
		
	}
	
	public static function getProjectValuesById($_projectID){
		$sql = "SELECT p.budget FROM projects AS p WHERE p.idProject = :prid LIMIT 1";
		$stmt = self::createDal() -> prepare($sql);
		$stmt -> bindValue(':prid', $_projectID, \PDO::PARAM_INT);
		$stmt -> execute();
		$row = $stmt -> fetchAll();
		

		
		//let the project factory determine what kind of object to return
		$pf = new \Common\ProjectsFactory();
		$p = $pf->getProject($row[0]["budget"]);
		$p->id = $_projectID;
		
		//echo "budget = ".$this->p->budget;
		
		
		self::getProjectData($p);
		self::getProjectTeamMembers($p);
		self::getCustomerCompany($p);
		self::getProjectContacts($p);
		
		return $p;		
	}
	
	public static function getProjectValues($_projectName)
	{
		
		$sql = "SELECT p.idProject, p.budget FROM projects AS p WHERE p.name = :prnm LIMIT 1";
		$stmt = self::createDal() -> prepare($sql);
		$stmt -> bindValue(':prnm', $_projectName, \PDO::PARAM_STR);
		$stmt -> execute();
		$row = $stmt -> fetchAll();

		
		return self :: getProjectValuesById($row[0]["idProject"]);
		
	}
	

	private static function getProjectData(&$_proj_obj){

        
		
		
		$sql = "SELECT p.*, c.name AS customerName, ps.name AS projectStatus, pt.name AS projectType FROM projects AS p 
				JOIN projectstatuses AS ps 
					ON 	ps.idProjectStatus = p.idProjectStatus
				JOIN projecttypes AS pt
					ON pt.idProjectType = p.idProjectType
				JOIN companies AS c
					ON c.idCompany = p.idCompany
				WHERE p.idProject = :prid LIMIT 1";
        $stmt = self::createDal() -> prepare($sql);
	    $stmt -> bindValue(':prid', $_proj_obj->__get('id'), \PDO::PARAM_STR);
	    $stmt -> execute();
	    $row = $stmt -> fetchAll();
	    

	    	
	       
	    
	    if($stmt -> errorCode() == "00000")
	    {
			$_proj_obj -> id 				= $row[0]["idProject"];
			$_proj_obj -> name 				= $row[0]["name"];
			$_proj_obj -> startDate			= new \DateTime($row[0]["startdate"]);
			$_proj_obj -> endDate 			= is_null($row[0]["enddate"]) ? null :  new \DateTime($row[0]["enddate"]);
			$_proj_obj -> type				= $row[0]["projectType"];
			$_proj_obj -> status			= $row[0]["projectStatus"];

			return true;
		}
	    else
	    {
			throw new \Exception("Error #" . $stmt -> errorCode() . ' in query!');
			return false;
		}
	    
        
	}
	
	private static function getCustomerCompany(&$_proj_obj){

        $sql = "SELECT c.*, a.* FROM projects AS p 
				JOIN companies AS c
					ON c.idCompany = p.idCompany
				JOIN companyaddresses AS ca
					ON ca.idCompany = p.idCompany
				JOIN addresses AS a
					ON a.idAddress = ca.idAddress
				WHERE p.idProject = :prid LIMIT 1";
        $stmt = self::createDal() -> prepare($sql);
	    $stmt -> bindValue(':prid', $_proj_obj->__get('id'), \PDO::PARAM_INT);
	    $stmt -> execute();
	    $row = $stmt -> fetchAll();
	    
	    
	    
	    if($stmt -> errorCode() == "00000")
	    {
			
			$cst = new \Common\CustomerCompany();
			$cst -> id = $row[0]['idCompany'];
			$cst -> name = $row[0]['name'];
			$_proj_obj -> customerCompany	= $cst;
			return true;
		}
	    else
	    {
			throw new \Exception("Error #" . $stmt -> errorCode() . ' in query!');
			return false;
		}
	    
        
	}
	
	private static function getProjectTeamMembers(&$_proj_obj)
	{
		$sql = "SELECT pns.* FROM projects AS p 
				JOIN projectteammembers AS ptm 
					ON ptm.idProject = p.idProject
				JOIN persons AS pns
					ON ptm.idPerson = pns.idPerson
				WHERE p.idProject = :prid ";
        $stmt = self::createDal() -> prepare($sql);
	    $stmt -> bindParam(':prid', $_proj_obj->__get('id'), \PDO::PARAM_STR);
	    $stmt -> execute();
	    $row = $stmt -> fetchAll();
	    if($stmt -> errorCode() == "00000")
	    {
		    $_proj_obj -> projectTeam = new \ArrayObject();
			foreach($row as $person_row)
			{
				$_proj_obj -> projectTeam[$person_row['idPerson']] = $person_row;
			}
        }
		else
	    {
			throw new \Exception("Error #" . $stmt -> errorCode() . ' in query!');
			return false;
		} 
	}
	
	private static function getProjectContacts(&$_proj_obj)
	{
		$sql = "SELECT pns.* FROM projects AS p 
				JOIN projectcontacts AS pct 
					ON pct.idProject = p.idProject
				JOIN persons AS pns
					ON pct.idPerson = pns.idPerson
				WHERE p.idProject = :prid ";
        $stmt = self::createDal() -> prepare($sql);
	    $stmt -> bindParam(':prid', $_proj_obj->__get('id'), \PDO::PARAM_STR);
	    $stmt -> execute();
	    $row = $stmt -> fetchAll();
	    if($stmt -> errorCode() == "00000")
	    {
		    $_proj_obj -> contacts = new \ArrayObject();
			foreach($row as $person_row)
			{
				$_proj_obj -> contacts[$person_row['idPerson']] = $person_row;
			}
        }
		else
	    {
			throw new \Exception("Error #" . $stmt -> errorCode() . ' in query!');
			return false;
		} 
	}
	
	
	
	
}