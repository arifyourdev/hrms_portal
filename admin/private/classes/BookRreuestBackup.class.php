<?php

class BookRrequestBackup extends DatabaseObject {
static protected $table_name = "books_r_request backup 30.7.2019";
static protected $db_columns = ['request_id','request_user_id','request_book_id','request_date','request_status'];

public $request_id;
public $request_user_id;
public $request_book_id;
public $request_date;
public $request_status;
   
    public function __construct($args = [])
    {
          $this->request_user_id = $args['request_user_id'] ?? '';
          $this->request_book_id = $args['request_book_id'] ?? '';
          $this->request_date = $args['request_date'] ?? '';
          $this->request_status = $args['request_status'] ?? '';
            
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