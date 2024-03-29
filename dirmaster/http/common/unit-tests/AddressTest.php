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
		$this->assertTrue($a1 -> __get('id') === false);
			
		$a1 -> id = 26;
		$this->assertTrue($a1 -> __get('id') !== false);
		$this->assertEquals($a1 -> __get('id'), 26);
		
		$this->assertFalse($a1 -> __get('fgdhjsdfgkjhsgdfkjhg'));
		$this->assertFalse($a1 -> __get(123) !== false);
		$this->assertFalse($a1 -> __get(-1) !== false);

		
    }
    
    
    /**
     * @depends testConstructor
     * @depends testMagicGetFunction
     */
    public function testCreateWithAllFieldsFilled()
    {
    	$a1 = new Common\Address();
    	
    	$a1 -> id = 5;
		$a1 -> country =  'BEL';
		$a1 -> city = 'Gent';
		$a1 -> street = 'Dok Noord';
		$a1 -> number = '5a';
		$a1 -> box = '3';
		$a1 -> province =  'O-VL';
		$a1 -> organisationId = 4;
		$a1 -> addressTypeId = 9;

  		// Check if it arrived well			
  		$this->assertTrue($a1 -> __get('id') !== false);
  		// and has the correct value
  		$this->assertEquals($a1 -> __get('id') , 5);
  		
  		
  		// Check if it arrived well			
  		$this->assertTrue($a1 -> __get('country') !== false);
  		// and has the correct value
  		$this->assertEquals($a1 -> __get('country') , 'BEL');
  		
  		// Check if it arrived well			
  		$this->assertTrue($a1 -> __get('city') !== false);
  		// and has the correct value
  		$this->assertEquals($a1 -> __get('city') , 'Gent');
  		
  		// Check if it arrived well			
  		$this->assertTrue($a1 -> __get('box') !== false);
  		// and has the correct value
  		$this->assertEquals($a1 -> __get('box') , '3');
  		        
    	
    }
    
    /**
     * @depends testCreateWithAllFieldsFilled
     * @expectedException Common\AddressException
     */
    public function testInstantiationWithOneInvalidProperty()
    {
    
    	// this test depends on testCreateWithAllFieldsFilled so we don't need to test
    	// the testitems from there anymore
    	    	
    	$a1 = new Common\Address();
		$a1 -> id = 5;
		$a1 -> country =  'BEL';
		$a1 -> city = 'Gent';
		$a1 -> street = 'Dok Noord';
		$a1 -> number = '5a';
		$a1 -> nep_veld = 'wtf stade gij hier te doen??';
		$a1 -> province =  'O-VL';
		$a1 -> organisationId = 4;
		$a1 -> addressTypeId = 9;


  		
    }
    
    
    /**
     * @depends testCreateWithAllFieldsFilled
     */
    public function testNonMandatoryNonPopulatedProperty()
    {
    
    	// this test depends on testCreateWithAllFieldsFilled so we don't need to test
    	// the testitems from there anymore
    	    	
    	$a1 = new Common\Address();
		$a1 -> id = 5;
		$a1 -> country =  'BEL';
		$a1 -> city = 'Gent';
		$a1 -> street = 'Dok Noord';
		$a1 -> number = '5a';
		$a1 -> province =  'O-VL';
		$a1 -> organisationId = 4;
		$a1 -> addressTypeId = 9;


  		
  		//assert that the box property exists in the Address class, even though it's not mandatory 
  		// and not populated during object instantiation
  		$this->assertClassHasAttribute('box', 'Common\Address');
  		
  		// assert that the box property was not filled, but also not null
  		$this->assertEquals($a1 -> __get('box'), '');
  		$this->assertNotNull($a1 -> __get('box'));
  		
    }
    
    
    /**
     * @depends testCreateWithAllFieldsFilled
     */
    public function testAllMandatoryFieldsArePresent()
    {
    	$a1 = new Common\Address();
    	
    	// assert that an empty address object is not properly populated
    	$this -> assertFalse($a1 -> allMandatoryFieldsArePresent());
    	
		$a1 -> id = 5;
		$a1 -> country =  'BEL';
		$a1 -> city = 'Gent';
		$a1 -> street = 'Dok Noord';
		$a1 -> number = '5a';
		$a1 -> province =  'O-VL';
		$a1 -> organisationId = 4;
		
		// assert that an address object with 1 missing mandatory property is also not properly populated
		$this -> assertFalse($a1 -> allMandatoryFieldsArePresent());
		
		// populate the last mandatory field
		$a1 -> addressTypeId = 9;
		
		
		// assert that a complete address object IS indeed properly populated
		$this -> assertTrue($a1 -> allMandatoryFieldsArePresent());
    }
    
      
}
  
  
?>
