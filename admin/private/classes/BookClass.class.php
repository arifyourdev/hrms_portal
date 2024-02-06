<?php

class BookClass extends DatabaseObject {
static protected $table_name = "books_class";
static protected $db_columns = ['class_id','class_title','class_sort_order','class_status'];

public $class_id;
public $class_title;
public $class_sort_order;
public $class_status;
   
    public function __construct($args = [])
    {
          $this->class_id = $args['class_id'] ?? '';
          $this->class_title = $args['class_title'] ?? '';
          $this->class_sort_order = $args['class_sort_order'] ?? '';
          $this->class_status = $args['class_status'] ?? '';
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "where class_status = 'Y'";
        $sql .= "ORDER BY class_id asc";
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
        $sql .= "Order by class_id=16 desc, class_id asc";
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
      
//         protected function validate() {
//     $this->errors = [];

//     // Add custom validations

//     return $this->errors;
//   }
      
//       public  function update_book($id) {
//     $this->validate();
//     if(!empty($this->errors)) { return false; }

//     $attributes = $this->sanitized_attributes();
//     $attribute_pairs = [];
//     foreach($attributes as $key => $value) {
//       $attribute_pairs[] = "{$key}='{$value}'";
//     }

//     $sql = "UPDATE " . static::$table_name . " SET ";
//     $sql .= join(', ', $attribute_pairs);
//     $sql .= " WHERE class_id='" . self::$database->escape_string($id) . "' ";
//     $sql .= "LIMIT 1";
//     $result = self::$database->query($sql);
//     return $result;
//   }
  
//     public function attributes() {
//     $attributes = [];
//     foreach(static::$db_columns as $column) {
//       if($column == 'class_id') { continue; }
//       $attributes[$column] = $this->$column;
//     }
//     return $attributes;
//   }

//   protected function sanitized_attributes() {
//     $sanitized = [];
//     foreach($this->attributes() as $key => $value) {
//       $sanitized[$key] = self::$database->escape_string($value);
//     }
//     return $sanitized;
//   }

  
        public static function find_by_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE class_id ='" . self::$database->escape_string($id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
      
         public static function find_by_sort_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY class_sort_order asc";
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
  
    public static function delete_class($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE class_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>