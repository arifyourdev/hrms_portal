<?php

class EmailtemplateMaster extends DatabaseObject {
static protected $table_name = "email_template_master";
static protected $db_columns = ['mail_id','mail_type_id','mail_send_from','mail_to_admin','mail_subject','mail_message','message','mail_status','mail_status'];

public $mail_id;
public $mail_type_id;
public $mail_send_from;
public $mail_to_admin;
public $mail_subject;
public $mail_message;
public $message;
public $mail_status;
   
    public function __construct($args = [])
    {
          $this->mail_type_id = $args['mail_type_id'] ?? '';
          $this->mail_send_from = $args['mail_send_from'] ?? '';
          $this->mail_to_admin = $args['mail_to_admin'] ?? '';
          $this->mail_subject = $args['mail_subject'] ?? '';
          $this->mail_message = $args['mail_message'] ?? '';
          $this->message = $args['message'] ?? '';
          $this->mail_status = $args['mail_status'] ?? '';
            
    }
      
    public static function find_by_order()
    {
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY mail_id desc";
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

    static public function find_by_detail_id() {
        $sql = "SELECT * FROM " . static::$table_name . " ";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }

      static public function find_by_mailtemplate($mail_id,$mail_type) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE mail_id='" . self::$database->escape_string($mail_id) . " 'and mail_type_id='" . self::$database->escape_string($mail_type) . "' ";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }

      static public function find_by_mailtemplate_id($mail_id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE mail_type_id='" . self::$database->escape_string($mail_id) . "'";
         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
  
    public static function delete_mail_id($id){
        $sql="DELETE From " . self::$table_name. " ";
        $sql .="WHERE mail_id ='" . self::$database->escape_string($id) . "'";
        $result = self::$database->query($sql);
        return $result;
    }  
}
?>