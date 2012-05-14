<?php namespace be\imputation;
//require_once 'core/Controller.php';
//require_once 'model/Home.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class ProjectController extends AuthenticationController {

	public function __construct($_controller,$_args = array()){
		parent::__construct($_controller,$_args);
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		$this->model = new ProjectModel();

		$this->dcreg->foo = 'INSERTED FROM CONTROLLER';
		

		if(!$this->dcreg->args)
			print('please provide a project');
		else {
			//print_r($this->dcreg->args);
			
			$p = $this->model->getProjectValues($this->dcreg->args[0]);
			

			
			
			$this->dcreg->project = $p;
			
			
		}
		
			
		
		$this->assembleView();

	}
}