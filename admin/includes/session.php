<?php 

class Session {

  private $signed_in = false;
  public  $user_id;
  public  $message;
  public  $count;

  function __construct() {
    session_start();
    $this->visitorCount();
    $this->checkLogin();
    $this->checkMessage();
  }

  public function visitorCount() {
    if(isset($_SESSION['count'])) {
      return $this->count = $_SESSION['count']++;
    } else {
      return $_SESSION['count'] = 1;
    }
  }

  public function message($msg="") {
    if(!empty($msg)) {
      $_SESSION['message'] = $msg;
    } else {
      return $this->message;
    }
  }

  public function checkMessage() {
    if(isset($_SESSION['message'])) {
      $this->message = $_SESSION['message'];
      unset($_SESSION['message']);
    } else {
      $this->message = "";
    }
  }

  public function isSignedIn() {
    return $this->signed_in;
  }
  // id is from user.php property
  public function login($user) {
    if($user) {
      $this->user_id = $_SESSION['user_id'] = $user->id;
      $this->signed_in = true;
    }
  }

  public function logout() {
    unset($this->user_id);
    unset($_SESSION['user_id']);
    $this->signed_in = false;
  }

  private function checkLogin() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->signed_in = true;
    } else {
      unset($this->user_id);
      $this->signed_in = false;
    }
  } 

}

$session = new Session();
$message = $session->message();



 ?>