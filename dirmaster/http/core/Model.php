<?php namespace be\imputation;
require_once 'core/Sanitize.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Model{

	protected $formvars;
	
	public function __construct($_args  = array()){
		$this->formvars = $_args;
	}
}