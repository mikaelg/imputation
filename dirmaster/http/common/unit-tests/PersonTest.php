<?php
  
require_once dirname(dirname(__FILE__))."/classes/Entity.php";
require_once dirname(dirname(__FILE__))."/classes/Person.php";
require_once dirname(dirname(__FILE__))."/classes/Address.php";


require_once dirname(dirname(__FILE__))."/classes/EmailAddress.php";
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
		
		$this->assertTrue($p1 -> __get('id') !== false);
		$this->assertTrue($p1 -> __get('lastname') !== false);
		
		$this->assertFalse($p1 -> __get('fgdhjsdfgkjhsgdfkjhg') !== false);
		$this->assertFalse($p1 -> __get(123) !== false);
		$this->assertFalse($p1 -> __get(-1) !== false);

		
    }
    
    
    /**
     * @depends testConstructor
     */
    public function testCreateWithAllFieldsFilled()
    {
    	$p1 = new Common\Person();
    	
    	
    	$e = new Common\EmailAddress();
    	$e -> id = 1;
    	$e -> email = 'jantje@joepiedepoepie.nl';
    	$eac = new \ArrayObject();
    	$eac[0] = $e;
    	
    	
    	
    	
    	
    	
		
		$a = new Common\Address();
    	$a -> id = 5;
		$a -> country = 'BEL';
		$a -> city = 'Gent';
		$a -> street = 'Dok Noord';
		$a -> number = '5a';
		$a -> nepveld = 'Mwhuhahahahaaaa';
		$a -> box = '3';
		$a -> province = 'O-VL';
		$a -> organisationId = 4;
		$a -> addressTypeId = 9;
    	
    	$ac = new \ArrayObject();
    	$ac[0] = $ac;
    	
    	
    	
    	
    	$gp1 =Array(	"id" => 5,
						"lastname"=> 'Janssens',
						"firstname"=> 'Jan',
						"gender"=> 'M',
						"emailaddresses"=> $eac,
						"addresses"=> $ac,
						"status"=> 'Geen idee wat dit is'
			);

  		
  		
  		// Put "good" data in $p1					
  		$p1 -> Create($gp1);

  		
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
