<?php namespace be\imputation;
require_once 'core/Controller.php';
require_once 'model/Home.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Home_controller extends Controller {

	public function __construct($_controller){
		parent::__construct($_controller);
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		$this->model = new Home_model();

		
		$this->dcreg->foo = 'INSERTED FROM CONTROLLER<br><ul><li><a href="?rt=login">login</a></li></ul>';
		
		$this->assembleView();

	}
}