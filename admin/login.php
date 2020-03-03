<?php include("includes/header.php"); ?>
<?php 

  if($session->isSignedIn()) {
    redirect("index.php");
  }

  if(isset($_POST['submit'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //method to check database user
    $user_found = User::verifyUser($username, $password);
  

    if($user_found) {

      $session->login($user_found);
      redirect("index.php");

    }
     else {
      $username = "";
      $password = "";
    }

  }

 ?>

 <div class="col-md-4 col-md-offset-3">
 	<form action="" method="post" accept-charset="utf-8">
 		<div class="form-group">
 			<label for="username">Username</label>
      <input type="text" class="form-control" name="username">
 		</div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
      <input type="submit" name="submit" value="submit" class="btn btn-primary">
    </div>
 	</form>
 </div>