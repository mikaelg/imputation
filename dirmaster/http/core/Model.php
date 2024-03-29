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
				
			$dal = new \PDO( Settings::getConnString(),
						Settings::getDbUid(),
						Settings::getDbPwd(),
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
			//return "1234567890";
			
			return (md5(Settings::getSaltKey().session_id()));
		} else {
			return $this->formvars['formGuid'];
		}
	}
	
	public function checkFormGuid(){
		
		//print $this->formvars['formGuid'] . " = " . md5(Settings::getSaltKey().session_id());
		//return true;
		
		/**
		 * als er geen formGuid is is er geen post en stoppen we de controle
		 */
		if(!isset($this->formvars['formGuid']))
			return false;
		
		/**
		 * doe een check tegen session id in combinatie met saltkey
		 * wanneer controle ok return true
		 * wanneer controle NIET OK throw error. Er is gefoefeld!
		 */
		if ($this->formvars['formGuid'] == md5(Settings::getSaltKey().session_id()))
			return true;
		else
			throw new $this::$myExceptionClass("fatal form error!"); // Exception("fatal form error!");
	}
	
	public function formSubmissionSent($_submitButtonName = 'go')
	{
		//print "formSubmissionSent:".$this->formvars[$_submitButtonName];
		return(isset($this->formvars[$_submitButtonName]));
		
		//return(isset($this->formvars->$_submitButtonName));
	}
	
	
}