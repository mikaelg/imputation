<?php 
try
{

  class AutoLoaderClass
  {
    static function load_my_classes($_cls)
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
        $candidate_class_file = $ROOTPATH . $PATH_SEPARATOR . $dir . $PATH_SEPARATOR . $_cls . '.php';
        if(file_exists($candidate_class_file))
        {
          require_once($candidate_class_file);
        }
      }
    }
  }

  
  spl_autoload_register(Array('AutoLoaderClass', 'load_my_classes'));
  
  $imp = new Imputation(1);
  $imp -> comment = 'testcommentaar';
  //$imp -> update(); // Dit gaat nog fout : syntax error in de SQL
  
}
catch(Exception $e)
{
  echo $e;
}


?>
