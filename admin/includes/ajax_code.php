<?php include("init.php"); ?>
<?php 
  $user = new User();

  if(isset($_POST['image_name'])) {
    $user->ajaxSaveImage($_POST['image_name'], $_POST['user_id']);
  }

 ?>