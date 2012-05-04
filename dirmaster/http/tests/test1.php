<?php namespace Common;

require("C:\\xampp\\htdocs\\imputation\\dirmaster\\common\\classes\\iEntity.php");
require("C:\\xampp\\htdocs\\imputation\\dirmaster\\common\\classes\\Address.php");
require("C:\\xampp\\htdocs\\imputation\\dirmaster\\common\\classes\\iCollection.php");
require("C:\\xampp\\htdocs\\imputation\\dirmaster\\common\\classes\\iAddressCollection.php");
require("C:\\xampp\\htdocs\\imputation\\dirmaster\\common\\classes\\AddressCollection.php");


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
