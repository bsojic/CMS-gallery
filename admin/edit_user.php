<?php include("includes/header.php"); ?>
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

  if(isset($_POST['update'])) {

    if($user) {
      $user->username = $_POST['username'];
      $user->first_name = $_POST['first_name'];
      $user->last_name = $_POST['last_name'];
      $user->password = $_POST['password'];

      if(empty($_FILES['user_image'])) {
        $user->save();
        redirect("users.php");
        $session->message("The user has been updated");
      } else {
        $user->setFile($_FILES['user_image']);
        $user->uploadPhoto();
        $user->save();
        $session->message("The user has been updated");
        redirect("users.php");

      }
    }

  }

?>

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include("includes/top_nav.php"); ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include("includes/side_nav.php"); ?>
    <!-- /.navbar-collapse -->
  </nav>

  <div id="page-wrapper">
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Edit User
          </h1>
          <div class="col-sm-6">
            <a href="#" data-toggle="modal" data-target="#photo-modal">
              <img class="img-responsive profile-pic" src="<?php echo $user->imagePlaceholder(); ?>" alt="">
            </a>
          </div>
          <!-- Form -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="user_image">User image</label>
                <input type="file" name="user_image">
              </div>

              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
              </div>

              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
              </div>

              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
              </div>

              <div class="form-group">
                <a id="user-id" href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
                <input type="submit" class="btn btn-primary pull-right" name="update" value="Update">
              </div>

            </div>
          </form>
          <!-- End form -->
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->
  <?php include("includes/photo_modal.php"); ?>
<?php include("includes/footer.php"); ?>