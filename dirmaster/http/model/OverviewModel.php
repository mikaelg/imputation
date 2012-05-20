<?php namespace be\imputation;
//require_once 'core/Model.php';

class OverviewModel extends Model {

	public function __construct($_args  = array()){
		parent::__construct($_args);
	}
	
	public function getProjects(){
		
		$startDate = "2012-05-12";
		
		$sql = "SELECT p.idProject FROM projects AS p WHERE p.startdate >= :prstdt";
		$stmt = $this -> dal -> prepare($sql);
		$stmt -> bindValue(':prstdt', $startDate, \PDO::PARAM_STR);
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
	
}