<?php namespace be\imputation;
require_once 'core/Sanitize.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Model{

	protected $formvars;
	
	protected $dal;
	
	public function __construct($_args  = array()){
		$this->formvars = $_args;
		
		$this->dal = new \PDO( 'mysql:host=localhost;dbname=Imputation',
				'root',
				'root',
				array(
						\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY    => 1,
						\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
				)
		);
		
	}
}