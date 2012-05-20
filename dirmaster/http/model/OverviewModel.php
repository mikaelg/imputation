<?php namespace be\imputation;
//require_once 'core/Model.php';

class OverviewModel extends Model {

	private $startdate;
	
	public function __construct($_args  = array()){
		parent::__construct($_args);
	}
	
	public function getProjects(){
		
		//$this->startDate = "2012-05-12";
		//echo $this->startdate;
		
		$sql = "SELECT p.idProject FROM projects AS p WHERE p.startdate >= :prstdt";
		$stmt = $this -> dal -> prepare($sql);
		$stmt -> bindValue(':prstdt', $this->startdate, \PDO::PARAM_STR);
		$stmt -> execute();
		$row = $stmt -> fetchAll();
		
		
		//let the project factory determine what kind of object to return
		$pf = new \Common\projectsFactory();

		
		foreach ($row as $r) {
			$pm = new ProjectModel();
			$pf->addToProjectArray($pm->getProjectValuesById($r['idProject']));
		}
		
		return  $pf->getProjectArray();
		
	}
	
	public function CheckDateRequest(){
		if(isset($this->formvars['startDate']) && Sanitize::checkSanity($this->formvars['startDate'], 'string', 10)){
			return true;
		}
		else
			return false;
	}
	
	public function IsValidDate(){
		$this->startdate = Sanitize::checkDateSanity($this->formvars['startDate'], 'string', 10);
		
		if(isset($this->startdate))
			return true;
		else
			return false;
	}
	
}