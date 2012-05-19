<?php namespace Common;

abstract class Entity
{
    protected static $myExceptionClass = 'Common\EntityException';
    

    public function __construct()
    {
    	//$ccls = get_called_class();
    	
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
    	if(array_key_exists($_property, $ccls :: getFieldsArray()))
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
    	/**
    	 * stop if null and not mandatory
    	 */
    	if($this -> isValueNullAndNotMandatory($_property, $value)){
    		return;
    	}
    	
    	
    	if($this -> valueMatchesPropertyType($_property, $value))
    	{
    		$this -> $_property = $value;
    	}

    	else
    	{
    		$ccls = get_called_class();
    		$fields = $ccls :: getFieldsArray();
    		throw new $ccls::$myExceptionClass('Trying to set ' . $ccls.'::'.$_property . ' to ' . $value . ' which is of type ' . gettype($value) . '.  A value of type "' . $fields[$_property]['type'] . '" was expected!' );
    	}
    	
    }
    
    protected  function isValueNullAndNotMandatory($_property, $value){
    	$ccls = get_called_class();
    	$fields = $ccls :: getFieldsArray();
    	if(array_key_exists($_property, $fields))
    	{
    		if($value == null &&  $fields[$_property]['mandatory']  == false)
    			return true;
    		else 
    			return false;
    	}   	
    }
    
    /**
     * convert string to numeric value if is_numeric
     * @param unknown_type $value
     */
    private function ConvertNumeric($_value){
    	if(is_numeric($_value))
    		$_value = $_value + 0;
    	
    	return $_value;
    }
    
    protected function valueMatchesPropertyType($_property, $value)
    {
    	$ccls = get_called_class();
    	$fields = $ccls :: getFieldsArray();
    	if(array_key_exists($_property, $fields))
    	{
    		//echo  . "\n";


    		switch($fields[$_property]['type'])
    		{
    			case 'string':
    				return is_string($value);
    			break;
    			
    			case 'integer':	
    				return is_int($this->ConvertNumeric($value));
    			break;
    			
    			case 'float':
    				return is_float($this->ConvertNumeric($value));
    			break;
    			
    			case 'bool':
    				return is_bool($value);
    			break;
    			
    			case 'array':
    				return is_array($value);
    			break;  			
				
				default:
    				if(class_exists($fields[$_property]['type']))
    				{	
    					if(get_class($value) == $fields[$_property]['type'] || '\\'.get_class($value) == $fields[$_property]['type'])
    					{
    						return true;
    					}
    					else
	    				{
	    					throw new $ccls::$myExceptionClass("expecting " . $fields[$_property]['type'] . ' but got a ' . get_class($value));
	    					return false;
	    				}    				    
    				}
    				else
    				{
    					throw new $ccls::$myExceptionClass($ccls . '::fieldspec contains illegal type: "' . $fields[$_property]['type'] . '"');
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
    	$fields = $ccls :: getFieldsArray();
    	if(!is_array($_input_array))
    	{
    		throw new $ccls::$myExceptionClass('input array has to be an array!'); 
    		return false;  
    	}
    	else
    	{
	    	$retval = true;
	    	print_r($_input_array);
	    	foreach($fields as $field => $fieldSpec)
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
        	$fields = $ccls :: getFieldsArray();
	        foreach($fields as $field => $fieldSpec)
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
     * this function will return the static $fields property from the called class
     * IF that called class doesn't provide an override. If it does, it does so because
     * it has to combine it's own $fields with it's parent's $fields. For example, the 
     * Employee class does this, because Employee extends Person extends Entity
     *
     * @access 					public
     * @author 					Jos Bolssens <marvelade@gmail.com>
     * @return 					Array
     */
    public static function getFieldsArray()
    {
    	$ccls = get_called_class();
    	return $ccls::$fields;
    }
    
    
    public function allMandatoryFieldsArePresent()
    {
    	$ccls = get_called_class();
        $fields = $ccls :: getFieldsArray();
        $retval = true;
        foreach($fields as $fieldname => $fieldspecArray)
        {
        	if($fieldspecArray['mandatory'])
        	{
        		if($this -> __get($fieldname) !== false)
        		{
        			// magic getter returns boolean false if the property hasn't been __set() yet.
        			//
        			// Do nothing; $retval remains true
        		}
        		else
        		{
        			// property is mandatory and not set. Exit and return false
        			return false;
        		}
        		
        	}
        	else
        	{
        		// do nothing, we don't need it anyway
        	}
        }
        
        // not sure if we really need $retval...
        // if we get this far, we might as well just return true, b/c $retval will be true...
        // 3 cheers for unit testing to figure that out :) 
        return $retval;
        
    }
    
    
    /**
     * Short description of method Create
     *
     * @access 					public
     * @author 					firstname and lastname of author, <author@example.org>
     * @param	$_data_array	Associative Array that holds the address data.
     * @return 					Bool
     */
    /*public function Create($_data_array)
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
              
    }*/
    
    

    /**
     * Short description of method Update
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
   /* public function Update($_data_array)
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
        
    }*/

}

?>