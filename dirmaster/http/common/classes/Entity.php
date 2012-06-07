<?php namespace Common;

abstract class Entity
{
    protected static $myExceptionClass = 'Common\EntityException';
    private static $fields;

    public function __construct()
    {
    	// Voorlopig leeg    	
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
    private function convertNumeric($_value){
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
    				return is_int($this->convertNumeric($value));
    			break;
    			
    			case 'float':
    				return is_float($this->convertNumeric($value));
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
     * this function is defined as abstract, because child functions MUST implement it
     *
     * @access 					public
     * @author 					Jos Bolssens <marvelade@gmail.com>
     * @return 					Array
     */
    public abstract static function getFieldsArray();    
    
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