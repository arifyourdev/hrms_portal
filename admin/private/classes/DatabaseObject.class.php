<?php

class DatabaseObject {

  static protected $database;
  static protected $table_name = "";
  static protected $custom_id = "";
  static protected $columns = [];
  public $errors = [];

  static public function set_database($database) {
    self::$database = $database;
  }
  

  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }

  static public function count_all() {
    $sql = "SELECT COUNT(*) FROM " . static::$table_name;
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    return array_shift($row);
  }

  static public function find_by_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
    static public function find_by_custom_id($custom_id,$id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE $custom_id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  static public function find_by_hash_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE md5(id)='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }


  static public function find_by_where($ca_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE cat_id='" . self::$database->escape_string($ca_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  static protected function instantiate($record) {
    $object = new static;
    // Could manually assign values to properties
    // but automatically assignment is easier and re-usable
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  protected function validate() {
    $this->errors = [];

    // Add custom validations

    return $this->errors;
  }

  protected function create($custom_id) {
    $this->validate();
    if(!empty($this->errors)) { return false; }


    $attributes = $this->sanitized_attributes($custom_id);
    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .= implode(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= implode("', '", array_values($attributes));
    $sql .= "')";
    $result = self::$database->query($sql);
    if($result) {
      $this->$custom_id = self::$database->insert_id;
    }
    return $result;
  }

  protected function update($custom_id) {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes($custom_id);
    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE $custom_id='" . self::$database->escape_string($this->$custom_id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  public function save($custom_id) {
    // A new record will not have an ID yet
    if(isset($this->$custom_id)) {
      return $this->update($custom_id);
    } else {
      return $this->create($custom_id);
    }
  }

  public function merge_attributes($args=[]) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  // Properties which have database columns, excluding ID
  public function attributes($custom_id) {
    $attributes = [];
    foreach(static::$db_columns as $column) {
      if($column == $custom_id) { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  protected function sanitized_attributes($custom_id) {
    $sanitized = [];
    foreach($this->attributes($custom_id) as $key => $value) {
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }

  public function delete() {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;

    // After deleting, the instance of the object will still
    // exist, even though the database record does not.
    // This can be useful, as in:
    //   echo $user->first_name . " was deleted.";
    // but, for example, we can't call $user->update() after
    // calling $user->delete().
  }





}