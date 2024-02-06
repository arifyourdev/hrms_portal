<?php

class BookJob extends DatabaseObject {
static protected $table_name = "books_jobs";
static protected $db_columns = ['jobs_id','jobs_title','jobs_detail','jobs_post_date','jobs_type','jobs_department','jobs_from_exp','jobs_to_exp','jobs_qualification','jobs_specialization','jobs_location','jobs_status'];

public $jobs_id;
public $jobs_title;
public $jobs_detail;
public $jobs_post_date;
public $jobs_type;
public $jobs_department;
public $jobs_from_exp;
public $jobs_to_exp;
public $jobs_qualification;
public $jobs_specialization;
public $jobs_location;
public $jobs_status;
   
    public function __construct($args = [])
    {
          $this->jobs_title = $args['jobs_title'] ?? '';
          $this->jobs_detail = $args['jobs_detail'] ?? '';
          $this->jobs_post_date = $args['jobs_post_date'] ?? '';
          $this->jobs_type = $args['jobs_type'] ?? '';
          $this->jobs_department = $args['jobs_department'] ?? '';
          $this->jobs_from_exp = $args['jobs_from_exp'] ?? '';
          $this->jobs_to_exp = $args['jobs_to_exp'] ?? '';
          $this->jobs_qualification = $args['jobs_qualification'] ?? '';
          $this->jobs_specialization = $args['jobs_specialization'] ?? '';
          $this->jobs_location = $args['jobs_location'] ?? '';
          $this->jobs_status = $args['jobs_status'] ?? '';
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "where jobs_status ='Y'";
        $sql .= "ORDER BY jobs_id desc";
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
        $sql .= "ORDER BY jobs_id desc";
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
  static public function find_by_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE jobs_id ='" . self::$database->escape_string($id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
  
    public static function delete_jobs($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE jobs_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>