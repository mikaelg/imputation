<?php namespace be\imputation;
require_once 'core/Controller.php';
require_once 'model/Login.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Login_controller extends Controller {

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
		$this->model = new Login_model();
		
		//if(!isset($this->formGuid))
		//	$this->formGuid = $this->model->generateFormGuid();
		
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