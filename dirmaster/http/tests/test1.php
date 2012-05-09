<?php namespace Common;

/*** error reporting on ***/
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);


require("../common/classes/iEntity.php");
require("../common/classes/Address.php");
require("../common/classes/iCollection.php");
require("../common/classes/iAddressCollection.php");
require("../common/classes/AddressCollection.php");


try
{
	$a1 = new Address();
  	if($a1 -> Create(Array(	"id"				=> 5,
							"country" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"nep-veld"			=> 'wtf stade gij hier te doen??',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9
  							)
  					)
  	)
	{
		echo "Create OK";
		echo '<pre>' . print_r($a1, true) . '</pre>';
	}
	else
	{
		echo "Create NOK";
	}
	
	
	
	
	
	if($a1 -> Update(Array(	
							"number"			=> '5b'
							
  							)
  					)
  	)
	{
		echo "Update OK";
		echo '<pre>test property: '.$a1 -> number.'</pre>';
		echo '<pre>' . print_r($a1, true) . '</pre>';
		
		$a1 -> number = 'ik vul hier in wat ik wil en niemand kan dit controleren';
		echo '<pre>test property update los van inputArrayIsValid: '.$a1 -> number.'</pre>';
		echo '<pre>' . print_r($a1, true) . '</pre>';
	}
	else
	{
		echo "Update NOK";
	}
	
	
	
	
	$ac = new AddressCollection();
	
if($ac -> addMember($a1))
	{
		echo "addMember OK";
		echo '<pre>' . print_r($a1, true) . '</pre>';
	}
	else
	{
		echo "addMember NOK";
	}
	echo '<pre>' . print_r($ac, true) . '</pre>';
	
	
}
catch(\Exception $e)
{
  echo $e;
}


?>
