<?php namespace be\imputation;

/**
 * OPMERKINGEN
 * class is final => kan niet meer uitgebreid/overgeerfd worden
 * static private vs const => static kunnen nog binnen de class gewijzigd worden.
 * const enkel bereikbaar binnen de scope van de class
 * define NIET gebruiken is bereikbaar buiten de scope van de class
 *
 */

final class Settings{

	/*********** DATABASE SETTINGS : /core/Model.php ************/
	/*
	static private $connString = 'mysql:host=localhost;dbname=imputation_imp';
	static private $dbPwd = 'imputation_imp';
	static private $dbUid = 'imp9000';
	*/
		
	
	const CONNSTRING = 'mysql:host=localhost;dbname=imputation';
	const DBPWD = 'root';
	const DBUID = 'root';
	
	public static function getConnString(){
		return self::CONNSTRING;
	}
	
	public static function getDbPwd(){
		return self::DBPWD;
	}
	
	public static function getDbUid(){
		return self::DBUID;
	}
	
	
	/*********** DEBUG SETTINGS /index.php ************/
	/**
	 * http://www.php.net/manual/en/errorfunc.constants.php
	 * http://www.php.net/manual/en/errorfunc.constants.php
	 * error_reporting(0); << ALL ERROR REPORTING OFF
	 * error_reporting(E_ALL); << ERROR REPROTIN ON
	 */
	
	static private $displayErrors = 1;
	static private $logErrors = 1;
	static private $errorLogFile = '/error_log.txt';
	static private $errorReporting = E_ALL;
	
	public static function getDisplayErrors(){
		return self::$displayErrors;
	}
	
	public static function getLogErrors(){
		return self::$logErrors;
	}
	
	public static function getErrorLogFile(){
		return self::$errorLogFile;
	}
	
	public static function getErrorReporting(){
		return self::$errorReporting;
	}
	
	/********* LOCATIONS ************/
	static private $locations = array('nl','fr','en','de');
	
	public static function IsValidLocation($_loc){
		foreach (self::$locations as $loc) {
			if($_loc === $loc)
				return true;
		}
		
		return false;
	}
	
	public static function DefaultLocation(){
		return self::$locations[0];
	}
	
	/******** SALT KEY ***********/
	const SALTKEY = 'Žlkq"Žt(¤mlk';
	public static function getSaltKey(){
		return self::SALTKEY;
	}
	
}
