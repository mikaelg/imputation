<?php namespace Common;

abstract class Entity
{
    protected static $myExceptionClass = 'Common\EntityException';
    
    
    public function __construct()
    {
    	$ccls = get_called_class();
    	
    	// declare all neccesary properties to empty values, so they can be checked with isset();
    	// the isset function returns false if a variable is set to null
    	foreach($ccls::$fields as $field => $fieldSpec)
    	{
    		switch($fieldSpec['type'])
    		{
    			case 'string':
    				$this -> $field = '';
    			break;
    			
    			case 'integer':
    			case 'float':
    				$this -> $field = 0;
    			break;
    			
    			default:
    				throw new $ccls::$myExceptionClass($ccls . '::fieldspec contains illegal type: "' . $fieldSpec['type'] . '"');
    			break;
    		}
   			
    	}
    	
    }
    
    
    public function __get($_property)
    {
    	$ccls = get_called_class();
    	if(array_key_exists($_property, $ccls :: $fields))
    	{
    		return isset($this-> $_property) ? $this-> $_property : false;
    	}
    	else
    	{
    		return false;
    	}
    	
    }
    
    
    
    
    /**
     * This function determines the validity of present object data accoording to the static field matrix above.
     * 
     *
     * @access 					private
     * @param	$_input_array	Associative Array that holds the candidate data.
     * @return 					Bool
     */
    public static function inputArrayIsValid($_input_array, $_enforceUseOfMandatoryFields = true)
    {
    	$ccls = get_called_class();
    	if(!is_array($_input_array))
    	{
    		throw new $ccls::$myExceptionClass('input array has to be an array!'); 
    		return false;  
    	}
    	else
    	{
	    	$retval = true;
	    	
	    	foreach($ccls::$fields as $field => $fieldSpec)
	    	{
	    		if(array_key_exists($field, $_input_array))
	    		{
	    			$typeCheckFunction = 'is_'.$fieldSpec['type'];
	    			if(is_callable($typeCheckFunction))
	    			{
	    				$retval = $typeCheckFunction($_input_array[$field]) && $retval;
	    			}
	    			else
	    			{
	    				
	    				throw new $ccls::$myExceptionClass('Invalid type "' . $fieldSpec['type'] . '" specified in ' . $ccls . '::fields matrix');
	    			}
	    		
	    		}
	    		elseif($_enforceUseOfMandatoryFields && $fieldSpec['mandatory'])
	   			{
	   				return false;   			
	   			}
	    	}
	
	    	return $retval;
    	}
    }
    
    
    
    
     /**
     * This function populates the private variables in one go through an array
     * 
     * @access 					private
     * @param	$_data_array	Associative Array that holds the candidate address data.
     * @return 					Bool
     */
    protected function populate($_data_array, $_enforceUseOfMandatoryFields = true)
    {
    	
        if(self::inputArrayIsValid($_data_array, $_enforceUseOfMandatoryFields))
        {
        	$ccls = get_called_class();
	        foreach($ccls::$fields as $field => $fieldSpec)
	    	{
	    		if(($_enforceUseOfMandatoryFields && $fieldSpec['mandatory']) || array_key_exists($field, $_data_array))
	    		{
    				$this -> $field = $_data_array[$field];
    			}	    		
	        }
	        return true;
        }
        else
        {
        	return false;        
        }
        
    }
    
    
    
    /**
     * Short description of method Create
     *
     * @access 					public
     * @author 					firstname and lastname of author, <author@example.org>
     * @param	$_data_array	Associative Array that holds the address data.
     * @return 					Bool
     */
    public function Create($_data_array)
    {
    	if(isset($this -> id))
    	{
    		return $this->populate($_data_array); 
    	}
    	else
    	{
    		$ccls = get_called_class();
    		throw new $ccls::$myExceptionClass('Cannot invoke ' . __METHOD__ . ' on a non-empty ' . $ccls . ' object!'); 
    		return false;   	
    	}
              
    }
    
    

    /**
     * Short description of method Update
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function Update($_data_array)
    {
    	
    	if(!isset($this -> id))
    	{
    		// populate but turn enforcement of mandatory fields off
    		return $this->populate($_data_array, false); 
    	}
    	else
    	{
    		$ccls = get_called_class();
    		throw new $ccls::$myExceptionClass('Cannot invoke ' . __METHOD__ . ' on an empty ' . $ccls . ' object!');
    		return false;    	
    	}
        
    }

    /**
     * Short description of method Delete
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function Delete()
    {
        /* unset($this) werkt niet... dus wellicht heeft deze method geen zin, tenzij er
         * effectief een record uit de databank weg moet, maar dat kan hier in deze common 
         * class sowieso niet; we gingen deze classes onafhankelijk van de DAL houden... 
         */ 
         
        return true;
    }}

?>