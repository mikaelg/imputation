<?php namespace be\imputation;

class ProjectModel extends Model {

	public function __construct(){
		print("FROM CONSTRUCTOR ProjectModel");
		$this -> dcreg = DynamicContentRegistry::instantiate();
	} 
	
	public function getProjectValues($_prjectID, &$_proj_obj){

        $sql = "SELECT p.*, ps.name AS projectStatus, pt.name AS projectType FROM projects AS p 
				JOIN projectstatuses AS ps 
					ON 	ps.idProjectStatus = p.idProjectStatus
				JOIN projecttypes AS pt
					ON pt.idProjectType = p.idProjectType
				WHERE p.name = :prnm LIMIT 1";
        $stmt = $this -> dcreg -> dal -> prepare($sql);
	    $stmt -> bindValue(':prnm', $_prjectID, \PDO::PARAM_STR);
	    $stmt -> execute();
	    $row = $stmt -> fetchAll();
	    
	    
	    
	    if($stmt -> errorCode() == "00000")
	    {
			$_proj_obj -> id 			= $row[0]["idProject"];
			$_proj_obj -> name 			= $row[0]["name"];
			$_proj_obj -> startDate		= new \DateTime($row[0]["startdate"]);
			$_proj_obj -> endDate 		= is_null($row[0]["enddate"]) ? null :  new \DateTime($row[0]["enddate"]);
			$_proj_obj -> type			= $row[0]["projectType"];
			$_proj_obj -> status		= $row[0]["projectStatus"];
			return true;
		}
	    else
	    {
			throw new \Exception("Error #" . $stmt -> errorCode() . ' in query!');
			return false;
		}
	    
        
	}
	
	public function getProjectTeamMembers($_prjectID, &$_proj_obj)
	{
		$sql = "SELECT pns.* FROM projects AS p 
				JOIN projectteammembers AS ptm 
					ON ptm.idProject = p.idProject
				JOIN persons AS pns
					ON ptm.idPerson = pns.idPerson
				WHERE p.name = :prnm ";
        $stmt = $this -> dcreg -> dal -> prepare($sql);
	    $stmt -> bindParam(':prnm', $_prjectID, \PDO::PARAM_STR);
	    $stmt -> execute();
	    $row = $stmt -> fetchAll();
	    if($stmt -> errorCode() == "00000")
	    {
		    $_proj_obj -> projectTeam = new \Common\PersonCollection();
			foreach($row as $person_row)
			{
				$teamMember = new \Common\Person();
				$teamMember -> id = $person_row["idPerson"];
				$teamMember -> lastname = $person_row["name"];
				$teamMember -> firstname = $person_row["firstname"];
				$teamMember -> gender = $person_row["gender"];	
				
				$_proj_obj -> projectTeam -> attach($teamMember);
			}
        }
		else
	    {
			throw new \Exception("Error #" . $stmt -> errorCode() . ' in query!');
			return false;
		} 
	}
	
}