<?php
  
  require_once dirname(dirname(__FILE__))."/classes/iEntity.php";
  require_once dirname(dirname(__FILE__))."/classes/Address.php";
  class AddressTest extends PHPUnit_Framework_TestCase
  {

    public function testAddressConstructor()
    {
		$a1 = new Common\Address();
		/*$flds = $a1 -> __get('fields');
		foreach($flds as $fieldname => $fieldspecs_arr)
		{
			$fn = $a1 -> __get($fieldname);
			$this->assertTrue(empty($fn));
			$this->assertTrue(is_null($a1 -> __get($fieldname)));
		}*/
		
		
		
		$this->assertTrue($a1 -> __get('id') !== false);
		$this->assertTrue($a1 -> __get('country') !== false);
		$this->assertFalse($a1 -> __get('fgdhjsdfgkjhsgdfkjhg') !== false);

		
    }
    
    
    /*$g1 = array(	"id"				=> 5,
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
							"addressTypeId"		=> 9);*/
    
    
    /*public function testInputArrayWithBaddies()
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
    }*/
    
 
          

      
    }
  
  
?>
