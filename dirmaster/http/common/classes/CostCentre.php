<?php namespace '\common';

error_reporting(E_ALL);

/**
 * imputation - class.CostCentre.php
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
 * include Imputation
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('class.Imputation.php');

/* user defined includes */

// section -64--88-0-24--7c34ca1a:1360182a93e:-8000:00000000000009DB-includes end

/* user defined constants */

// section -64--88-0-24--7c34ca1a:1360182a93e:-8000:00000000000009DB-constants end

/**
 * Short description of class CostCentre
 *
 * @access public
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
class CostCentre
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute costCentreId
     *
     * @access public
     * @var Integer
     */
    public $costCentreId = null;

    /**
     * Short description of attribute name
     *
     * @access public
     * @var String
     */
    public $name = null;

    /**
     * Short description of attribute cost
     *
     * @access public
     * @var Integer
     */
    public $cost = null;

    /**
     * Short description of attribute description
     *
     * @access public
     * @var String
     */
    public $description = null;

    // --- OPERATIONS ---

} /* end of class CostCentre */

?>