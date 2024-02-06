<?php

class BookUserMaster extends DatabaseObject {
static protected $table_name = "books_user_master";
static protected $db_columns = ['user_id','user_firstname','user_lastname','user_email','user_mobile','user_password','user_type','user_status','user_date','user_verification_code','user_verification_status','user_verification_time','user_email_vcode','user_email_status','id_32','resource_data'];

public $user_id;
public $user_firstname;
public $user_lastname;
public $user_email;
public $user_mobile;
public $user_password;
public $user_type;
public $user_status;
public $user_date;
public $user_verification_code;
public $user_verification_status;
public $user_verification_time;
public $user_email_vcode;
public $user_email_status;
public $id_32;
public $resource_data;


   
    public function __construct($args = [])
    {
          $this->user_firstname = $args['user_firstname'] ?? '';
          $this->user_lastname = $args['user_lastname'] ?? '';
          $this->user_email = $args['user_email'] ?? '';
          $this->user_mobile = $args['user_mobile'] ?? '';
          $this->user_password = $args['user_password'] ?? '';
          $this->user_status = $args['user_status'] ?? '';
          $this->user_verification_code = $args['user_verification_code'] ?? '';
          $this->user_verification_status = $args['user_verification_status'] ?? '';
          $this->user_verification_time = $args['user_verification_time'] ?? '';
          $this->user_email_vcode = $args['user_email_vcode'] ?? '';
          $this->user_email_status = $args['user_email_status'] ?? '';
          $this->id_32 = $args['id_32'] ?? '';
          $this->resource_data = $args['resource_data'] ?? '';
            
    }
      
    public static function find_by_new_registration()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "where user_status ='N' ORDER BY user_id desc";
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
    
    public static function find_by_approved_registration()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "where user_status ='Y' ORDER BY user_id desc";
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
      
       static public function find_by_user_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .="WHERE user_id ='" . self::$database->escape_string($id) . "'";
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
    // For website
    public static function find_by_both($email_mobile)
    {
        $sql = "SELECT * FROM  " . static::$table_name . " ";
        $sql .= "WHERE user_email ='" . self::$database->escape_string($email_mobile) . "' OR user_mobile ='" . self::$database->escape_string($email_mobile) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
    
    // For Admin
  
    
    static public function find_by_user_mobile($user_mobile) {
      $sql = "SELECT * FROM  " . static::$table_name." ";
        $sql .= "WHERE user_mobile ='" . self::$database->escape_string($user_mobile) . "'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)){
            return array_shift($obj_array);
        }
        else{
            return false;
        }
    }
}
?>