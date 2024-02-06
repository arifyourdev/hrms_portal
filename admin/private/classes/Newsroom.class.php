<?php

class Newsroom extends DatabaseObject {
static protected $table_name = "newsroom";
static protected $db_columns = ['id','title','category','status'];

public $id;
public $title;
public $category;
public $status;
 
   
    public function __construct($args = [])
    {
          $this->title = $args['title'] ?? '';
          $this->category = $args['category'] ?? '';
          $this->status = $args['status'] ?? '';
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "where status = 'Y'"; 
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
    
     public static function find_by_all()
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
    
     static public function find_by_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE id ='" . self::$database->escape_string($id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
       
         static public function find_by_category($cat) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE category='" . self::$database->escape_string($cat) . "' ";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

      public static function find_by_page($per_page,$pagination)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "order by title asc limit $per_page OFFSET {$pagination->offset()}";
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
  
    public static function delete_newsroom($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>