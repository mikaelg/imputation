<?php namespace '\common'

abstract class Organisation implements iEntity
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd :     // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute organisationId
     *
     * @access public
     * @var Integer
     */
    public $organisationId = null;

    /**
     * Short description of attribute name
     *
     * @access public
     * @var String
     */
    public $name = null;

    /**
     * Short description of attribute addresses
     *
     * @access public
     * @var AddressCollection
     */
    public $addresses = null;

    /**
     * Short description of attribute users
     *
     * @access public
     * @var Person
     */
    public $users = null;

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

} /* end of abstract class Organisation */

?>