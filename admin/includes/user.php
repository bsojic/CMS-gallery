<?php 

class User extends Db_object {

  protected static $db_table = "users";
  protected static $db_table_fields = ['username', 'user_image', 'password', 'first_name', 'last_name'];
  public $id;
  public $username;
  public $user_image;
  public $password;
  public $first_name;
  public $last_name;
  public $upload_directory = "images";
  public $image_placeholder = "http://placehold.it/400x400&text=image";

  public function setFile($file) {

    if(empty($file) || !$file || !is_array($file)) {
      $this->errors[] = "There was no file uploaded here";
      return false;
    } elseif($file['error'] !=0) {
      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;
    } else {
      $this->user_image = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      $this->type     = $file['type'];
      $this->size     = $file['size'];
    }
  }

  public function uploadPhoto() {

    if(!empty($this->errors)) {
      return false;
    }
    if(empty($this->user_image) || empty($this->tmp_path)) {
      $this->errors[] = "The file was not available";
      return false;
    }
    
    $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

    if(file_exists($target_path)) {
      $this->errors[] = "The file {$this->user_image} already exists";
      return false;
    }

    if(move_uploaded_file($this->tmp_path, $target_path)) {
      unset($this->tmp_path);
      return true;

    } else {
      $this->errors[] = "This folder does not have permission";
      return false;
    }
  }

  public function imagePlaceholder() {
    return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
  }

  public static function verifyUser($username, $password) {
    global $database;

    $username = $database->escapeString($username);
    $password = $database->escapeString($password);
    $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
    $the_result_array = self::findByQuery($sql);
    return !empty($the_result_array) ? array_shift($the_result_array) : false;
  }

  public function ajaxSaveImage($user_image, $user_id) {
    $this->user_image = $user_image;
    $this->id = $user_id;
    $this->save();
  }

} //end of user class


 ?>