<?php namespace be\imputation;
//require_once 'core/Controller.php';
//require_once 'model/Login.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class LoginController extends Controller {

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
		
		$this->model = new LoginModel($_POST);
		
		// zijn we reeds ingelogd ?
		if($this->model->loginStatus()){
			$this->setNewView('Loggedin');	
		} else {
			
			// niet ingelogd
			// maak een formGuid aan als er geen $_POST['formGuid'] variable is
			$this->dcreg->formGuid = $this->model->generateFormGuid();
			
			// als $this->dcreg->formGuid leeg is wil dit zeggen dat dit een POST is dus checken we de formGuid met de database
			// als controle formGuid false geeft stoppen we de verdere rendering van het formulier
			if(!$this->model->checkFormGuid()){
				header("Location: /donottemperwiththeformdude");
				return;
			}
			 
			
			$result = $this->model->checkLoginCredentials();
	
			if(is_array($result)){
				$this->dcreg->warnings = $result;
			}
			elseif($result){
				$this->setNewView('Loggedin');
			}
		}

		$this->assembleView();

	}
}