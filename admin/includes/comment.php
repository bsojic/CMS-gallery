<?php 

class Comment extends Db_object {

  protected static $db_table = "comments";
  protected static $db_table_fields = ['id','photo_id', 'author', 'body'];
  public $id;
  public $photo_id;
  public $author;
  public $body;

  public static function createComment($photo_id, $author="Branko", $body="") {
    if(!empty($photo_id) && !empty($author) && !empty($body)) {

      $comment = new Comment();

      $comment->photo_id = (int)$photo_id;
      $comment->author   = $author;
      $comment->body     = $body;

      return $comment;
    } else {
      return false;
    }
  }

  public static function findComments($photo_id=0) {
    global $database;

    $sql = "SELECT * FROM " . self::$db_table;
    $sql .= " WHERE photo_id = " . $database->escapeString($photo_id);
    $sql .= " ORDER BY photo_id ASC";

    return self::findByQuery($sql);
  }

} //end of comment class


 ?>