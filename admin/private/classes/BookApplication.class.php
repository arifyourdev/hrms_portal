<?php

class BookApplication extends DatabaseObject {
static protected $table_name = "books_application";
static protected $db_columns = ['applicant_id','applicant_job_id','applicant_name','applicant_email','applicant_mobile','applicant_detail','applicant_file','applicant_type','applicant_department','applicant_qualification','applicant_specialization','applicant_date_time','applicant_exp','applicant_status'];

public $applicant_id;
public $applicant_job_id;
public $applicant_name;
public $applicant_email;
public $applicant_mobile;
public $applicant_detail;
public $applicant_file;
public $applicant_type;
public $applicant_department;
public $applicant_qualification;
public $applicant_specialization;
public $applicant_date_time;
public $applicant_exp;
public $applicant_status;
public $upload_directory = "images/application";
  
    public function __construct($args = [])
    {
          $this->applicant_job_id = $args['applicant_job_id'] ?? '';
          $this->applicant_name = $args['applicant_name'] ?? '';
          $this->applicant_email = $args['applicant_email'] ?? '';
          $this->applicant_detail = $args['applicant_detail'] ?? '';
          $this->applicant_mobile = $args['applicant_mobile'] ?? '';
          $this->applicant_detail = $args['applicant_detail'] ?? '';
          $this->applicant_detail = $args['applicant_detail'] ?? '';
          $this->applicant_file = $args['applicant_file'] ?? '';
          $this->applicant_type = $args['applicant_type'] ?? '';
          $this->applicant_department = $args['applicant_department'] ?? '';
          $this->applicant_qualification = $args['applicant_qualification'] ?? '';
          $this->applicant_specialization = $args['applicant_specialization'] ?? '';
          $this->applicant_date_time = $args['applicant_date_time'] ?? '';
          $this->applicant_exp = $args['applicant_exp'] ?? '';
          $this->applicant_status = $args['applicant_status'] ?? '';
          
          
    }
      
    public function set_file($file)

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
            $this->applicant_file = date("YmdHis") . "-" . $rand . "." . $ext;
            $this->tmp_path = $file['tmp_name'];
        }
    }
  
    public function picture_path()
  
    {
  
        return $this->upload_directory . DS . $this->applicant_file;
    }
  
    public function save_photo($custom_id)
  
    {
  
        if ($this->applicant_id) {
            $target_path =$this->upload_directory . DS . $this->applicant_file;
  
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
  
            if (empty($this->applicant_file) || empty($this->tmp_path)) {
                $this->errors[] = "The File was not available";
                return false;
            }
  
            if (is_dir($this->upload_directory) == false) {
                mkdir($this->upload_directory, 0700); // Create directory if it does not exist
            }
            $target_path = $this->upload_directory . DS . $this->applicant_file;
  
            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->applicant_file} already exists";
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
  
          
    static public function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "order by applicant_id desc";
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
   
  
    public static function delete_applicant($id)
    {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE applicant_id='" . self::$database->escape_string($id) . "' ";
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