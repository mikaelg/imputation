<?php namespace '\common';

abstract class Person extends Entity
{

	protected static $myExceptionClass = 'Common\PersonException';
	
	public $userId = null;
	public $name = null;
	public $firstname = null;
	public $gender = false;
	public $emailadresses = '';
	public $adresses = null;
	public $status = null;


    public function Create()
    {
        
        
    }

    /**
     * Short description of method Update
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function Update()
    {
        
        
    }

    /**
     * Short description of method Delete
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function Delete()
    {
        
        
    }

}

?>