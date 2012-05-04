<?php namespace '\common';

error_reporting(E_ALL);

/**
 * imputation - class.Contact.php
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
 * include Employee
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.Employee.php');

/**
 * include Person
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.Person.php');

/**
 * include Project
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.Project.php');

/* user defined includes */

// section -64--88-0-24--7c34ca1a:1360182a93e:-8000:0000000000000939-includes end

/* user defined constants */

// section -64--88-0-24--7c34ca1a:1360182a93e:-8000:0000000000000939-constants end

/**
 * Short description of class Contact
 *
 * @access public
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
class Contact
    extends Person
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd :     // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute InternalContact
     *
     * @access public
     * @var Employee
     */
    public $InternalContact = null;

    // --- OPERATIONS ---

} /* end of class Contact */

?>