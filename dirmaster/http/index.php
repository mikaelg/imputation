<?php namespace be\imputation;

function load_my_classes($_cls)
{
  // Windows XAMPP
  $ROOTPATH = "C:\\xampp\\htdocs\\imputation\\dirmaster\\http";
  $PATH_SEPARATOR = "\\";
  
  // Mac XAMPP
  //$ROOTPATH = "/var/www/imputation/dirmaster/http";
  //$PATH_SEPARATOR = "/";
  
  $dirsToLookIn = Array("controller", "core", "model", "view");
  
  foreach($dirsToLookIn as $dir)
  {
    if(strpos($_cls, __NAMESPACE__) !== false)
    {
      //namespace eraf strippen anders komt die mee in de padverwijzingen
      $_cls = substr($_cls, strlen(__NAMESPACE__));  
    }
    
     
    $candidate_class_file = $ROOTPATH . $PATH_SEPARATOR . $dir . $PATH_SEPARATOR . $_cls . '.php';
    if(file_exists($candidate_class_file))
    {
      require_once($candidate_class_file);
      //echo($candidate_class_file . ' found in ' . $candidate_class_file . '<br />');
    }
    else
    {
      //echo($candidate_class_file . ' does not exist!<br />');
    }
  }
  echo '<hr />';
}

spl_autoload_register(__NAMESPACE__.'\load_my_classes');

//require_once 'core/Run.php';
//require_once 'core/Debugger.php';

/*** error reporting on ***/
ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);

//$Run = new be\imputation\Run();
$Run = new Run();

?>