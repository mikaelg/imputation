<?php
  
require_once dirname(dirname(__FILE__))."/classes/Entity.php";
require_once dirname(dirname(__FILE__))."/classes/Address.php";
require_once dirname(dirname(__FILE__))."/classes/Exceptions.php";

class AddressTest extends PHPUnit_Framework_TestCase
{
	
	public function testConstructor()
	{
		$a1 = new Common\Address();
		$this -> assertEquals(get_class($a1), "Common\Address");
	}
	
	/**
     * @depends testConstructor
     */
	public function testMagicGetFunction()
    {
		$a1 = new Common\Address();		
		
		$this->assertTrue($a1 -> __get('id') !== false);
		$this->assertTrue($a1 -> __get('country') !== false);
		
		$this->assertFalse($a1 -> __get('fgdhjsdfgkjhsgdfkjhg') !== false);
		$this->assertFalse($a1 -> __get(123) !== false);
		$this->assertFalse($a1 -> __get(-1) !== false);

		
    }
    
    
    /**
     * @depends testConstructor
     */
    public function testCreateWithAllFieldsFilled()
    {
    	$a1 = new Common\Address();
    	
    	$g1 = array(		"id"				=> 5,
							"country" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"box"        		=>  '3',
							"nep-veld"			=> 'wtf stade gij hier te doen??',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9);

  		
  		
  		// Put "good" data in $a1					
  		$a1 -> Create($g1);
  		
  		
  		
  		// Check if it arrived well			
  		$this->assertTrue($a1 -> __get('id') !== false);
  		// and has the correct value
  		$this->assertEquals($a1 -> __get('id') , 5);
  		
  		
  		// assert that nep-veld didn't make it into the object
  		$this->assertClassNotHasAttribute('nep-veld', 'Common\Address');	
		
		// and that teh magic getter will also return false if asked for it
		$this->assertFalse($a1 -> __get('nep-veld'));  
  							
        
    	
    }
    
    /**
     * @depends testCreateWithAllFieldsFilled
     */
    public function testCreateWithJustMandatoryFieldsFilled()
    {
    
    	// this test depends on testCreateWithAllFieldsFilled so we don't need to test
    	// the testitems from there anymore
    	    	
    	$a1 = new Common\Address();
							
  		$g1 = array(		"id"				=> 5,
							"country" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"nep-veld"			=> 'wtf stade gij hier te doen??',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9);

       
  		
  		
  		// Put "good" data in $a1					
  		$a1 -> Create($g1);
  		
  		//assert that the box property exists, even though it's not mandatory and not populated
  		$this->assertClassHasAttribute('box', 'Common\Address');
  		
  		// assert that the box property was not filled, but also not null
  		$this->assertEquals($a1 -> __get('box'), '');
  		$this->assertNotNull($a1 -> __get('box'));
  		
    }
    
    
    
    
    /**
     * @expectedException Common\AddressException
     */
    
    public function testCreateWithIllegalInputArrays()
    {
    	

    
		$b1 = array(		"id"				=> 'stringinsteadofint',
							"country" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"box"        		=>  '3',
							"nep-veld"			=> 'wtf stade gij hier te doen??',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9
							);
  							
  		$b2 = array(		"id"				=> 5,
							"country-ismandatorybutnotpresent" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"nep-veld"			=> 'wtf stade gij hier te doen??',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9
  							);
  							
  						
  		// Put "bad" data in $a1
  		$a1 = new Common\Address();					
  		$this->assertFalse($a1 -> Create($b1));
  		
  		// Put otherwise, yet equally bad data in $a2
  		$a2 = new Common\Address();					
  		$this->assertFalse($a2 -> Create($b2));
    }
    
    /**
     * @expectedException Common\AddressException
     */
    public function testExceptionThrownWhenCallingUpdateOnNonEmptyAddress()
    {
    	$g1 = array(		"id"				=> 5,
							"country" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"box"        		=>  '3',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9);
    
    	$a1 = new Common\Address();
    	$this -> assertFalse($a1 -> Update($g1));
    	
    }
          

      
}
  
  
?>
