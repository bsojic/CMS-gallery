<?php 

class Photo extends Db_object {
  //property objects
  protected static $db_table = "photos";
  protected static $db_table_fields = ['id', 'title', 'caption', 'description', 'filename', 'alternate_text', 'type', 'size'];
  public $id;
  public $title;
  public $caption;
  public $description;
  public $filename;
  public $alternate_text;
  public $type;
  public $size;

  public $tmp_path;
  public $upload_directory = "images";

  public function setFile($file) {

    if(empty($file) || !$file || !is_array($file)) {
      $this->errors[] = "There was no file uploaded here";
      return false;
    } elseif($file['error'] !=0) {
      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;
    } else {
      $this->filename = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      $this->type     = $file['type'];
      $this->size     = $file['size'];
    }
  }

  public function picturePath() {
    return $this->upload_directory.DS.$this->filename;
  }

  public function save() {

    if($this->id) {
      $this->update();
    } else {
      if(!empty($this->errors)) {
        return false;
      }
      if(empty($this->filename) || empty($this->tmp_path)) {
        $this->errors[] = "The file was not available";
        return false;
      }
      
      $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

      if(file_exists($target_path)) {
        $this->errors[] = "The file {$this->filename} already exists";
        return false;
      }

      if(move_uploaded_file($this->tmp_path, $target_path)) {
        if($this->create()) {
          unset($this->tmp_path);
          return true;
        }
      } else {
        $this->errors[] = "This folder does not have permission";
        return false;
      }
    }
  }

  public function deletePhoto() {
    if($this->delete()) {
      $target_path = SITE_ROOT.DS. 'admin' . DS . $this->picturePath();
      return unlink($target_path) ? true : false;
    } else {
      return false;
    }
  }

}


 ?>