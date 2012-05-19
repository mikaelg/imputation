<?php namespace Common;

/**
 * include Project
 *
 * @author firstname and lastname of author, <author@example.org>
 */
//require_once('class.Project.php');

/**
 * Short description of class ProjectsFactory
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 */
class projectsFactory
{
	protected static $myExceptionClass = 'Common\ProjectFactoryException';
	private $p;
	

    /**
     * Short description of method newProject
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  Integer budget
     * @return Project
     */
    public  function newProject($_budget)
    {

    
    	if(is_null($_budget) || empty($_budget)) {
        	$this->p = new \Common\DirectedProject();
        }
        else {
        	if(!is_numeric($_budget))
        		throw new $this::$myExceptionClass('budget is no numeric value');
        	
        	$this->p = new \Common\QuoteProject(); 
        	$this->p->budget = $_budget;
        }  
            
        
        return $this->p;
    }

    /**
     * Short description of method getProject
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  Integer ProjectId
     * @param  Integer budget
     * @return Project
     */
    public  function getProject($_projectId,$_budget = NULL)
    {
        if(is_null($_projectId) || empty($_projectId))
        	throw new $this::$myExceptionClass('projectId is null or empty');
        
        $this->p->id = $_projectId;
        return $this->newProject($_budget);
    }

} /* end of class projectsFactory */

?>