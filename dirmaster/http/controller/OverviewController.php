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
		//print $_POST['startDate'];
		$this->model = new OverviewModel($_POST);
		
		//$this->dcreg->formGuid = $this->model->generateFormGuid();
		
		/**
		 * controleer er een datum string is doorgegeven
		 * controleer of string een "valid date" is.
		 */
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
		
		/**
		 * wanneer het resultaat leeg is wordt het formulier opniew weergegeven met een boodschap.
		 */
		if(empty($this->dcreg->projects) && !$this->dcreg->showFormOverview){
			//echo "PROJECT IS NOT SET";
			
			$this->dcreg->update("showFormOverview",true);
			$this->dcreg->projectsNoResults = "Geen resultaat gevonden voor ". $this->model->getStartDate();
		}
		
		
		/**
		 * GUID aanmaken voor formulier
		 */
		if($this->dcreg->showFormOverview){
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
			

		
		print_r($this->dcreg->args);
		
		
		
		$this->assembleView();

	}
}