<?php namespace be\imputation;
require_once 'core/AuthenticationController.php';
require_once 'model/Overview.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Overview_controller extends AuthenticationController {

	public function __construct($_controller,$_args = array()){
		parent::__construct($_controller,$_args);
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		$this->model = new Overview_model();
		
		//$this->get

		
		$this->dcreg->foo = 'INSERTED FROM CONTROLLER<b />Overview<br />';
		
		print_r($this->dcreg->args);
		
		$this->assembleView();

	}
}