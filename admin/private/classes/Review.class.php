<?php

class Review extends DatabaseObject {
static protected $table_name = "book_review";
static protected $db_columns = ['id','user_id','series_id','name','email','message','created_at'];

public $id;
public $user_id;
public $series_id;
public $name;
public $email;
public $message;
public $date;
  
   
    public function __construct($args = [])
    {
          $this->user_id = $args['user_id'] ?? '';
          $this->name = $args['name'] ?? '';
          $this->email = $args['email'] ?? '';
          $this->series_id = $arg['series_id'] ?? '';
          $this->message = $args['message'] ?? '';
          $this->created_at = $args['created_at'] ?? '';
    }
      
   

 

 public static function find_by_page($per_page,$pagination)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "order by name asc limit $per_page OFFSET {$pagination->offset()}";
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
        
  static public function find_by_order()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "order by id  desc";
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
  
  static public function find_by_recent_blog()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "order by id desc LIMIT 2";
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

  
  static public function find_by_seo_url($seo_url) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE seo_url='" . self::$database->escape_string($seo_url) . "' ";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
 

  public static function delete_review($id)
  {
      $sql = "DELETE FROM " . static::$table_name . " ";
      $sql .= "WHERE id='" . self::$database->escape_string($id) . "' ";
      $result = self::$database->query($sql);
      return $result;

      // After deleting, the instance of the object will still
      // exist, even though the database record does not.
      // This can be useful, as in:
      //   echo $user->first_name . " was deleted.";
      // but, for example, we can't call $user->update() after
  }



}

?>