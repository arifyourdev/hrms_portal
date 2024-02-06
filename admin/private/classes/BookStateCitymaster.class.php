<?php

class BookStateCitymaster extends DatabaseObject {
static protected $table_name = "books_state_city_master";
static protected $db_columns = ['zsc_id','zsc_name','zsc_code','zsc_parent_id','zsc_status'];

public $zsc_id;
public $zsc_name;
public $zsc_code;
public $zsc_parent_id;
public $zsc_status;
   
    public function __construct($args = [])
    {
          $this->zsc_name = $args['zsc_name'] ?? '';
          $this->zsc_code = $args['zsc_code'] ?? '';
          $this->zsc_parent_id = $args['zsc_parent_id'] ?? '';
          $this->zsc_status = $args['zsc_status'] ?? '';
            
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