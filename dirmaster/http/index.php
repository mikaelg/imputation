<?php 
require_once 'core/Run.php';
require_once 'core/Debugger.php';

/*** error reporting on ***/
ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);

$Run = new be\imputation\Run();

?>