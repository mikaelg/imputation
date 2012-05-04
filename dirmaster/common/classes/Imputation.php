<?php namespace '\common';

error_reporting(E_ALL);

/**
 * imputation - class.Imputation.php
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
 * include CostCentre
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.CostCentre.php');

/**
 * include Employee
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.Employee.php');

/**
 * include Project
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.Project.php');

/**
 * include iEntity
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('interface.iEntity.php');

/* user defined includes */

// section -64--88-0-24--7c34ca1a:1360182a93e:-8000:00000000000009BF-includes end

/* user defined constants */

// section -64--88-0-24--7c34ca1a:1360182a93e:-8000:00000000000009BF-constants end

/**
 * Short description of class Imputation
 *
 * @access public
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
class Imputation
        implements iEntity
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd :     // generateAssociationEnd :     // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute registrationId
     *
     * @access public
     * @var Integer
     */
    public $registrationId = null;

    /**
     * Short description of attribute Employee
     *
     * @access public
     * @var Empoyee
     */
    public $Employee = null;

    /**
     * Short description of attribute from
     *
     * @access public
     * @var DateTime
     */
    public $from = null;

    /**
     * Short description of attribute to
     *
     * @access public
     * @var DateTime
     */
    public $to = null;

    /**
     * Short description of attribute costCentre
     *
     * @access public
     * @var CostCentre
     */
    public $costCentre = null;

    /**
     * Short description of attribute project
     *
     * @access public
     * @var Project
     */
    public $project = null;

    /**
     * Short description of attribute spentTime
     *
     * @access public
     * @var Integer
     */
    public $spentTime = null;

    /**
     * Short description of attribute action
     *
     * @access public
     */
    public $action[ null | null | null ];

    /**
     * Short description of attribute isBillable
     *
     * @access public
     * @var Boolean
     */
    public $isBillable = null;

    /**
     * Short description of attribute comment
     *
     * @access public
     * @var String
     */
    public $comment = null;

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
        
        // section -64--88-0-24--7c34ca1a:1360182a93e:-8000:00000000000008A6 end
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
        
        // section -64--88-0-24--7c34ca1a:1360182a93e:-8000:0000000000000916 end
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
        
        // section -64--88-0-24--7c34ca1a:1360182a93e:-8000:0000000000000918 end
    }

    /**
     * Short description of method CalculateCost
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function CalculateCost()
    {
        
        // section -64--88-0-24--7c34ca1a:1360182a93e:-8000:00000000000009F7 end
    }

} /* end of class Imputation */

?>