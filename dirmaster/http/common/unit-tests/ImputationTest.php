<?php
require_once dirname(dirname(__FILE__))."/classes/Entity.php";
require_once dirname(dirname(__FILE__))."/classes/Person.php";
require_once dirname(dirname(__FILE__))."/classes/Employee.php";
require_once dirname(dirname(__FILE__))."/classes/CostCentre.php";
require_once dirname(dirname(__FILE__))."/classes/Project.php";
require_once dirname(dirname(__FILE__))."/classes/Imputation.php";
require_once dirname(dirname(__FILE__))."/classes/Exceptions.php";

class ImputationTest extends PHPUnit_Framework_TestCase
{
	
	
	/**
     * @expectedException Common\ImputationException
     */
	public function testSetterWrongObjectType()
	{
		$i = new Common\Imputation();
		$i -> id = 1;
		$i -> employee = new Common\Project();
		
	}
	

	public function testSetterToAndFrom()
	{
		$i = new Common\Imputation();
		$i -> id = 1;
		$i -> employee = new Common\Employee();
		$i -> from = new \DateTime('2012-05-15 16:00');
		$i -> to = new \DateTime('2012-05-15 17:00');
		
		$this -> assertEquals($i -> from -> format('Y-m-d H:i'), '2012-05-15 16:00');
		$this -> assertEquals($i -> to -> format('Y-m-d H:i'), '2012-05-15 17:00');
		
	}
	
	/**
     * @expectedException Common\ImputationException
     */
	public function testSetNegativeTimeInterval()
	{
		$i = new Common\Imputation();
		
		//echo "\n\nbefore:\n";
		//print_r($i->from);
		//print_r($i->to);

		
		$i -> id = 1;
		$i -> employee = new Common\Employee();
		$i -> from = new \DateTime('2012-05-15 16:00');
		$i -> to = new \DateTime('2012-05-15 14:00');
		$i -> costCentre = new Common\CostCentre();
		$i -> project = new Common\Project();
		$i -> isBillable = false;
		$i -> comment = '';
		
		//echo "\n\nafter:\n";
		//print_r($i->from);
		//print_r($i->to);
	}


	public function testGetSpentTime()
	{
		$i = new Common\Imputation();
		$i -> id = 1;
		$i -> employee = new Common\Employee();
		$i -> from = new \DateTime('2012-05-15 14:00');
		$i -> to = new \DateTime('2012-05-15 16:30');
		$i -> costCentre = new Common\CostCentre();
		$i -> project = new Common\Project();
		$i -> isBillable = false;
		$i -> comment = '';
		
		$this -> assertEquals($i -> getSpentTime(), 2.5);
		
	}
	
	
	/**
     * @expectedException Common\ImputationException
     */
	public function testGetSpentTimeWhenToIsEmpty()
	{
		$i = new Common\Imputation();
		$i -> id = 1;
		$i -> employee = new Common\Employee();
		$i -> from = new \DateTime('2012-05-15 14:00');
		
		$r = $i -> getSpentTime();
		
	}
	
	/**
     * @expectedException Common\ImputationException
     */
	
	public function testGetSpentTimeWhenFromIsEmpty()
	{

		$i2 = new Common\Imputation();
		$i2 -> id = 1;
		$i2 -> employee = new Common\Employee();
		$i2 -> to = new \DateTime('2012-05-15 16:30');

		$r2 = $i2 -> getSpentTime();

	}
	
}