<?php namespace be\imputation;
//require_once 'core/Controller.php';
require_once 'model/Home.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Home_controller extends Controller {

	public function __construct($_controller,$_args = array()){
		parent::__construct($_controller,$_args);
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		$this->model = new Home_model();

		
		$this->dcreg->foo = 'INSERTED FROM CONTROLLER';
		
		$this->assembleView();

	}
}