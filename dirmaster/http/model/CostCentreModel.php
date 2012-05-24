<?php namespace be\imputation;

class CostCentreModel extends Model {

	public function __construct(){
		parent::__construct();
	}
	
	public static function getCostCentres()
	{
			
		$sql = "SELECT cc.idCostCentre FROM costcentres AS cc WHERE 1 ";
		$stmt = self::createDal() -> prepare($sql);
		$stmt -> execute();
		
		$retArr = array();
		$row = $stmt -> fetchAll();
		foreach ($row as $data)
		{
			$retArr[] = self::getCostCentreValuesById($data['idCostCentre']);
		}
		
		return $retArr;
		
		
	}
	
	public static function getCostCentreValuesById($_ccID)
	{
		
		$cc = new \Common\CostCentre();
		$cc->id = $_ccID;		
		self :: getCostCentreData($cc);
		
		return $cc;		
	}

	private static function getCostCentreData(&$_cc_obj){

        $sql = "SELECT cc.* FROM costcentres AS cc WHERE cc.idCostCentre = :ccid LIMIT 1";
		$stmt = self::createDal() -> prepare($sql);
		$stmt -> bindValue(':ccid', $_cc_obj->__get('id'), \PDO::PARAM_INT);
		$stmt -> execute();
		$row = $stmt -> fetchAll();
	    
	    if($stmt -> errorCode() == "00000")
	    {
			$_cc_obj -> id 			= $row[0]["idCostCentre"];
			$_cc_obj -> shorthand 	= $row[0]['code'];
			$_cc_obj -> description = $row[0]['name'];


			return true;
		}
	    else
	    {
			throw new \Exception("Error #" . $stmt -> errorCode() . ' in query!');
			return false;
		}
	    
        
	}
	
	
	
	
	
}