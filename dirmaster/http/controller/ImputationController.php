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
		if($this->loginmodel->loginStatus())
		{

			//echo '<pre>' . print_r($_POST,true) . '</pre>';
			$checkResult = $this->model->checkImputationValues();
			if($checkResult === true)
			{
				echo "Imputation was valid!";
			}
			else
			{
				$this->dcreg->warnings = $checkResult;
			}
			
			$this->dcreg->formGuid = $this->model->generateFormGuid();
			$this->assembleView();
				
		}
		else
		{
			die("A nee, da mag nie... Inloggen a.u.b.");
		}
	}
}