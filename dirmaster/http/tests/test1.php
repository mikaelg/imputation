<?php 
try
{

  
  
  $imp = new Imputation(1);
  $imp -> comment = 'testcommentaar';
  //$imp -> update(); // Dit gaat nog fout : syntax error in de SQL
  
}
catch(Exception $e)
{
  echo $e;
}


?>
