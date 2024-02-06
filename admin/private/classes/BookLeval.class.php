<?php

class BookLeval extends DatabaseObject {
static protected $table_name = "books_lavel";
static protected $db_columns = ['lavel_id','lavel_title','lavel_status','lavel_sort_order'];

public $lavel_id;
public $lavel_title;
public $lavel_status;
public $lavel_sort_order;
   
    public function __construct($args = [])
    {
          $this->lavel_title = $args['lavel_title'] ?? '';
          $this->lavel_status = $args['lavel_status'] ?? '';
          $this->lavel_sort_order = $args['lavel_sort_order'] ?? '';
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "where lavel_status = 'Y'";
        $sql .= "ORDER BY lavel_id desc";
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
    
    public static function find_by_all()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY lavel_id desc";
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
     static public function find_by_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE lavel_id ='" . self::$database->escape_string($id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
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
  
    public static function delete_level($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE lavel_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>