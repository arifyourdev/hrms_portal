<?php

class BookUserProfile extends DatabaseObject {
static protected $table_name = "books_user_profile";
static protected $db_columns = ['profile_id','profile_user_id','profile_school_name','profile_principal_name','profile_address','profile_country','profile_state','profile_city','profile_zip','profile_school_email','profile_designation','profile_department','profile_level','profile_date','id_32','profile_country_temp'];

public $profile_id;
public $profile_user_id;
public $profile_school_name;
public $profile_principal_name;
public $profile_address;
public $profile_country;
public $profile_state;
public $profile_city;
public $profile_zip;
public $profile_school_email;
public $profile_designation;
public $profile_department;
public $profile_level;
public $profile_date;
public $id_32;
public $profile_country_temp;


   
    public function __construct($args = [])
    {
          $this->profile_user_id = $args['profile_user_id'] ?? '';
          $this->profile_school_name = $args['profile_school_name'] ?? '';
          $this->profile_principal_name = $args['profile_principal_name'] ?? '';
          $this->profile_address = $args['profile_address'] ?? '';
          $this->profile_country = $args['profile_country'] ?? '';
          $this->profile_state = $args['profile_state'] ?? '';
          $this->profile_city = $args['profile_city'] ?? '';
          $this->profile_zip = $args['profile_zip'] ?? '';
          $this->profile_school_email = $args['profile_school_email'] ?? '';
          $this->profile_designation = $args['profile_designation'] ?? '';
          $this->profile_department = $args['profile_department'] ?? '';
          $this->profile_level = $args['profile_level'] ?? '';
          $this->profile_date = $args['profile_date'] ?? '';
          $this->id_32 = $args['id_32'] ?? '';
          $this->profile_country_temp = $args['profile_country_temp'] ?? '';
            
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
      
      
      static public function find_by_profile_user_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .="WHERE profile_user_id ='" . self::$database->escape_string($id) . "'";
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