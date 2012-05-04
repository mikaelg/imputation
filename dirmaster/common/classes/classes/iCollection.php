<?php namespace '\common';

error_reporting(E_ALL);

/**
 * imputation - interface.iCollection.php
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

/* user defined includes */

// section -64--88-60--125-5c3e667:13635f6627f:-8000:0000000000000AE0-includes end

/* user defined constants */

// section -64--88-60--125-5c3e667:13635f6627f:-8000:0000000000000AE0-constants end

/**
 * Short description of class iCollection
 *
 * @access public
 * @author Jos Bolssens, <marvelade@gmail.com>
 */
interface iCollection
{


    // --- OPERATIONS ---

    /**
     * Short description of method addMember
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @param  iEntity _member
     * @return mixed
     */
    public function addMember( iEntity $_member);

    /**
     * Short description of method deleteMember
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @param  iEntity _member
     * @return mixed
     */
    public function deleteMember( iEntity $_member);

    /**
     * Short description of method getMembers
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function getMembers();

    /**
     * Short description of method checkMemberClass
     *
     * @access private
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    private function checkMemberClass();

} /* end of interface iCollection */

?>