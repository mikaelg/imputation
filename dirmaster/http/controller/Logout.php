<?php namespace be\imputation;
require_once 'core/Controller.php';
require_once 'model/Logout.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Logout_controller extends Controller {

	public function __construct($_controller,$_args = array()){
		parent::__construct($_controller,$_args);
	}
	
	function test(){
		print("test");
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		$this->model = new Logout_model();
		
		//if(!isset($this->formGuid))
		//	$this->formGuid = $this->model->generateFormGuid();
		
		$this->dcreg->logout = $this->model->Logout();

		
		$this->assembleView();

	}
}