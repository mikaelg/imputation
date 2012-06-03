<?php namespace be\imputation;
ob_start();

/**
 * Don't output anything in this file.
 * every output should be after session_start in Run.php
 */

function load_my_classes($_cls)
{
  //echo '<hr />' . $_cls . '<hr />';
  $PATH_SEPARATOR = DIRECTORY_SEPARATOR;
  //$ROOTPATH = $_SERVER["DOCUMENT_ROOT"];
	$ROOTPATH = dirname($_SERVER["SCRIPT_FILENAME"]);
	
	//print_r($_SERVER);
  
	
  // Windows XAMPP
  //$ROOTPATH = "C:\\xampp\\htdocs\\imputation\\dirmaster\\http";
  //$PATH_SEPARATOR = "\\";
  
  // Mac XAMPP
  //$ROOTPATH = "/Applications/xampp/htdocs/imputation/dirmaster/http";
  //$PATH_SEPARATOR = "/";
  
  // Mac MAMPP
  //$ROOTPATH = "/Users/gyselinckmikael/Documents/WWW_MAMP/imputation/dirmaster/http";
  //$PATH_SEPARATOR = DIRECTORY_SEPARATOR;

    if(class_exists($_cls))
    {
        //doe niks, het is een ingebouwde class zoals \SplObjectStorage o.i.d.
    }
    elseif(strpos($_cls, 'Exception') !== false)
    {
        $candidate_class_file = $ROOTPATH . $PATH_SEPARATOR . 'common' . $PATH_SEPARATOR . 'classes' . $PATH_SEPARATOR . 'Exceptions.php';
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
    elseif(strpos($_cls, 'Common') === false)
    {
        $dirsToLookIn = Array("controller", "core", "model", "view");
      
        foreach($dirsToLookIn as $dir)
        {
            if(strpos($_cls, __NAMESPACE__) !== false)
            {
                //namespace eraf strippen anders komt die mee in de padverwijzingen
                $_cls = substr($_cls, strlen(__NAMESPACE__)+1);  
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
    }
    else
    {
        $_cls = substr($_cls, 7);
        $candidate_class_file = $ROOTPATH . $PATH_SEPARATOR . 'common' . $PATH_SEPARATOR . 'classes' . $PATH_SEPARATOR . $_cls . '.php';
        
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
    //echo '<hr />';
}

spl_autoload_register(__NAMESPACE__.'\load_my_classes');

//require_once 'core/Run.php';
//require_once 'core/Debugger.php';

/*** error reporting on ***/
ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
//error_reporting(0);
error_reporting(E_ALL);



//$Run = new be\imputation\Run();
$Run = new Run();

?>