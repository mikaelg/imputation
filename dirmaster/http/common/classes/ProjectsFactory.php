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
class ProjectsFactory
{
	protected static $myExceptionClass = 'Common\ProjectsFactoryException';
	private $p;
	private static $projects = array();
	
	public function addToProjectArray($_project) {
		if(\get_parent_class($_project) == "Common\Project"){
			//echo "PARENT CLASS" . \get_parent_class($_project);
			self::$projects[] = $_project;
		}
		else 
			throw new $this::$myExceptionClass('Object is not of type "Common\Project"'); 
	}
	
	public function  getProjectArray(){
		return self::$projects;
	}

    /**
     * Short description of method getProject
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @param  Integer budget
     * @return Project
     */
    public  function getProject($_budget = NULL)
    {

    
    	if(is_null($_budget) || empty($_budget)) {
        	$this->p = new \Common\DirectedProject();
        }
        else {
        	if(!is_numeric($_budget))
        		throw new $this::$myExceptionClass('budget is no numeric value');
        	
        	$this->p = new \Common\QuotedProject(); 
        	$this->p->budget = $_budget;
        }  
            
        
        return $this->p;
    }

  
} /* end of class projectsFactory */

?>