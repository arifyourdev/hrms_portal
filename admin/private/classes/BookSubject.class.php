<?php
    class BookSubject extends DatabaseObject {
    static protected $table_name = "books_subject";
    static protected $db_columns = ['subject_id','subject_title','subject_filename','subject_status','subject_on_homepage','subject_sort_order'];
    
    public $subject_id;
    public $subject_title;
    public $subject_filename;
    public $subject_status;
    public $subject_on_homepage;
    public $subject_sort_order;
   
    public function __construct($args = [])
    {
        $this->subject_title = $args['subject_title'] ?? '';
        $this->subject_filename = $args['subject_filename'] ?? '';
        $this->subject_status = $args['subject_status'] ?? '';
        $this->subject_on_homepage = $args['subject_on_homepage'] ?? '';
        $this->subject_sort_order = $args['subject_sort_order'] ?? '';
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "where subject_status ='Y'";
        $sql .= "ORDER BY subject_filename asc";
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
        $sql .= "ORDER BY subject_id desc";
        $result = self::$database->query($sql);
        if (!$result) {
            exit("Database query failed");
        }

        // results into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }
    
     public static function find_by_sort_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY subject_sort_order asc";
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

    static public function find_by_subject_filename($sub_file) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE subject_filename ='" . self::$database->escape_string($sub_file) . "' ";
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
     public static function update_seo_url($url, $id)
    {

        $sql = "UPDATE " . static::$table_name . " ";
        $sql .= "SET subject_filename='" . self::$database->escape_string($url) . "'";
        $sql .= "WHERE subject_id='" . self::$database->escape_string($id) . "'";
        $result_set = self::$database->query($sql);
        return $result_set;
    }
  
    public static function delete_subject($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE subject_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    } 
    
     public static function find_by_subject_id($sub_id)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE subject_id ='" . self::$database->escape_string($sub_id) . "'";
      $obj_array = static::find_by_sql($sql);
      if (!empty($obj_array)) {
          return array_shift($obj_array);
      } else {
          return false;
      }
  }
   
}
?>