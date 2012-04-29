<?php namespace be\imputation;
require_once 'core/Controller.php';
require_once 'model/Login.php';

class Login_controller extends Controller {

	public function __construct($_controller){
		parent::__construct($_controller);
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		$this->model = new Login_model();
		$result = $this->model->checkLoginCredentials();
		if(is_array($result)){
			//$this->dcreg->foo = "from controller";
			$this->dcreg->warnings = $result;
		}
		elseif($result){
			$this->setNewView('Loggedin');
		}

		
		$this->assembleView();

	}
}