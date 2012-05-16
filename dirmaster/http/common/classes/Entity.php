<?php namespace Common;

abstract class Entity
{
    protected static $myExceptionClass = 'Common\EntityException';
    

    public function __construct()
    {
    	$ccls = get_called_class();
    	
    	// declare all neccesary properties to empty values, so they can be checked with isset();
    	// the isset function returns false if a variable is set to null
    	
    	//not sure if initialisation is such a good idea...
    	// commenting it out for now 
    	
    	/*foreach($ccls::$fields as $field => $fieldSpec)
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
    			
    			case 'bool':
    				$this -> field = false;
    			break;
    			
    			default:
    				if(class_exists($fieldSpec['type']))
    				{
    				    //self-reference would create an endless loop
    				    if($fieldSpec['type'] != $ccls)
    				    {
                            //echo 'Type: ' . $fieldSpec['type'] . '<br />';
                            $this -> $field = new $fieldSpec['type'];
                        }
                        else
                        {
                            $this -> $field = null;
                        }
    				    
    				}
    				else
    				{
    					throw new $ccls::$myExceptionClass($ccls . '::fieldspec contains illegal type: "' . $fieldSpec['type'] . '"');
    				}
    			break;
    		}
   			
    	}*/
    	
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
    
    public function __set($_property, $value)
    {
    	if($this -> valueMatchesPropertyType($_property, $value))
    	{
    		$this -> $_property = $value;
    	}
    	
    }
    
    protected function valueMatchesPropertyType($_property, &$value)
    {
    	$ccls = get_called_class();
    	if(array_key_exists($_property, $ccls :: $fields))
    	{
    		switch($ccls :: $fields[$_property]['type'])
    		{
    			case 'string':
    				return is_string($value);
    			break;
    			
    			case 'integer':
    				return is_int($value);
    			break;
    			
    			case 'float':
    				return is_float($value);
    			break;
    			
    			case 'bool':
    				return is_bool($value);
    			break;
    			
    			case 'array':
    				return is_array($value);
    			break;  			
				
				default:
    				if(class_exists($ccls :: $fields[$_property]['type']))
    				{	
    					if(get_class($value) == $ccls :: $fields[$_property]['type'] || '\\'.get_class($value) == $ccls :: $fields[$_property]['type'])
    					{
    						return true;
    					}
    					else
	    				{
	    					throw new $ccls::$myExceptionClass("expecting " . $ccls :: $fields[$_property]['type'] . ' but got a ' . get_class($value));
	    					return false;
	    				}    				    
    				}
    				else
    				{
    					throw new $ccls::$myExceptionClass($ccls . '::fieldspec contains illegal type: "' . $ccls :: $fields[$_property]['type'] . '"');
    					return false;
    				}
    			break;
    		}
    		
    	}
    	else
    	{
    		throw new $ccls::$myExceptionClass($_property . ' is no valid property for class ' . $ccls);
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
	    	print_r($_input_array);
	    	foreach($ccls::$fields as $field => $fieldSpec)
	    	{
	    		if(array_key_exists($field, $_input_array))
	    		{
	    			$typeCheckFunction = 'is_'.$fieldSpec['type'];
	    			if(is_callable($typeCheckFunction))
	    			{
	    				//echo "is " . $_input_array[$field] . " really a  " . $fieldSpec['type'] . "? ";
	    				//echo ($typeCheckFunction($_input_array[$field])) ? " Yes it is" : " No it isn't";
	    				//echo "\n";
	    				$retval = $typeCheckFunction($_input_array[$field]) && $retval;
	    			}
	    			elseif(class_exists($fieldSpec['type']))
	    			{
	    				//echo "Does " . get_class($_input_array[$field]) . " equal " . $fieldSpec['type'] . "? ";
	    				//echo (get_class($_input_array[$field]) == $fieldSpec['type']) ? " Yes it does" : " No it doesn't";
	    				//echo "\n";
	    				$retval = (get_class($_input_array[$field]) == $fieldSpec['type']) && $retval;
	    			}
	    			else
	    			{
	    				
	    				$errMsg = 'Invalid type "' . $fieldSpec['type'] . '" specified in ' . $ccls . '::fields matrix ';
	    				
	    				if(!is_callable($typeCheckFunction))
		    			{
		    				$errMsg.= 'because ' . $typeCheckFunction . ' is not callable' ;
		    			}
		    			elseif(!class_exists($fieldSpec['type']))
		    			{
		    				$errMsg.= 'because class' . $fieldSpec['type'] . ' does not exist' ;
		    			}
		    			
	    				throw new $ccls::$myExceptionClass($errMsg);
	    				return false; 
	    			}
	    		
	    		}
	    		elseif($_enforceUseOfMandatoryFields && $fieldSpec['mandatory'])
	   			{
	   				throw new $ccls::$myExceptionClass('Field ' . $field . ' is marked as mandatory yet not provided!');
	   				
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
    	$ccls = get_called_class();

    	if(isset($this -> id))
    	{
    		return $this->populate($_data_array); 
    	}
    	else
    	{
    		
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