<?php namespace be\imputation;


/**
 * 
 * @author Jos
 *
 */
class ImputationModel extends Model {
	
	public function __construct($_args  = array()){
		parent::__construct($_args);
	}
	
	public function getProjects()
	{
		return ProjectModel :: getProjects();
	} 
	

	
}