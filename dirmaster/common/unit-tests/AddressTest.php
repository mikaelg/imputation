<?php
  
  require_once "c:\\xampp\\htdocs\\imputation\\dirmaster\\common\\classes\\iEntity.php";
  require_once "c:\\xampp\\htdocs\\imputation\\dirmaster\\common\\classes\\Address.php";
  class AddressTest extends PHPUnit_Framework_TestCase
  {

    public function testInputArrayWithGoodies()
    {
      
        $g1 = array(	"id"				=> 5,
							"country" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"box"        =>  '3',
							"nep-veld"			=> 'wtf stade gij hier te doen??',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9);
  			$g2 = array(	"id"				=> 5,
							"country" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"nep-veld"			=> 'wtf stade gij hier te doen??',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9);
        $this->assertTrue(Common\Address::inputArrayIsValid($g1, true));
        $this->assertTrue(Common\Address::inputArrayIsValid($g2, true));
    }
    
     public function testInputArrayWithBaddies()
    {
        $b1 = array(	"id"				=> 'stringinsteadofint',
							"country" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"box"        =>  '3',
							"nep-veld"			=> 'wtf stade gij hier te doen??',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9
  							);
  			$b2 = array(	"id"				=> 5,
							"country-ismandatorybutnotpresent" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"nep-veld"			=> 'wtf stade gij hier te doen??',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9
  							);
        $this->assertFalse(Common\Address::inputArrayIsValid($b1, true));
        $this->assertFalse(Common\Address::inputArrayIsValid($b2, true));
    }
    
 
          

      
    }
  
  
?>
