<?php

class ThirtytwoTable extends DatabaseObject {
static protected $table_name = " table_32";
static protected $db_columns = ['slno','SNo','Name','usertype','Department','Designation','EmailId','Password','Mobile','Address','City','State','Country','School','Title','ISBN','author_name','Registration','Validity','Status'];

public $slno;
public $SNo;
public $Name;
public $usertype;
public $Department;
public $EmailId;
public $Designation;
public $Password;
public $Mobile;
public $Address;
public $City;
public $State;
public $Country;
public $School;
public $Title;
public $author_name;
public $ISBN;
public $Registration;
public $Validity;
public $Status;
  
    public function __construct($args = [])
    {
          $this->SNo = $args['SNo'] ?? '';
          $this->Name = $args['Name'] ?? '';
          $this->usertype = $args['usertype'] ?? '';
          $this->Department = $args['Department'] ?? '';
          $this->EmailId = $args['EmailId'] ?? '';
          $this->Designation = $args['Designation'] ?? '';
          $this->Password = $args['Password'] ?? '';
          $this->Mobile = $args['Mobile'] ?? '';
          $this->Address = $args['Address'] ?? '';
          $this->City = $args['City'] ?? '';
          $this->State = $args['State'] ?? '';
          $this->Country = $args['Country'] ?? '';
          $this->School = $args['School'] ?? '';
          $this->Title = $args['Title'] ?? '';
          $this->author_name = $args['author_name'] ?? '';
          $this->ISBN = $args['ISBN'] ?? '';
          $this->Registration = $args['Registration'] ?? '';
          $this->Validity = $args['Validity'] ?? '';
          $this->Status = $args['Status'] ?? '';
           
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY id desc";
        $result = self::$database->query($sql);
        if (!$result) {
            exit("Database query failed.");
        }

        // results into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }

    static public function find_by_detail_id() {
        $sql = "SELECT * FROM " . static::$table_name . " ";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
  
    public static function delete_address($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>