<?php namespace be\imputation;
/**
 * 
 * @author gyselinckmikael
 *
 */
class Page404Controller extends Controller {

	public function __construct($_controller,$_args = array()){
		parent::__construct($_controller,$_args);
	}
	
	public function getView(){

		/**
		 * Hier dienen we de data uit het model  op te roepen en door te geven aan de view.
		 *
		 */


		
		$this->assembleView();

	}
}