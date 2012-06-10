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
	
	public static function createDal()
	{
		try{
			
			/*
			$dal = new \PDO( 'mysql:host=localhost;dbname=imputation_imp',
					'imputation_imp',
					'imp9000',
					array(
							\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY    => 1,
							\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
							\PDO::ATTR_PERSISTENT => true,
					)
			*/
			
				
			$dal = new \PDO( 'mysql:host=localhost;dbname=imputation',
						'root',
						'root',
						array(
								\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY    => 1,
								\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
								\PDO::ATTR_PERSISTENT => true,
						)
						
			);
			return $dal;
		}catch (\PDOException $e){

			die("Database connection failed : check connectionstring!"); // error boodschap geeft login weer.$e->getMessage());
		}
	}
	
	public function __construct($_args  = array()){
		$this->formvars = $_args;
		$this -> dal = self::createDal();
		
		
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
		 * verder onderzoeken hoe dit in in ander frameworks wordt opgevangen
		 */
		return true;
	}
	
	public function formSubmissionSent($_submitButtonName = 'go')
	{
		//print "formSubmissionSent:".$this->formvars[$_submitButtonName];
		return(isset($this->formvars[$_submitButtonName]));
		
		//return(isset($this->formvars->$_submitButtonName));
	}
	
	
}