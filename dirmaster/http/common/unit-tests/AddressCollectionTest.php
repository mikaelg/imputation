<?php
  
require_once dirname(dirname(__FILE__))."/classes/Exceptions.php";
require_once dirname(dirname(__FILE__))."/classes/Entity.php";
require_once dirname(dirname(__FILE__))."/classes/Address.php";
require_once dirname(dirname(__FILE__))."/classes/Collection.php";
require_once dirname(dirname(__FILE__))."/classes/AddressCollection.php";


class AddressCollectionTest extends PHPUnit_Framework_TestCase
{
	
	public function testConstructor()
	{
		$ac1 = new Common\AddressCollection();
		
		//assert if $ac1 is of the correct type
		$this -> assertTrue(get_class($ac1) === "Common\AddressCollection");
		
		// assert that its empty
		// Because SplObjectStorage implements Countable, you can just apply the count() function to it :) 
		$this -> assertCount(0, $ac1);
	}


	/**
     * @expectedException Common\AddressCollectionException
     */
	public function testAttachForExceptionWhenAttachingWrongObjectType()
	{
		
		$ac1 = new Common\AddressCollection();
		
		// make a wrong object
		$a1 = new \StdClass();
		
		
		//try to put it into the AddressCollection and assert that it triggers the right Exception
		$this -> assertFalse($ac1 -> attach($a1));	
	}
	
	public function testAttach()
	{
		$ac1 = new Common\AddressCollection();
		
		$a1 = new Common\Address();
    	
    	$g1 = array(		
    						"id"				=> 5,
							"country" 			=> 'BEL',
							"city"				=> 'Gent',
							"street"			=> 'Dok Noord',
							"number"			=> '5a',
							"box"        		=>  '3',
							"province" 			=> 'O-VL',
							"organisationId" 	=> 4,
							"addressTypeId"		=> 9
							);

  		
  		
  		// Put "good" data in $a1					
  		$a1 -> Create($g1);
		
		// attach the address to the AddressCollection
		$ac1 -> attach($a1);
		
		// assert that 1 object made it into the collection
		$this -> assertCount(1, $ac1);
		
		// assert that the correct object made it into the collection
		$this -> assertTrue($ac1->contains($a1));
		
		
		//assert that the id of the attached object is 5
		$this -> assertEquals(5, $ac1->getElementById(5)-> id );
		
	}
	
	
}

?>