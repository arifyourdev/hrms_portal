<?php

class BookSeries extends DatabaseObject {

  static protected $table_name = "books_series";
  static protected $db_columns = ['series_id','series_title','series_subject','series_image','series_author','series_detail','series_brochure','series_speciman','series_about_author','series_about_series','series_salient_feature','series_is_supporting_material','series_supporting_material',
  'series_status','series_amazon_url','series_type','series_bestseller','series_lavel','series_digital_content','series_as_new','series_as_resource','series_sort_order','book_as_ebook','book_amazon_link','book_google_link','book_kopykitab_link','series_ebook_detail','sample_pdf','series_board'];

  public $series_id;
  public $series_title;
  public $series_subject;
  public $series_image;
  public $series_author;
  public $series_detail;
  public $series_brochure;
  public $series_speciman;
  public $series_about_author;
  public $series_about_series;
  public $series_salient_feature;
  public $series_is_supporting_material;
  public $series_supporting_material;
  public $series_status;
  public $series_amazon_url;
  public $series_type;
  public $series_bestseller;
  public $series_lavel;
  public $series_digital_content;
  public $series_as_new;
  public $series_as_resource;
  public $series_sort_order;
  public $book_amazon_link;
  public $book_as_ebook;
  public $book_google_link;
  public $book_kopykitab_link;
  public $series_ebook_detail;
  public $series_board;
  public $tmp_path;
  public $tmp_path2;
  public $tmp_path3;
  public $upload_directory = "images/series_images";
  public $upload_pdf = "images/sample_pdf";
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
      $this->series_title = $args['series_title'] ?? '';
      $this->series_subject = $args['series_subject'] ?? '';
      $this->series_image = $args['series_image'] ?? '';
      $this->series_detail = $args['series_detail'] ?? '';
      $this->series_author = $args['series_author'] ?? '';
      $this->series_brochure  = $args['series_brochure '] ?? '';
      $this->series_speciman = $args['series_speciman'] ?? '';
      $this->book_series  = $args['book_series '] ?? '';
      $this->series_about_author = $args['series_about_author'] ?? '';
      $this->series_about_series= $args['series_about_series'] ?? '';
      $this->series_salient_feature = $args['series_salient_feature'] ?? '';
      $this->series_is_supporting_material = $args['series_is_supporting_material'] ?? '';
      $this->series_supporting_material = $args['series_supporting_material'] ?? '';
      $this->series_status = $args['series_status'] ?? '';
      $this->series_amazon_url = $args['series_amazon_url'] ?? '';
      $this->series_type = $args['series_type'] ?? '';
      $this->series_bestseller = $args['series_bestseller'] ?? '';
      $this->series_lavel = $args['series_lavel'] ?? '';
      $this->series_digital_content = $args['series_digital_content'] ?? '';
      $this->series_as_new = $args['series_as_new'] ?? '';
      $this->series_as_resource = $args['series_as_resource'] ?? '';
      $this->series_sort_order = $args['series_sort_order'] ?? '';
      $this->book_amazon_link = $args['book_amazon_link'] ?? '';
      $this->book_as_ebook = $args['book_as_ebook'] ?? '';
      $this->book_google_link = $args['book_google_link'] ?? '';
      $this->book_kopykitab_link = $args['book_kopykitab_link'] ?? '';
      $this->series_ebook_detail = $args['series_ebook_detail'] ?? '';
      $this->sample_pdf = $args['sample_pdf'] ?? '';
      $this->series_board = $args['series_board'] ?? '';
   }

  public function set_file($file)
  {
      $fileinfo = @getimagesize($file['tmp_name']);
      $width = $fileinfo[0];
      $height = $fileinfo[1];
      $allowed_image_extension = array('png', 'jpg','jpeg');
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
          $this->series_image = date("YmdHis") . "-" . $rand . "." . $ext;
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
   public function set_b_pdf($file)

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
          $this->series_brochure = date("YmdHis") . "-" . $rand . "." . $ext;
          $this->tmp_path3 = $file['tmp_name'];
      }
  }  
  

  public function picture_path()

  {

      return $this->upload_directory . DS . $this->series_image;
  }
   
    public function picture_pdf()

  {

    return $this->upload_pdf . DS . $this->sample_pdf;
  }
  
    public function picture_b_pdf()

  {

    return $this->upload_pdf . DS . $this->series_brochure;
  }
   

  public function save_photo($custom_id)

  {

      if ($this->series_id) {
          $target_path =$this->upload_directory . DS . $this->series_image;

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

          if (empty($this->series_image) || empty($this->tmp_path)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_directory) == false) {
              mkdir($this->upload_directory, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_directory . DS . $this->series_image;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->series_image} already exists";
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

      if ($this->series_id) {
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
  
    public function save_b_pdf($custom_id)

  {

      if ($this->series_id) {
          $target_path =$this->upload_pdf . DS . $this->series_brochure;

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

          if (empty($this->series_brochure) || empty($this->tmp_path3)) {
              $this->errors[] = "The File was not available";
              return false;
          }

          if (is_dir($this->upload_pdf) == false) {
              mkdir($this->upload_pdf, 0700); // Create directory if it does not exist
          }
          $target_path =$this->upload_pdf . DS . $this->series_brochure;

          if (file_exists($target_path)) {
              $this->errors[] = "The file {$this->series_brochure} already exists";
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
  
    
     
  static public function find_by_bestseller()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE series_bestseller ='Y'";
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
      $sql .= "order by series_id desc";
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
  
    static public function find_by_status()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE series_status='Y' order by series_id desc";
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
  
  static public function find_by_series_author($series_author)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE series_subject = '$series_author' AND series_as_resource = '1'";
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

  static public function find_by_series_as_new()
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "Where series_as_new ='1' limit 15";
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
 
  
  public static function subject_name($book_subject){
      $subject = BookSubject::find_by_custom_id('subject_id',$book_subject);
       return $subject->subject_title;
 }
  public static function series_name($book_series){
      $series = BookSeries::find_by_custom_id('series_id',$book_series);
      return $series->series_title;
 }
  public static function delete_series($id)
  {
      $sql = "DELETE FROM " . static::$table_name . " ";
      $sql .= "WHERE series_id='" . self::$database->escape_string($id) . "' ";
      $result = self::$database->query($sql);
      return $result;

      // After deleting, the instance of the object will still
      // exist, even though the database record does not.
      // This can be useful, as in:
      //   echo $user->first_name . " was deleted.";
      // but, for example, we can't call $user->update() after
  }

 static public function find_by_series_subject($series_subject)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE series_subject = '$series_subject' and series_status='Y' Order by series_as_new desc , series_id desc";
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
  
  static public function find_by_series_board($series_board)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE series_board = '$series_board'";
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
  
  static public function find_by_series_subject_board($series_subject,$board)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE series_subject = '$series_subject' AND series_board IN('$board') Order by series_as_new desc ,series_title desc";
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
  
  static public function find_by_series_subject_board_multiple($series_subject,$board)
  {
      $m_count = COUNT($board);
      $c='1';
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE series_subject = '$series_subject' AND series_status='Y' AND";
      
      foreach($board as $board_filter)
      {
          if($c<$m_count)
          {
              $sql .= "series_board='$board_filter' OR ";
          }
          else
          {
              $sql .= "series_board='$board_filter'";
          }
          
          $c++;
      }
      
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
  
  static public function find_by_eseries_subject($subject_id)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE book_as_ebook ='1' AND series_subject='$subject_id'";
      $sql .= "order by series_subject "; 
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
  
   static public function find_by_list_subject($subject_id)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE series_subject='$subject_id'";
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
  
   public static function find_by_series_id($series_id)
  {
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE series_id ='" . self::$database->escape_string($series_id) . "'";
      $obj_array = static::find_by_sql($sql);
      if (!empty($obj_array)) {
          return array_shift($obj_array);
      } else {
          return false;
      }
  }

}

?>