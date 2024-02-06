<?php

class BookSeriesClass extends DatabaseObject {
static protected $table_name = "books_series_class";
static protected $db_columns = ['sc_id','sc_series_id','sc_class_id','sc_status'];

public $sc_id;
public $sc_series_id;
public $sc_class_id;
public $sc_status;
   
    public function __construct($args = [])
    {
          $this->sc_series_id = $args['sc_series_id'] ?? '';
          $this->sc_class_id = $args['sc_class_id'] ?? '';
          $this->sc_status = $args['sc_status'] ?? '';
            
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
      
          static public function check_series_class($fav_user,$class_id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE sc_series_id = '$fav_user' and sc_class_id ='$class_id'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
      
      
      static public function find_by_series_class($fav_user)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE sc_series_id = '$fav_user' ORDER BY sc_class_id =16 desc,sc_class_id asc";
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
  
    public static function delete_class($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE sc_series_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>