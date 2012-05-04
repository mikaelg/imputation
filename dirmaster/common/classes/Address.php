<?php namespace Common;


class Address implements iEntity
{
	private static $fields = Array(	"id"				=> Array("type" =>"Integer",	"mandatory" => true),
									"country" 			=> Array("type" =>"String", 	"mandatory" => true),
									"city"				=> Array("type" =>"String", 	"mandatory" => true),
									"street"			=> Array("type" =>"String", 	"mandatory" => true),
									"number"			=> Array("type" =>"String", 	"mandatory" => true),
									"box"				=> Array("type" =>"String", 	"mandatory" => false),
									"province" 			=> Array("type" =>"String", 	"mandatory" => true),
									"organisationId" 	=> Array("type" =>"Integer",	"mandatory" => true),
									"addressTypeId"		=> Array("type" =>"Integer",	"mandatory" => true),
							);
    
	/**
     * This function determines the validity of present object data accoording to the static field matrix above.
     * 
     *
     * @access 					private
     * @param	$_input_array	Associative Array that holds the candidate data.
     * @return 					Bool
     */
    private static function inputArrayIsValid($_input_array, $_enforceUseOfMandatoryFields = true)
    {
    	if(!is_array($_input_array))
    	{
    		throw new \Exception('input array has to be an array!'); 
    		return false;  
    	}
    	else
    	{
	    	
	    	
	    	$retval = true;
	    	
	    	foreach(self::$fields as $field => $fieldSpec)
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
	    				throw new \Exception('Invalid type "' . $fieldSpec['type'] . '" specified in ' . __CLASS__ . '::fields matrix');
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

    public function __construct()
    {
    	//declare all neccesary properties to null values;
    	foreach(self::$fields as $field => $fieldSpec)
    	{
   			$this -> $field = null;
    	}
    	/*
    	doet dit:
    	$this -> id = null;
    	$this -> country = null;
    	$this -> city = null;
    	$this -> street = null;
    	$this -> number = null;
    	$this -> box = null;
		$this -> province = null:
    	$this -> organisationId = null;
    	$this -> addressTypeId = null;
		*/
    }
    
     
    
   /**
     * This function 
     * 
     * @access 					private
     * @param	$_address_data	Associative Array that holds the candidate address data.
     * @return 					Bool
     */
    private function populate($_address_data, $_enforceUseOfMandatoryFields = true)
    {
        if(self::inputArrayIsValid($_address_data, $_enforceUseOfMandatoryFields))
        {
	        foreach(self::$fields as $field => $fieldSpec)
	    	{
	    		if(($_enforceUseOfMandatoryFields && $fieldSpec['mandatory']) || array_key_exists($field, $_address_data))
	    		{
    				$this -> $field = $_address_data[$field];
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
     * @param	$_address_data	Associative Array that holds the address data.
     * @return 					Bool
     */
    public function Create($_address_data)
    {
    	if(is_null($this -> id))
    	{
    		return $this->populate($_address_data); 
    	}
    	else
    	{
    		
    		throw new \Exception('Cannot invoke ' . __METHOD__ . ' on a non-empty ' . __CLASS__ . ' object!'); 
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
    public function Update($_address_data)
    {
    	
    	if(!is_null($this -> id))
    	{
    		// populate but turn enforcement of mandatory fields off
    		return $this->populate($_address_data, false); 
    	}
    	else
    	{
    		return false;
    		throw new \Exception('Cannot invoke ' . __METHOD__ . ' on an empty ' . __CLASS__ . ' object!');    	
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
    }
}
?>