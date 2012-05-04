<?php namespace '\common';

abstract class Person implements iEntity
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd :     // generateAssociationEnd :     // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute userId
     *
     * @access public
     * @var Integer
     */
    public $userId = null;

    /**
     * Short description of attribute name
     *
     * @access public
     * @var String
     */
    public $name = null;

    /**
     * Short description of attribute firstname
     *
     * @access public
     * @var String
     */
    public $firstname = null;

    /**
     * Short description of attribute gender
     *
     * @access public
     * @var bool
     */
    public $gender = false;

    /**
     * Short description of attribute emailadresses
     *
     * @access public
     * @var string
     */
    public $emailadresses = '';

    /**
     * Short description of attribute adresses
     *
     * @access public
     * @var Address
     */
    public $adresses = null;

    /**
     * Short description of attribute status
     *
     * @access public
     * @var Integer
     */
    public $status = null;

    // --- OPERATIONS ---

    /**
     * Short description of method Create
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
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

} /* end of abstract class Person */

?>