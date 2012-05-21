<?php namespace be\imputation;
require_once 'core/Sanitize.php';

/**
 * 
 * @author gyselinckmikael
 *
 */
class Model{
	protected static $myExceptionClass = 'Common\ModelException';

	protected $formvars;
	
	protected $dal;
	
	public function __construct($_args  = array()){
		$this->formvars = $_args;
		
		try{
			$this->dal = new \PDO( 'mysql:host=localhost;dbname=Imputation',
					'root',
					'root',
					array(
							\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY    => 1,
							\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
							\PDO::ATTR_PERSISTENT => true,
					)
			);
		}catch (\PDOException $e){
			//throw new $myExceptionClass("Database connection failed : check connectionstring");
			die("Database connection failed : check connectionstring: ".$e->getMessage());
		}
		
	}
	
	/**
	 * maak formGuid aan of geef bestaande terug
	 * @return string
	 */
	public function generateFormGuid(){
	
	
		// Deze dienen we on-the-fly te genereren wanneer pagin voor eerste keer wordt opgeroepen.
		if(!isset($this->formvars['formGuid'])){
			return '1234567890';
		} else {
			return $this->formvars['formGuid'];
		}
	}
	
	public function checkFormGuid(){
		/**
		 * doe één of ander check tegen de database.
		 * vb session id + controllername.
		 * verder onderzoeken hoe dit in Drupal wordt opgevangen
		 */
		return true;
	}
}