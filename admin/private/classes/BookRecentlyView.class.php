<?php

class BookRecentlyView extends DatabaseObject {
static protected $table_name = "books_recently_viewed";
static protected $db_columns = ['rv_id','rv_user_id','rv_json_data'];

public $rv_id;
public $rv_user_id;
public $rv_json_data;
  
    public function __construct($args = [])
    {
          $this->rv_user_id = $args['rv_user_id'] ?? '';
          $this->rv_json_data = $args['fav_book_id'] ?? '';
            
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