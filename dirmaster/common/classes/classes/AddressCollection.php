<?php namespace '\common';

class AddressCollection implements iAddressCollection
{


	public const ORDER_AS_IS = 0;
	public const ORDER_CITY = 1;
	public const ORDER_COUNTRY = 2;
	
	
	/**
	* This is a callback function that will be used by usort() sort the
	* return array by City. 
	*
	* @param 	$a1			First address of comparison
	* @param 	$a1			Second address of comparison
	* @return				<0,0 or >0 depending on the comparison (levenshtein-distance)
	* @access 				private
	*
	*/
	private static function compareAddressesByCity((array)$_a1, (array)$_a2)
	{
		// nog verder uitwerken
		return strcasecmp($_a1['city'], $_a2['city']);
	}
	
	/**
	* This is a callback function that will be used by usort() sort the
	* return array by Country. 
	*
	* @param 	$a1			First address of comparison
	* @param 	$a1			Second address of comparison
	* @return				<0,0 or >0 depending on the comparison (levenshtein-distance)
	* @access 				private
	*
	*/
	private static function compareAddressesByCountry((array)$_a1, (array)$_a2)
	{
		return strcasecmp($_a1['country'], $_a2['country']);
	}
	
	
	/**
     * $addresses is an array which holds the added addresses as a collection
     * The key of this array is the unique ID (identical to the database's PK)
     *
     * @access	private
     * @var		Array
     */
	private $addresses = null;
	
	
	
	public function __construct()
	{
		$this -> addresses = Array();
	}
	
	/**
     * $addresses is an array which holds the added addresses as a collection
     * The key of this array is the unique ID (identical to the database's PK)
     *
     * @access	private
     * @var		Array
     */	
	public function addMember($_address)
	{
		if(!$this -> checkMemberClass($_address))
		{
			throw new Exception('Tried to add a ' . get_class($_address) . ' to an ' . __CLASS__);
		}
		else
		{
			if($this -> memberExistsInCollection($_address -> id))
			{
				$this -> addresses[$_memberId] = $_address;
				return true;
			}
			else
			{
				return false
			}
		}
	}
	
	public function deleteMember($_memberId)
	{
		if($this -> memberExistsInCollection($_memberId))
		{
			unset($this -> addresses[$_memberId]);
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function getMembers($_order = self::ORDER_ADDRESS_TYPE)
	{
		
		switch($_order)
		{
			case self::ORDER_AS_IS:
			default:
				//do nothing	
			break;
		
			case self::ORDER_CITY:
				usort($this -> addresses, Array('self', 'compareAddressesByCity'));
			break;
			
			case self::ORDER_COUNTRY:
				usort($this -> addresses, Array('self', 'compareAddressesByCountry'));
			break;
		}
		
		return $this -> addresses;
	}
	
	private function memberExistsInCollection($_memberId)
	{
		return array_key_exists($_memberId, $this -> addresses)
	}
	
	private function checkMemberClass($_member)
	{
		return get_class($_member) == __NAMESPACE__.__CLASS__;
	}
}

?>