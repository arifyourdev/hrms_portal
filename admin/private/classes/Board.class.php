<?php

class Board extends DatabaseObject {
static protected $table_name = "book_board";
static protected $db_columns = ['id','board_title','board_status'];

public $id;
public $book_board;
public $board_title;
public $board_status;
 
  
   
    public function __construct($args = [])
    {
          $this->board_title = $args['board_title'] ?? '';
          $this->board_status = $args['board_status'] ?? '';
          
    }
       
  static public function find_by_order()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "order by id  asc";
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
  
  static public function find_by_seo_url($seo_url) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE board_title='" . self::$database->escape_string($seo_url) . "' ";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
 

  public static function delete_board($id)
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