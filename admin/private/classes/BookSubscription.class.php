<?php

class BookSubscription extends DatabaseObject {
static protected $table_name = "books_subscribe";
static protected $db_columns = ['nl_id','nl_email','nl_name','nl_mobile','nl_status','nl_date'];

public $nl_id;
public $nl_email;
public $nl_name;
public $nl_mobile;
public $nl_status;
public $nl_date;
   
    public function __construct($args = [])
    {
          $this->nl_email = $args['nl_email'] ?? '';
          $this->nl_name = $args['nl_name'] ?? '';
          $this->nl_mobile = $args['nl_mobile'] ?? '';
          $this->nl_status = $args['nl_status'] ?? '';
          $this->nl_date = $args['nl_date'] ?? '';
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY nl_id desc";
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
        $sql .="WHERE nl_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>