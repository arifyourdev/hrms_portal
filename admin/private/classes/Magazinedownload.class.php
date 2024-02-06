<?php

class Magazinedownload extends DatabaseObject {
static protected $table_name = "magazine_download_log";
static protected $db_columns = ['log_id','log_magazine_id','log_user_id','log_datetime'];

public $log_id;
public $log_magazine_id;
public $log_user_id;
public $log_datetime;
   
    public function __construct($args = [])
    {
          $this->log_magazine_id = $args['log_magazine_id'] ?? '';
          $this->log_user_id = $args['log_user_id'] ?? '';
          $this->log_datetime = $args['log_datetime'] ?? '';
             
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