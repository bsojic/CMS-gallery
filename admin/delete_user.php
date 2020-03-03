<?php include("includes/init.php"); ?>
<?php 

  if(!$session->isSignedIn()) {
    redirect("./login.php");
  }

?>
<?php 

  if(empty($_GET['id'])) {
    redirect("users.php");
  }

  $user = User::findById($_GET['id']);

  if($user) {
    $session->message("The user {$user->username} has been deleted");
    $user->delete();
    redirect("users.php");
  } else {
    redirect("users.php");
  }

 ?>
