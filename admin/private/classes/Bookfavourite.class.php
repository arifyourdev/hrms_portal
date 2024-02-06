<?php

class Bookfavourite extends DatabaseObject {
static protected $table_name = "books_favourite";
static protected $db_columns = ['fav_id','fav_user_id','fav_book_id','fav_date'];

public $fav_id;
public $fav_user_id;
public $fav_book_id;
public $fav_date;
   
    public function __construct($args = [])
    {
          $this->fav_user_id = $args['fav_user_id'] ?? '';
          $this->fav_book_id = $args['fav_book_id'] ?? '';
          $this->fav_date = $args['fav_date'] ?? '';
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY fav_id desc";
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
    
    static public function find_by_user_book($fav_user,$fav_book)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE fav_user_id = '$fav_user' AND fav_book_id = '$fav_book'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) 
        {
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
  
   public static function find_by_fav_user_id($fav_user_id)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE fav_user_id ='$fav_user_id'";
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
  
    public static function delete_fav($user_id,$book_id)
    {
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE fav_user_id = '$user_id' AND fav_book_id = '$book_id'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>