<?php

class BookMagazine extends DatabaseObject {

  static protected $table_name = "books_magazine";
  static protected $db_columns = ['magazine_id','magazine_title','magazine_image','magazine_pdf','magazine_status','magazine_as_new','magazine_sort_order'];

  public $magazine_id;
  public $magazine_title;
  public $magazine_pdf;
  public $magazine_status;
  public $magazine_as_new;
  public $magazine_sort_order;
  public $magazine_image;
  public $tmp_path;
  public $tmp_path2;
  public $upload_directory = "images/magazine_images";
  public $pdf_directory = "images/magazine_images";
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
      $this->magazine_image = $args['magazine_image'] ?? '';
      $this->magazine_title = $args['magazine_title'] ?? '';
      $this->magazine_pdf = $args['magazine_pdf'] ?? '';
      $this->magazine_status = $args['magazine_status'] ?? '';
      $this->magazine_sort_order = $args['magazine_sort_order'] ?? '';
      $this->magazine_as_new = $args['magazine_as_new'] ?? '';
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
          $this->magazine_image = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path = $file['tmp_name'];
      }
  }

  public function set_pdf($file)

  {
      $fileinfo = @getimagesize($file['tmp_name']);

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
          $this->magazine_pdf = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path2 = $file['tmp_name'];
      }
  }


  public function picture_path()

  {

      return $this->upload_directory . DS . $this->magazine_image;
  }
  
    public function pdf_path()

  {

      return $this->pdf_directory . DS . $this->magazine_pdf;
  }

  public function save_photo($custom_id)

  {

      if ($this->magazine_id) {
          $target_path =$this->upload_directory . DS . $this->magazine_image;

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

          if (empty($this->magazine_image) || empty($this->tmp_path)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_directory) == false) {
              mkdir($this->upload_directory, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_directory . DS . $this->magazine_image;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->magazine_image} already exists";
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

  public function save_pdf($custom_id)

  {

      if ($this->magazine_id) {
          $target_path =$this->pdf_directory . DS . $this->magazine_pdf;

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

          if (empty($this->magazine_pdf) || empty($this->tmp_path2)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->pdf_directory) == false) {
              mkdir($this->pdf_directory, 0700); // Create directory if it does not exist
          }
          $target_path =$this->pdf_directory . DS . $this->magazine_pdf;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->magazine_pdf} already exists";
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

  static public function find_by_order()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "where magazine_status = 'Y'"; 
      $sql .= "order by magazine_id desc";
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
      $sql .= "order by magazine_id desc";
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
  
  static public function find_by_single_banner() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
 

  public static function delete_magazine($id)
  {
      $sql = "DELETE FROM " . static::$table_name . " ";
      $sql .= "WHERE magazine_id='" . self::$database->escape_string($id) . "' ";
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