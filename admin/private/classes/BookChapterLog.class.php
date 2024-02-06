<?php

class BookChapterLog extends DatabaseObject {

  static protected $table_name = "books_chapter_log";
  static protected $db_columns = ['clog_id','clog_book_id','clog_chapter_id','clog_worksheet_ans','clog_worksheet','clog_stepwise','clog_sort_order'];

  public $clog_id ;
  public $clog_book_id;
  public $clog_chapter_id;
  public $clog_worksheet_ans;
  public $clog_worksheet;
  public $clog_stepwise;
  public $clog_sort_order;
  public $tmp_path;
  public $tmp_path2;
  public $tmp_path3;
  public $upload_directory = "images/book_brochures";
//   public $view_directory = "admin/images/book_brochures";
  public $custom_errors = array();
  public $upload_errors_array = array(

      UPLOAD_ERR_OK => "There is no error",
      UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
      UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
      UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
      UPLOAD_ERR_NO_FILE => "No file was uploaded.",
      UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
      UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
      UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",

  );


  public function __construct($args=[]) {
      $this->clog_book_id = $args['clog_book_id'] ?? '';
      $this->clog_chapter_id = $args['clog_chapter_id'] ?? '';
      $this->clog_worksheet_ans = $args['clog_worksheet_ans'] ?? '';
      $this->clog_worksheet = $args['clog_worksheet'] ?? '';
      $this->clog_stepwise = $args['clog_stepwise'] ?? '';
      $this->clog_sort_order = $args['clog_sort_order'] ?? '';
   }
 
   public function set_worksheet($file)

  {
      $fileinfo = @getimagesize($file['tmp_name']);
    //   $width = $fileinfo[0];
    //   $height = $fileinfo[1];
      $allowed_image_extension = array('pdf');
      $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

      if (empty($file) || !$file || !is_array($file)) {
          $this->errors[] = "There was no file uploaded here";
          return false;
      } elseif (!in_array($file_extension, $allowed_image_extension)) {
          $this->errors[] = "Upload Valid image Format. Only PDF are allowed.";
          return false;
      } elseif (($file['size'] > 8000000)) {
          $this->errors[] = "Image size exceeds 8MB";
          return false;
      }
      // elseif ($width < 1900 && $height < 2560) {
      //   $this->errors[] = "Image Dimension should be within 1900 X 2560";
      //   return false;
      // }
      elseif ($file['error'] != 0) {
          $this->errors[] = $this->upload_errors_array[$file['error']];
          return false;
      } else {
          $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
          $rand = rand(1111, 9999);
          $this->clog_worksheet = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path = $file['tmp_name'];
      }
  }

  public function set_ansheet($file)

  {
      $fileinfo = @getimagesize($file['tmp_name']);
      $width = $fileinfo[0];
      $height = $fileinfo[1];
      $allowed_image_extension = array('pdf');
      $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

      if (empty($file) || !$file || !is_array($file)) {
          $this->errors[] = "There was no file uploaded here";
          return false;
      } elseif (!in_array($file_extension, $allowed_image_extension)) {
          $this->errors[] = "Upload Valid image Format. Only PNG and JPG are allowed.";
          return false;
      } elseif (($file['size'] > 8000000)) {
          $this->errors[] = "Image size exceeds 8MB";
          return false;
      }
      // elseif ($width < 1900 && $height < 2560) {
      //   $this->errors[] = "Image Dimension should be within 1900 X 2560";
      //   return false;
      // }
      elseif ($file['error'] != 0) {
          $this->errors[] = $this->upload_errors_array[$file['error']];
          return false;
      } else {
          $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
          $rand = rand(1111, 9999);
          $this->clog_worksheet_ans = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path2 = $file['tmp_name'];
      }
  }
  
   public function set_stepwise($file)

  {
      $fileinfo = @getimagesize($file['tmp_name']);
    //   $width = $fileinfo[0];
    //   $height = $fileinfo[1];
      $allowed_image_extension = array('pdf');
      $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

      if (empty($file) || !$file || !is_array($file)) {
          $this->errors[] = "There was no file uploaded here";
          return false;
      } elseif (!in_array($file_extension, $allowed_image_extension)) {
          $this->errors[] = "Upload Valid image Format. Only PDF are allowed.";
          return false;
      } elseif (($file['size'] > 8000000)) {
          $this->errors[] = "Image size exceeds 8MB";
          return false;
      }
      // elseif ($width < 1900 && $height < 2560) {
      //   $this->errors[] = "Image Dimension should be within 1900 X 2560";
      //   return false;
      // }
      elseif ($file['error'] != 0) {
          $this->errors[] = $this->upload_errors_array[$file['error']];
          return false;
      } else {
          $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
          $rand = rand(1111, 9999);
          $this->clog_stepwise = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path3 = $file['tmp_name'];
      }
  }
  

  public function picture_worksheet()

  {

      return $this->upload_directory . DS . $this->clog_worksheet;
  }
  
//     public function view_worksheet()

//   {

//       return $this->view_directory . DS . $this->clog_worksheet;
//   }
  
   public function picture_ans()

  {

      return $this->upload_directory . DS . $this->clog_worksheet_ans;
  }
  
   public function picture_stepwise()

  {

      return $this->upload_directory . DS . $this->clog_stepwise;
  }

  public function save_worksheet($custom_id)

  {

      if ($this->clog_id) {
          $target_path =$this->upload_directory . DS . $this->clog_worksheet;

          if (move_uploaded_file($this->tmp_path, $target_path)) {
              if ($this->update($custom_id)) {
                 
                  unset($this->tmp_path);
                  return true;
              } else {
                  $this->errors[] = "The file directory probably does not have permission";
                  return false;
              }
          }
      } else {

          if (!empty($this->errors)) {
              return false;
          }

          if (empty($this->clog_worksheet) || empty($this->tmp_path)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_directory) == false) {
              mkdir($this->upload_directory, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_directory . DS . $this->clog_worksheet;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->clog_worksheet} already exists";
              return false;
          }

          if (move_uploaded_file($this->tmp_path, $target_path)) {
              if ($this->create($custom_id)) {
                  unset($this->tmp_path);
                  return true;
              } else {
                  $this->errors[] = "The file directory probably does not have permission";
                  return false;
              }
          }
      }
  }
  

  public function save_ansheet($custom_id)

  {

      if ($this->clog_id) {
          $target_path =$this->upload_directory . DS . $this->clog_worksheet_ans;

          if (move_uploaded_file($this->tmp_path2, $target_path)) {
              if ($this->update($custom_id)) {
                 
                  unset($this->tmp_path2);
                  return true;
              } else {
                  $this->errors[] = "The file directory probably does not have permission";
                  return false;
              }
          }
      } else {

          if (!empty($this->errors)) {
              return false;
          }

          if (empty($this->clog_worksheet_ans) || empty($this->tmp_path2)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_directory) == false) {
              mkdir($this->upload_directory, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_directory . DS . $this->clog_worksheet_ans;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->clog_worksheet_ans} already exists";
              return false;
          }

          if (move_uploaded_file($this->tmp_path2, $target_path)) {
              if ($this->create($custom_id)) {
                  unset($this->tmp_path2);
                  return true;
              } else {
                  $this->errors[] = "The file directory probably does not have permission";
                  return false;
              }
          }
      }
  }
  
  
   public function save_stepwise($custom_id)

  {

      if ($this->clog_id) {
          $target_path =$this->upload_directory . DS . $this->clog_stepwise;

          if (move_uploaded_file($this->tmp_path3, $target_path)) {
              if ($this->update($custom_id)) {
                 
                  unset($this->tmp_path3);
                  return true;
              } else {
                  $this->errors[] = "The file directory probably does not have permission";
                  return false;
              }
          }
      } else {

          if (!empty($this->errors)) {
              return false;
          }

          if (empty($this->clog_stepwise) || empty($this->tmp_path3)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_directory) == false) {
              mkdir($this->upload_directory, 0700); // Create directory if it does not exist
          }
          $target_path = $this->upload_directory . DS . $this->clog_stepwise;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->clog_stepwise} already exists";
              return false;
          }

          if (move_uploaded_file($this->tmp_path3, $target_path)) {
              if ($this->create($custom_id)) {
                  unset($this->tmp_path3);
                  return true;
              } else {
                  $this->errors[] = "The file directory probably does not have permission";
                  return false;
              }
          }
      }
  }
  
     public static function find_by_all_chapter($all_worsheets)
    {
        $sql = "SELECT COUNT(*) FROM " . self::$table_name . " ";
         $sql .= "WHERE clog_book_id ='$all_worsheets'";
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    return array_shift($row);
    }

        
  static public function find_by_order()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "order by clog_book_id asc";
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

     static public function find_by_chapter_worksheet($gallery)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE clog_book_id= $gallery";
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
   
    public static function find_book_chapter($request_user_id)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE clog_book_id ='$request_user_id' order by clog_chapter_id asc";
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

    static public function find_by_book_id($request_user_id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE clog_book_id ='$request_user_id'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
  
    
    public static function find_book_chapter1($request_user_id)
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE clog_book_id ='$request_user_id' order by clog_book_id asc";
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
 

  public static function delete_chapter($id)
  {
      $sql = "DELETE FROM " . static::$table_name . " ";
      $sql .= "WHERE clog_id='" . self::$database->escape_string($id) . "' ";
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