<?php namespace be\imputation;

class ProjectModel extends Model {

	private $p;
	
	public function __construct(){
		print("FROM CONSTRUCTOR ProjectModel");
		parent::__construct();
	}
	
	
	
	public function getProjectValues($_projectID)
	{

		
		$sql = "SELECT p.budget FROM projects AS p WHERE p.name = :prnm LIMIT 1";
		$stmt = $this -> dal -> prepare($sql);
		$stmt -> bindValue(':prnm', $_projectID, \PDO::PARAM_STR);
		$stmt -> execute();
		$row = $stmt -> fetchAll();		
		

		//let the project factory determine what kind of object to return
		$pf = new \Common\projectsFactory();
		$this->p = $pf->getProject($_projectID,$row[0]["budget"]);
		
		echo "budget = ".$this->p->budget;
		
		
		$this -> getProjectData($_projectID, $this->p);
		$this -> getProjectTeamMembers($_projectID, $this->p);
		$this -> getCustomerCompany($_projectID, $this->p);
		$this -> getProjectContacts($_projectID, $this->p);
		
		return $this->p;
		
	}
	

	private function getProjectData($_projectID, &$_proj_obj){

        
		
		
		$sql = "SELECT p.*, c.name AS customerName, ps.name AS projectStatus, pt.name AS projectType FROM projects AS p 
				JOIN projectstatuses AS ps 
					ON 	ps.idProjectStatus = p.idProjectStatus
				JOIN projecttypes AS pt
					ON pt.idProjectType = p.idProjectType
				JOIN companies AS c
					ON c.idCompany = p.idCompany
				WHERE p.name = :prnm LIMIT 1";
        $stmt = $this -> dal -> prepare($sql);
	    $stmt -> bindValue(':prnm', $_projectID, \PDO::PARAM_STR);
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
	
	private function getCustomerCompany($_projectID, &$_proj_obj){

        $sql = "SELECT c.*, a.* FROM projects AS p 
				JOIN companies AS c
					ON c.idCompany = p.idCompany
				JOIN companyaddresses AS ca
					ON ca.idCompany = p.idCompany
				JOIN addresses AS a
					ON a.idAddress = ca.idAddress
				WHERE p.name = :prnm LIMIT 1";
        $stmt = $this -> dal -> prepare($sql);
	    $stmt -> bindValue(':prnm', $_projectID, \PDO::PARAM_STR);
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
	
	private function getProjectTeamMembers($_projectID, &$_proj_obj)
	{
		$sql = "SELECT pns.* FROM projects AS p 
				JOIN projectteammembers AS ptm 
					ON ptm.idProject = p.idProject
				JOIN persons AS pns
					ON ptm.idPerson = pns.idPerson
				WHERE p.name = :prnm ";
        $stmt = $this -> dal -> prepare($sql);
	    $stmt -> bindParam(':prnm', $_projectID, \PDO::PARAM_STR);
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
	
	private function getProjectContacts($_projectID, &$_proj_obj)
	{
		$sql = "SELECT pns.* FROM projects AS p 
				JOIN projectcontacts AS pct 
					ON pct.idProject = p.idProject
				JOIN persons AS pns
					ON pct.idPerson = pns.idPerson
				WHERE p.name = :prnm ";
        $stmt = $this -> dal -> prepare($sql);
	    $stmt -> bindParam(':prnm', $_projectID, \PDO::PARAM_STR);
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