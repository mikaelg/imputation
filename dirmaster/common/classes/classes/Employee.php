<?php namespace '\common';

error_reporting(E_ALL);

/**
 * imputation - class.Employee.php
 *
 * $Id$
 *
 * This file is part of imputation.
 *
 * Automatically generated on 04.05.2012, 15:40:41 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * include Contact
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.Contact.php');

/**
 * include Imputation
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.Imputation.php');

/**
 * include Person
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.Person.php');

/* user defined includes */

// section -64--88-0-24--7c34ca1a:1360182a93e:-8000:000000000000093D-includes end

/* user defined constants */

// section -64--88-0-24--7c34ca1a:1360182a93e:-8000:000000000000093D-constants end

/**
 * Short description of class Employee
 *
 * @access public
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
class Employee
    extends Person
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd :     // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute functionDescription
     *
     * @access public
     * @var Integer
     */
    public $functionDescription = null;

    // --- OPERATIONS ---

    /**
     * Short description of method setFunctionDescription
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function setFunctionDescription()
    {
        
        // section -64--88-60--125-5c3e667:13635f6627f:-8000:0000000000000B13 end
    }

    /**
     * Short description of method getFunctionDescription
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function getFunctionDescription()
    {
        
        // section -64--88-60--125-5c3e667:13635f6627f:-8000:0000000000000B15 end
    }

} /* end of class Employee */

?>