<?php namespace be\imputation;
//require_once 'core/Controller.php';
//require_once 'model/Home.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class EmployeeController extends AuthenticationController {

	public function __construct($_controller,$_args = array()){
		parent::__construct($_controller,$_args);
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		$this->model = new EmployeeModel();

		$this->dcreg->foo = 'INSERTED FROM CONTROLLER';
		

		if(!$this->dcreg->args)
			print('please provide an employee');
		else {
			$e = $this->model->getEmployeeValues($this->dcreg->args[0]);
			$this->dcreg->employee = $e;	
		}
		
			
		
		$this->assembleView();

	}
}