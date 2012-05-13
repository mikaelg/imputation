<?php namespace be\imputation;
//require_once 'core/Model.php';

class ProjectModel extends Model {

	public function __construct(){
		print("FROM CONSTRUCTOR ProjectModel");
	} 
	
	public function getProjectValues($_prjectID){
		return $_prjectID;
	}
	
}