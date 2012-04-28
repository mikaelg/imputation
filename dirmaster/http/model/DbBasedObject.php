<?php  

  abstract class DbBasedObject
  {

    protected static $dbTbl = '';
    protected static $PkFieldName = '';
    public static $dbFields = Array();
    public function __construct($_id)
    {
      // $dbh best in Settings object steken
      $this -> dbh = new PDO('mysql:host=localhost;dbname=imputation', 'root', '');
      
      $ccls = get_called_class();
      $sql = "DESCRIBE " . $ccls :: $dbTbl;
      echo $sql;
      $this -> stmt = $this -> dbh -> prepare($sql);
      $this -> stmt -> execute();

      while($row = $this -> stmt -> fetch(PDO::FETCH_ASSOC))
      {
        $ccls :: $dbFields[] = $row['Field'];
      }

      
      
      $sql = "SELECT * FROM " . $ccls :: $dbTbl . " WHERE " . $ccls :: $PkFieldName . " = " . intval($_id);
     
      $this -> stmt = $this -> dbh -> prepare($sql);
      //$this -> stmt -> bindValue(":id", intval($_id), PDO::PARAM_INT);
      $this -> stmt -> execute();
      if($this -> stmt -> errorCode() !== '00000')
      {
        throw new Exception("There was an error in your SQL statement " . $sql . "(" . $this -> stmt -> errorCode() . ")");
        exit();
      }
      else
      {
        while($row = $this -> stmt -> fetch(PDO::FETCH_ASSOC))
        {
          foreach($row as $fieldName => $value)
          $this -> $fieldName = $value;
        }
      } 
    }
    
    public static function get_all()
    {
      // $dbh best in Settings object steken
      $dbh = new PDO('mysql:host=localhost;dbname=imputation', 'root', '');
      $ccls = get_called_class();
      $sql = "SELECT * FROM " . $ccls :: $dbTbl . " WHERE 1";
     
      $stmt = $dbh -> prepare($sql);
      $stmt -> execute();
      if($stmt -> errorCode() !== '00000')
      {
        throw new Exception("There was an error in your SQL statement " . $sql . "(" . $stmt -> errorCode() . ")");
        exit();
      }
      else
      {
        $returnArray = Array();
        while($row = $stmt -> fetch(PDO::FETCH_ASSOC))
        {
          $returnArray[] = new $ccls($row[$ccls :: $PkFieldName]);
        }
        return $returnArray;
      }
    }
    
    public function update()
    {
      /*
      *
      * Hier zit nog e.e.a. scheef
      *            
      *
      **/            
      $ccls = get_called_class();
      $sql = "UPDATE " . $ccls :: $dbTbl . " SET (";
      foreach($ccls :: $dbFields as $index => $fieldname)
      {
        if(!is_null($this -> $fieldname))
        {
          $sql .= $fieldname . " = :" . $fieldname . " ,";
        }
        else
        {
          $sql .= $fieldname . " = NULL ,";
        }
      }
      
      //laatste komma eraf
      $sql = substr($sql, 0, -1);
  
      $sql .= " LIMIT 1";
      
      
      $stmt = $this -> dbh -> prepare($sql);
      foreach($ccls :: $dbFields as $index => $fieldname)
      {
        if(!is_null($this -> $fieldname))
        {
          $stmt -> bindValue(':'.$fieldname, $this -> $fieldname);
        }
      }
      
      $stmt -> execute();
      //echo ($stmt -> debugDumpParams());
      /*if($stmt -> errorCode() !== '00000')
      {
        throw new Exception("There was an error in your SQL statement " . $sql . "(" . $stmt -> errorCode() . ")");
        
        
        
        exit();
      }*/
      
      
    }
    
  }
?>
