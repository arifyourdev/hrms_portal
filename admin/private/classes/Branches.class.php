<?php

class Branches extends DatabaseObject {
static protected $table_name = "madhubun_branches";
static protected $db_columns = ['branch_id','email','city_name','address','landline','fax','url','status','mobile'];

public $branch_id;
public $email;
public $city_name;
public $address;
public $landline;
public $fax;
public $url;
public $mobile;
public $status;
   
    public function __construct($args = [])
    {
          $this->city_name = $args['city_name'] ?? '';
          $this->address = $args['address'] ?? '';
          $this->landline = $args['landline'] ?? '';
          $this->email = $args['email'] ?? ''; 
          $this->fax = $args['fax'] ?? ''; 
          $this->url = $args['url'] ?? ''; 
          $this->mobile = $args['mobile'] ?? '';  
          $this->status = $args['status'] ?? '';
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "where status ='Y'";
        $sql .= "ORDER BY branch_id desc";
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
        $sql .= "ORDER BY branch_id desc";
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

    static public function find_by_branch_id() {
        $sql = "SELECT * FROM " . static::$table_name . " ";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
      
      static public function find_by_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE branch_id ='" . self::$database->escape_string($id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
  
    public static function delete_branch($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE branch_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>