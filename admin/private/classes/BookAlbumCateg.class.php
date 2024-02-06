<?php

class BookAlbumCateg extends DatabaseObject {
static protected $table_name = "books_album_category";
static protected $db_columns = ['id','album_category','status'];

public $id;
public $album_category;
public $status;
 
  
   
    public function __construct($args = [])
    {
          $this->album_category = $args['album_category'] ?? '';
          $this->status = $args['status'] ?? '';
          
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
 
 static public function find_by_category($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE album_category ='" . self::$database->escape_string($id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }

  public static function delete_category($id)
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