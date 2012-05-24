<?php namespace be\imputation;
//require_once 'core/Controller.php';
//require_once 'model/Login.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class ImputationController extends Controller {

	public function __construct($_controller,$_args = array()){
		parent::__construct($_controller,$_args);
	}
	

	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		
		$this->model = new ImputationModel($_POST);
		$this->loginmodel = new LoginModel($_POST);
		
		// zijn we reeds ingelogd ?
		if($this->loginmodel->loginStatus()){
			$this->assembleView();	
		}
		else
		{
			die("A nee, da mag nie...");
		}
	}
}