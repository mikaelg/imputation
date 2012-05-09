<?php
  
require_once dirname(dirname(__FILE__))."/classes/iEntity.php";
require_once dirname(dirname(__FILE__))."/classes/iCollection.php";
require_once dirname(dirname(__FILE__))."/classes/iAddressCollection.php";
require_once dirname(dirname(__FILE__))."/classes/Address.php";
require_once dirname(dirname(__FILE__))."/classes/AddressCollection.php";
require_once dirname(dirname(__FILE__))."/classes/Exceptions.php";

class AddressCollectionTest extends PHPUnit_Framework_TestCase
{
	
	public function testgetMembers()
	{
		$ac1 = new Common\AddressCollection();
		
		
	}


	public function testConstructor()
	{
		$ac1 = new Common\AddressCollection();
		$this -> assertEmpty($ac1 -> getMembers());
		$this -> assertTrue(is_array($ac1 -> getMembers()));
		$this -> assertCount(0, $ac1 -> getMembers());
		
		
	}


	/**
     * @expectedException Common\AddressCollectionException
     */
	public function testAddMemberForException()
	{
		//
		$a1 = new \SplObjectStorage();
		$ac1 = new Common\AddressCollection();
		
		$this -> assertFalse($ac1 -> addMember($a1));
		
	}
	
	
}

?>