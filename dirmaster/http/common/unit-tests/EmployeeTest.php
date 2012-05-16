<?php
  
require_once dirname(dirname(__FILE__))."/classes/Entity.php";
require_once dirname(dirname(__FILE__))."/classes/Person.php";
require_once dirname(dirname(__FILE__))."/classes/Employee.php";
require_once dirname(dirname(__FILE__))."/classes/Address.php";


require_once dirname(dirname(__FILE__))."/classes/EmailAddress.php";
require_once dirname(dirname(__FILE__))."/classes/Exceptions.php";

class EmployeeTest extends PHPUnit_Framework_TestCase
{
	
	public function testConstructor()
	{
		$p1 = new Common\Employee();
		$this -> assertEquals(get_class($p1), "Common\Employee");
	}
	
	/**
     * @depends testConstructor
     */
	public function testMagicGetFunction()
    {
		$p1 = new Common\Employee();
		$p1 -> id = 5;
		$this->assertEquals($p1 -> __get('id') , 5);
		$this->assertTrue($p1 -> __get('id') !== false);
		
		
		$this->assertTrue($p1 -> __get('lastname') === false);
		
		$p1 -> lastname = 'Janssens';
		$this->assertEquals($p1 -> __get('lastname') , 'Janssens');
		$this->assertTrue($p1 -> __get('lastname') !== false);
		
		$this->assertFalse($p1 -> __get('fgdhjsdfgkjhsgdfkjhg'));
		$this->assertFalse($p1 -> __get(123));
		$this->assertFalse($p1 -> __get(-1));

		
    }
    
   

      
}
  
  
?>
