<?php

class Specimancopyrequest extends DatabaseObject {
static protected $table_name = "speciman_copy_request";
static protected $db_columns = ['request_id','request_by','request_name','request_school_name','request_email','request_mobile','request_msg','request_for_id','request_for_type','request_date_time','request_class','request_quantity','year_status'];

public $request_id;
public $request_by;
public $request_name;
public $request_school_name;
public $request_email;
public $request_mobile;
public $request_for_id;
public $request_msg;
public $request_for_type;
public $request_date_time;
public $request_class;
public $request_quantity;
public $year_status;
   
    public function __construct($args = [])
    {
          $this->request_by = $args['request_by'] ?? '';
          $this->request_name = $args['request_name'] ?? '';
          $this->request_school_name = $args['request_school_name'] ?? ''; 
          $this->request_email = $args['request_email'] ?? '';
          $this->request_mobile = $args['request_mobile'] ?? '';
          $this->request_for_id = $args['request_for_id'] ?? '';
          $this->request_msg = $args['request_msg'] ?? '';
          $this->request_for_type = $args['request_for_type'] ?? '';
          $this->request_date_time = $args['request_date_time'] ?? '';
          $this->request_class = $args['request_class'] ?? '';
          $this->request_quantity = $args['request_quantity'] ?? '';
          $this->year_status = $args['year_status'] ?? '';
           
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY request_id desc";
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
   public static function delete_specimen($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE request_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }    
}
?>