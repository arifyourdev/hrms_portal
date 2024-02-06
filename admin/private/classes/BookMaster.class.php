<?php

class BookMaster extends DatabaseObject {

  static protected $table_name = "books_master";
  static protected $db_columns = ['book_id','book_title','book_detail','salient_features','book_author','book_image','book_brochure','book_isbn','book_price','book_class','book_series','book_subject','book_board','book_type','book_supporting_material','book_status','book_amazon_url','book_bestseller','book_reading_club','book_lavel','book_digital_content','book_as_new','book_new_release','book_pdf_1','book_pdf_2','book_pdf_3','book_as_resource','book_as_support','book_flipbook_link','book_as_ebook','book_amazon_link','book_google_link','book_kopykitab_link','sample_pdf'];

  public $book_id;
  public $book_title;
  public $book_author;
  public $book_image;
  public $book_brochure;
  public $book_isbn;
  public $book_price;
  public $book_detail;
  public $salient_features;
  public $book_class;
  public $book_series;
  public $book_subject;
  public $book_board;
  public $book_type;
  public $book_supporting_material;
  public $book_status;
  public $book_amazon_url;
  public $book_bestseller;
  public $book_reading_club;
  public $book_lavel;
  public $book_digital_content;
  public $book_as_new;
  public $book_new_release;
  public $book_pdf_1;
  public $book_pdf_2;
  public $book_pdf_3;
  public $book_as_resource;
  public $book_as_support;
  public $book_flipbook_link;
  public $book_as_ebook;
  public $book_amazon_link;
  public $book_google_link;
  public $book_kopykitab_link;
  public $sample_pdf;
  public $tmp_path;
  public $tmp_path2;
  public $tmp_path3;
  public $tmp_path4;
  public $tmp_path5;
  public $upload_directory = "images/bookmaster";
  public $upload_pdf = "images/book_sample_pdf";
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
      $this->book_detail = $args['book_detail'] ?? '';
      $this->salient_features = $args['salient_features'] ?? '';
      $this->book_title = $args['book_title'] ?? '';
      $this->book_author = $args['book_author'] ?? '';
      $this->book_image = $args['book_image'] ?? '';
      $this->book_isbn = $args['book_isbn'] ?? '';
      $this->book_brochure = $args['book_brochure'] ?? '';
      $this->book_price = $args['book_price'] ?? '';
      $this->book_class  = $args['book_class'] ?? '';
      $this->book_subject = $args['book_subject'] ?? '';
      $this->book_board = $args['book_board'] ?? '';
      $this->book_series  = $args['book_series'] ?? '';
      $this->book_type = $args['book_type'] ?? '';
      $this->book_supporting_material = $args['book_supporting_material'] ?? '';
      $this->book_status = $args['book_status'] ?? '';
      $this->book_amazon_url = $args['book_amazon_url'] ?? '';
      $this->book_bestseller = $args['book_bestseller'] ?? '';
      $this->book_reading_club = $args['book_reading_club'] ?? '';
      $this->book_lavel = $args['book_lavel'] ?? '';
      $this->book_digital_content = $args['book_digital_content'] ?? '';
      $this->book_as_new = $args['book_as_new'] ?? '';
      $this->book_new_release = $args['book_new_release'] ?? '';
      $this->book_pdf_1 = $args['book_pdf_1'] ?? '';
      $this->book_pdf_2 = $args['book_pdf_2'] ?? '';
      $this->book_pdf_3 = $args['book_pdf_3'] ?? '';
      $this->book_as_resource = $args['book_as_resource'] ?? '';
      $this->book_as_support = $args['book_as_support'] ?? '';
      $this->book_flipbook_link = $args['book_flipbook_link'] ?? '';
      $this->book_as_ebook = $args['book_as_ebook'] ?? '';
      $this->book_amazon_link = $args['book_amazon_link'] ?? '';
      $this->book_google_link = $args['book_google_link'] ?? '';
      $this->book_kopykitab_link = $args['book_kopykitab_link'] ?? '';
      $this->sample_pdf = $args['sample_pdf'] ?? '';
      
   }

  public function set_file($file)

  {
      $fileinfo = @getimagesize($file['tmp_name']);
      $width = $fileinfo[0];
      $height = $fileinfo[1];
      $allowed_image_extension = array('png', 'jpg','svg','jpeg');
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
          $this->book_image = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path = $file['tmp_name'];
      }
  }
  
   public function set_pdf($file)

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
          $this->sample_pdf = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path2 = $file['tmp_name'];
      }
  }
  
    public function set_w_pdf($file)

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
          $this->book_pdf_1 = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path3 = $file['tmp_name'];
      }
  }
  
   public function set_w_pdf2($file)

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
          $this->book_pdf_2 = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path4 = $file['tmp_name'];
      }
  }
    public function set_w_pdf3($file)

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
          $this->book_pdf_3 = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path5 = $file['tmp_name'];
      }
  }
  
  public function picture_path()

  {

      return $this->upload_directory . DS . $this->book_image;
  }
  
   public function picture_pdf()

  {

    return $this->upload_pdf . DS . $this->sample_pdf;
  }
  
   public function picture_w_pdf()

  {

      return $this->upload_pdf . DS . $this->book_pdf_1;
  }
  
   public function picture_w_pdf2()

  {

      return $this->upload_pdf . DS . $this->book_pdf_2;
  }
   public function picture_w_pdf3()

  {

      return $this->upload_pdf . DS . $this->book_pdf_3;
  }

  public function save_photo($custom_id)

  {

      if ($this->book_id) {
          $target_path =$this->upload_directory . DS . $this->book_image;

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

          if (empty($this->book_image) || empty($this->tmp_path)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_directory) == false) {
              mkdir($this->upload_directory, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_directory . DS . $this->book_image;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->book_image} already exists";
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
  
    

    public function save_sample_pdf($custom_id)

  {

      if ($this->book_id) {
          $target_path =$this->upload_pdf . DS . $this->sample_pdf;

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

          if (empty($this->sample_pdf) || empty($this->tmp_path2)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_pdf) == false) {
              mkdir($this->upload_pdf, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_pdf . DS . $this->sample_pdf;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->series_image} already exists";
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
  
   public function save_w_pdf($custom_id)

  {

      if ($this->book_id) {
          $target_path =$this->upload_pdf . DS . $this->book_pdf_1;

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

          if (empty($this->book_pdf_1) || empty($this->tmp_path3)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_pdf) == false) {
              mkdir($this->upload_pdf, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_pdf . DS . $this->book_pdf_1;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->series_image} already exists";
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
  
   public function save_w_pdf2($custom_id)

  {

      if ($this->book_id) {
          $target_path =$this->upload_pdf . DS . $this->book_pdf_2;

          if (move_uploaded_file($this->tmp_path4, $target_path)) {
              if ($this->update($custom_id)) {
                 
                  unset($this->tmp_path4);
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

          if (empty($this->book_pdf_2) || empty($this->tmp_path4)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_pdf) == false) {
              mkdir($this->upload_pdf, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_pdf . DS . $this->book_pdf_2;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->series_image} already exists";
              return false;
          }

          if (move_uploaded_file($this->tmp_path4, $target_path)) {
              if ($this->create($custom_id)) {
                  unset($this->tmp_path4);
                  return true;
              } else {
                  $this->errors[] = "The file directory probably does not have permission";
                  return false;
              }
          }
      }
  }
  
   public function save_w_pdf3($custom_id)

  {

      if ($this->book_id) {
          $target_path =$this->upload_pdf . DS . $this->book_pdf_3;

          if (move_uploaded_file($this->tmp_path5, $target_path)) {
              if ($this->update($custom_id)) {
                 
                  unset($this->tmp_path5);
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

          if (empty($this->book_pdf_3) || empty($this->tmp_path5)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_pdf) == false) {
              mkdir($this->upload_pdf, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_pdf . DS . $this->book_pdf_3;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->series_image} already exists";
              return false;
          }

          if (move_uploaded_file($this->tmp_path5, $target_path)) {
              if ($this->create($custom_id)) {
                  unset($this->tmp_path5);
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
      $sql .= "order by book_id asc";
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
  
   
  
   static public function find_by_book_as_new()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "Where book_new_release ='1' limit 15";
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
  
  static public function find_by_book_class($series_author)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE book_series = '$series_author'";
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
  
static public function find_by_book_class_order($series_author)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE book_series = '$series_author'";
      $sql .= "order by book_class asc";
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
  
    static public function find_unique_subject_by_ebook()
  {
      $sql = "SELECT DISTINCT book_subject FROM " . self::$table_name . " ";
      $sql .= "WHERE book_as_ebook  = '1'";
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
  
  
  
   static public function find_by_ebook_subject($subject_id)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE book_as_ebook ='1' AND book_subject='$subject_id' and book_status='Y'";
      $sql .= "order by book_subject "; 
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
  
   static public function find_by_ebook_subject_board($subject_id,$board)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE book_as_ebook ='1' AND book_subject='$subject_id' AND book_board='$board' and book_status='Y'";
      $sql .= "order by book_subject "; 
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
  
  static public function find_book_by_class($series,$class)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE book_series = '" . self::$database->escape_string($series) . "' and book_class  = '" . self::$database->escape_string($class) . "' and book_status='Y'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
  }
  

  static public function find_book_by_class_new($series,$class)
  {  $sql = "SELECT * FROM " . self::$table_name . " ";
    $sql .= "WHERE book_series = '" . self::$database->escape_string($series) . "' and book_class  = '" . self::$database->escape_string($class) . "' and book_status='Y'";
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


   static public function find_book_by_board($series,$board)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE book_series = '" . self::$database->escape_string($series) . "' and book_board  = '" . self::$database->escape_string($board) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
  }
  
     static public function check_for_resources($series,$board)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE book_series = '" . self::$database->escape_string($series) . "' and book_class  = '" . self::$database->escape_string($board) . "' and book_as_resource ='1'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
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
 
  public static function subject_name($book_subject){
      $subject = BookSubject::find_by_custom_id('subject_id',$book_subject);
       return $subject->subject_title;
 }
  public static function series_name($book_series){
      $series = BookSeries::find_by_custom_id('series_id',$book_series);
      return $series->series_title;
 }
 
 public static function class_name($book_class){
      $class = BookClass::find_by_custom_id('class_id',$book_class);
      return $class->class_title;
 }
 
    static public function find_by_book_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .="WHERE book_id ='" . self::$database->escape_string($id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
      
          static public function find_by_series_book_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .="WHERE book_id ='" . self::$database->escape_string($id) . "' group by book_series";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
       
      
       static public function find_by_ebook($ebook) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .="WHERE book_as_ebook ='1'" . self::$database->escape_string($ebook) . "'";
     $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
      
    static public function find_by_user_id($id) 
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .="WHERE request_user_id ='" . self::$database->escape_string($id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
    }
      
    public static function find_by_subject_series_class($subject,$series,$class) 
    {
        $sql = "SELECT book_id FROM " . static::$table_name . " ";
        $sql .="WHERE book_subject ='" . self::$database->escape_string($subject) . "' and book_series ='" . self::$database->escape_string($series) . "' and book_class ='" . self::$database->escape_string($class) . "' and book_status='Y'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
    }

    public static function delete_book($id)
    {
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE book_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }
}
?>