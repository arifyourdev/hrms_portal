<?php

class BookCms extends DatabaseObject {

  static protected $table_name = "books_cms";
  static protected $db_columns = ['cms_id','cms_title','cms_detail','cms_image','cms_filename','cms_status'];

  public $cms_id;
  public $cms_title;
  public $cms_detail;
  public $cms_image;
  public $cms_filename;
  public $cms_status;
  public $upload_directory = "images/Cms";
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
      $this->cms_image = $args['cms_image'] ?? '';
      $this->cms_title = $args['cms_title'] ?? '';
      $this->cms_detail = $args['cms_detail'] ?? '';
      $this->album_image = $args['album_image'] ?? '';
      $this->cms_filename = $args['cms_filename'] ?? '';
      $this->cms_status = $args['cms_status'] ?? '';
   }

  public function set_file($file)

  {
      $fileinfo = @getimagesize($file['tmp_name']);
      $width = $fileinfo[0];
      $height = $fileinfo[1];
      $allowed_image_extension = array('png', 'jpg');
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
          $this->cms_image = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path = $file['tmp_name'];
      }
  }

  public function picture_path()

  {

      return $this->upload_directory . DS . $this->cms_image;
  }

  public function save_photo($custom_id)

  {

      if ($this->cms_id) {
          $target_path =$this->upload_directory . DS . $this->cms_image;

          if (compress_image($this->tmp_path, $target_path, 55)) {
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

          if (empty($this->cms_image) || empty($this->tmp_path)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_directory) == false) {
              mkdir($this->upload_directory, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_directory . DS . $this->cms_image;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->album_image} already exists";
              return false;
          }

          if (compress_image($this->tmp_path, $target_path, 55)) {
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

        
  static public function find_by_order()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "where cms_status ='Y'";
      $sql .= "order by cms_id asc";
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
  
   static public function find_by_all()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "order by cms_id asc";
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

 
  static public function find_by_about() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='10'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  
  static public function find_by_caution_notice() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='20'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
   static public function find_by_privacy() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='13'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
 
  static public function find_by_how_to_order() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='15'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  } 
  
   static public function find_by_legacy() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='38'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  static public function find_by_vision() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='40'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  static public function find_by_warranty() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='19'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  static public function find_by_author() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='41'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
    static public function find_by_leadership() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='39'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  static public function find_by_condition() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "where cms_id ='12'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  static public function find_by_single_cms() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
 
 
  
  public static function delete_cms($id)
  {
      $sql = "DELETE FROM " . static::$table_name . " ";
      $sql .= "WHERE cms_id='" . self::$database->escape_string($id) . "' ";
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