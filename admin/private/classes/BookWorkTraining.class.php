<?php

class BookWorkTraining extends DatabaseObject {
static protected $table_name = "books_workshop_training";
static protected $db_columns = ['work_id','work_school_name','work_principal_name','work_address','work_country','work_state','work_city','work_email','work_mobile','work_firstname','work_designation','work_landline','work_zip','work_board','work_date'];

public $work_id;
public $work_school_name;
public $work_principal_name;
public $work_address;
public $work_country;
public $work_state;
public $work_city;
public $work_email;
public $work_mobile;
public $work_firstname;
public $work_designation;
public $work_landline;
public $work_zip;
public $work_board;
public $work_date;
 


   
    public function __construct($args = [])
    {
          $this->work_school_name = $args['work_school_name'] ?? '';
          $this->work_principal_name = $args['work_principal_name'] ?? '';
          $this->work_address = $args['work_address'] ?? '';
          $this->work_country = $args['work_country'] ?? '';
          $this->work_state = $args['work_state'] ?? '';
          $this->work_city = $args['work_city'] ?? '';
          $this->work_email = $args['work_email'] ?? '';
          $this->work_mobile = $args['work_mobile'] ?? '';
          $this->work_firstname = $args['work_firstname'] ?? '';
          $this->work_designation = $args['work_designation'] ?? '';
          $this->work_landline = $args['work_landline'] ?? '';
          $this->work_zip = $args['work_zip'] ?? '';
          $this->work_board = $args['work_board'] ?? '';
          $this->work_date = $args['work_date'] ?? '';
          
            
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