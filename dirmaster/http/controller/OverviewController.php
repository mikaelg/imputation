<?php namespace be\imputation;
//require_once 'core/AuthenticationController.php';
//require_once 'model/Overview.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class OverviewController extends AuthenticationController {

	public function __construct($_controller,$_args = array()){
		parent::__construct($_controller,$_args);
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */
		$this->model = new OverviewModel($_POST);
		
		//$this->dcreg->formGuid = $this->model->generateFormGuid();
		
		if($this->model->CheckDateRequest()){
			
			if($this->model->IsValidDate()){
				$this->dcreg->showFormOverview = false;
				$this->dcreg->projects = $this->model->getProjects();
			}
			else
			{
				$this->dcreg->showFormOverview = true;
			}
		} else {
			$this->dcreg->showFormOverview = true;
		}
		
		if($this->dcreg->showFormOverview = true){
			// niet ingelogd
			// maak een formGuid aan als er geen $_POST['formGuid'] variable is
			$this->dcreg->formGuid = $this->model->generateFormGuid();
		} else {	
			// als $this->dcreg->formGuid niet leeg is wil dit zeggen dat dit een POST is dus checken we de formGuid met de database
			// als controle formGuid false geeft stoppen we de verdere rendering van het formulier
			if(!$this->model->checkFormGuid()){
				header("Location: /donottemperwiththeform");
				return;
			}
		}
			
		

		
		$this->dcreg->foo = 'INSERTED FROM CONTROLLER<br />Overview<br />';
		
		print_r($this->dcreg->args);
		
		
		
		$this->assembleView();

	}
}