<?php namespace '\common';

error_reporting(E_ALL);

/**
 * imputation - class.ProjectsCollection.php
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
 * include iProjectsCollection
 *
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
require_once('interface.iProjectsCollection.php');

/* user defined includes */

// section -64--88-60--125-5c3e667:13635f6627f:-8000:0000000000000AF0-includes end

/* user defined constants */

// section -64--88-60--125-5c3e667:13635f6627f:-8000:0000000000000AF0-constants end

/**
 * Short description of class ProjectsCollection
 *
 * @abstract
 * @access public
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
abstract class ProjectsCollection
        implements iProjectsCollection
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * Short description of attribute projects
     *
     * @access private
     * @var Array
     */
    private $projects = null;

    // --- OPERATIONS ---

} /* end of abstract class ProjectsCollection */

?>