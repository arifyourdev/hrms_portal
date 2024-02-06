<?php

class BooksRrequest extends DatabaseObject {
static protected $table_name = "books_r_request";
static protected $db_columns = ['request_id','request_user_id','request_book_id','request_date','request_status'];

public $request_id;
public $request_user_id;
public $request_book_id;
public $request_date;
public $request_status;
   
    public function __construct($args = [])
    {
          $this->request_user_id = $args['request_user_id'] ?? '';
          $this->request_book_id = $args['request_book_id'] ?? '';
          $this->request_date = $args['request_date'] ?? '';
          $this->request_status = $args['request_status'] ?? '';
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE request_status ='N'";
        $sql .= "ORDER BY request_id desc";
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
    
    
    public static function book_find_by_user_id($request_user_id)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE request_user_id ='$request_user_id'";
        
        $result = self::$database->query($sql);
        if (!$result) {
            die(mysqli_error(self::$database));
        }

        // results into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }
    
        public static function worksheet_find_by_user_id($request_user_id)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE request_user_id ='$request_user_id' and request_status= 'Y'";
        $result = self::$database->query($sql);
        if (!$result) {
            die(mysqli_error(self::$database));
        }

        // results into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }

        public static function book_find_id($request_user_id)
    {
        $sql = "SELECT * from books_master d INNER JOIN books_r_request r ON r.request_book_id = d.book_id and r.request_user_id = '$request_user_id' LEFT JOIN books_series s on s.series_id = d.book_series GROUP BY d.book_series order by request_date DESC";
        
        $result = self::$database->query($sql);
        if (!$result) {
            die(mysqli_error(self::$database));
        }

        // results into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }

 public static function book_find_series_id($request_user_id,$series)
    {
        $sql = "SELECT * from books_master d INNER JOIN books_r_request r ON r.request_book_id = d.book_id and r.request_user_id = '$request_user_id' and d.book_series = '$series' order by request_date DESC";
        $result = self::$database->query($sql);
        if (!$result) {
            die(mysqli_error(self::$database));
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
       
    //     public static function disable_assembly($id)
    // {
    //     $sql = "UPDATE " . static::$table_name . " ";
    //     $sql .= "SET request_status='N'";
    //     $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
    //     $result_set = self::$database->query($sql);
    //     return $result_set;
    // }

    public static function approved_request($id)
    {  
        $sql = "UPDATE " . static::$table_name . " ";
        $sql .= "SET request_status='Y'";
        $sql .= "WHERE request_id='" . self::$database->escape_string($id) . "'";
        $result_set = self::$database->query($sql);
        return $result_set;
    } 
  
    public static function delete_address($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
     static public function find_by_user_id($user) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .="WHERE request_user_id ='" . self::$database->escape_string($user) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
      
       static public function find_by_book_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .="WHERE request_book_id ='" . self::$database->escape_string($id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
    
}
?>