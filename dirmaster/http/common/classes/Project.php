<?php namespace '\common';

class Project implements iEntity
{

    /**
     * Unique identifier of this project
     *
     * @access public
     * @var UnlimitedInteger
     */
    public $projectId = null;

    /**
     * Name of the project; should also be unique
     *
     * @access public
     * @var String
     */
    public $name = null;

    /**
     * This property holds an instance of the ProjectType class
     *
     * @access public
     * @var ProjectType
     */
    public $type = null;

    /**
     * This property holds a reference to the project that this project resides under
     * It can be null if this is a top-level project
     *
     * @access public
     * @var Project
     */
    public $parentProject = null;

    /**
     * Short description of attribute teamMembers
     *
     * @access public
     * @var EmployeesCollection
     */
    public $teamMembers = null;

    /**
     * Short description of attribute customerCompany
     *
     * @access public
     * @var CustomerCompany
     */
    public $customerCompany = null;

    /**
     * Short description of attribute startDate
     *
     * @access public
     * @var String
     */
    public $startDate = null;

    /**
     * Short description of attribute endDate
     *
     * @access public
     * @var String
     */
    public $endDate = null;

    /**
     * Short description of attribute status
     *
     * @access public
     * @var ProjectStatuses
     */
    public $status = null;

    /**
     * Short description of attribute totalCost
     *
     * @access public
     * @var Integer
     */
    public $totalCost = null;

    /**
     * Short description of attribute contacts
     *
     * @access public
     * @var ContactsCollection
     */
    public $contacts = null;

    // --- OPERATIONS ---

    /**
     * Short description of method Create
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function create()
    {
        
        
    }

    /**
     * Short description of method Update
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function update()
    {
        
        
    }

    /**
     * Short description of method Delete
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function delete()
    {
        
        
    }

    /**
     * Short description of method GetProjectType
     *
     * @access protected
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    protected function getProjectType()
    {
        
        
    }

    /**
     * Short description of method GetChildProjects
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function getChildProjects()
    {
        
        
    }

    /**
     * Short description of method AddChildProject
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function addChildProject()
    {
        
        
    }

    /**
     * Short description of method GetEmployeeCompany
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function getEmployeeCompany()
    {
        
        
    }

    /**
     * Short description of method GetCustomerCompany
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function getCustomerCompany()
    {
        
        
    }

    /**
     * Short description of method DeleteChildProject
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function deleteChildProject()
    {
        
        
    }

    /**
     * Short description of method CalculateTotalHours
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function calculateTotalHours()
    {
        
        
    }

    /**
     * Short description of method CalculateRestBudget
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function calculateRestBudget()
    {
        
        
    }

    /**
     * Short description of method ShowRegistrations
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function showRegistrations()
    {
        
        
    }

    /**
     * Short description of method ShowActions
     *
     * @access public
     * @author Jos Bolssens, <marvelade@gmail.com>
     * @return mixed
     */
    public function showActions()
    {
        
        
    }

} /* end of class Project */

?>