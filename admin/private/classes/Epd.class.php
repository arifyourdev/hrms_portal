<?php

class Epd extends DatabaseObject {
static protected $table_name = "epd_request";
static protected $db_columns = ['id','name','email','contact','school','city','state','message','date','status'];

public $id;
public $email;
public $name;
public $contact;
public $school;
public $city;
public $state;
public $message;
public $date;
public $status;
   
    public function __construct($args = [])
    {
          $this->name = $args['name'] ?? '';
          $this->contact = $args['contact'] ?? '';
          $this->school = $args['school'] ?? '';
          $this->email = $args['email'] ?? ''; 
          $this->city = $args['city'] ?? ''; 
          $this->state = $args['state'] ?? ''; 
          $this->message = $args['message'] ?? ''; 
          $this->date = $args['date'] ?? ''; 
          $this->status = $args['status'] ?? '';
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

    static public function find_by_epd_id() {
        $sql = "SELECT * FROM " . static::$table_name . " ";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
  
    public static function delete_epd($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>