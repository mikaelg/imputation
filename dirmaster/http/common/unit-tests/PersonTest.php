<?php
  
require_once dirname(dirname(__FILE__))."/classes/Entity.php";
require_once dirname(dirname(__FILE__))."/classes/Person.php";
require_once dirname(dirname(__FILE__))."/classes/Address.php";


require_once dirname(dirname(__FILE__))."/classes/Exceptions.php";

class PersonTest extends PHPUnit_Framework_TestCase
{
	
	public function testConstructor()
	{
		$p1 = new Common\Person();
		$this -> assertEquals(get_class($p1), "Common\Person");
	}
	
	/**
     * @depends testConstructor
     */
	public function testMagicGetFunction()
    {
		$p1 = new Common\Person();
		$p1 -> id = 5;
		$this->assertEquals($p1 -> __get('id') , 5);
		$this->assertTrue($p1 -> __get('id') !== false);
		
		
		
		//$this->assertTrue($p1 -> __get('lastname') !== false);
		
		$this->assertFalse($p1 -> __get('fgdhjsdfgkjhsgdfkjhg'));
		$this->assertFalse($p1 -> __get(123));
		$this->assertFalse($p1 -> __get(-1));

		
    }
    
    
    /**
     * @depends testConstructor
     */
    public function testCreateWithAllFieldsFilled()
    {
    	$p1 = new Common\Person();
    	
    	$eac = new \ArrayObject();
    	$eac[] = 'jantje@joepiedepoepie.nl';
    	
    	
    	
    	
    	
    	
		
		$a = new Common\Address();
    	$a -> id = 5;
		$a -> country = 'BEL';
		$a -> city = 'Gent';
		$a -> street = 'Dok Noord';
		$a -> number = '5a';

		$a -> box = '3';
		$a -> province = 'O-VL';
		$a -> organisationId = 4;
		$a -> addressTypeId = 9;
    	
    	$ac = new \ArrayObject();
    	$ac[0] = $ac;
    	
    	
    	
    	
    	$p1 -> id = 5;
		$p1 -> lastname ='Janssens';
		$p1 -> firstname = 'Jan';
		$p1 -> gender = 'M';
		$p1 -> emailaddresses = $eac;
		$p1 -> addresses = $ac;
		$p1 -> status ='Geen idee wat dit is';


  		
  		// Check if it arrived well			
  		$this->assertTrue($p1 -> id !== false);
  		// and has the correct value
  		$this->assertEquals($p1 -> id , 5);
  		
  		
  		// assert that nep-veld didn't make it into the object
  		$this->assertClassNotHasAttribute('nep-veld', 'Common\Person');	
		
		// and that teh magic getter will also return false if asked for it
		$this->assertFalse($p1 -> __get('nep-veld'));  
  							
        
    	
    }


          

      
}
  
  
?>
