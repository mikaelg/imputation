<?php namespace be\imputation;
require_once 'core/AuthenticationController.php';
require_once 'model/Overview.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Overview_controller extends AuthenticationController {

	public function __construct($_controller){
		parent::__construct($_controller);
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		$this->model = new Overview_model();

		
		$this->dcreg->foo = 'INSERTED FROM CONTROLLER<b />Overview<br /><ul><li><a href="?rt=login">login</a></li></ul>';
		
		$this->assembleView();

	}
}