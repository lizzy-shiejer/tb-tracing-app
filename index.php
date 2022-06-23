<?php
  session_start();
  require('./config/db.php');

  $message = "";
  $level = 0;

  if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    // validate email 
    $result = pg_query($connect, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $rows = pg_num_rows($result);
    if($rows == 0){
      $message = "Invalid email or password!"; $level = 2;
    }
    else{
      $data = pg_fetch_assoc($result);
      $_SESSION['user_id'] = $data['user_id'];
      $_SESSION['firstName'] = $data['first_name'];
      $_SESSION['middleName'] = $data['middle_name'];
      $_SESSION['lastName'] = $data['last_name'];
      $_SESSION['name'] = $data['first_name'].' '.$data['last_name'];
      $_SESSION['email'] = $data['email'];
      $_SESSION['gender'] = $data['gender'];
      $_SESSION['phone'] = $data['phone'];
      $_SESSION['role'] = $data['role_id'];
      $id = $data['role_id'];

      if($id == 2) {
        $select_user = "SELECT * FROM users";
        $result = pg_query($connect, $select_user);
        $rows = pg_num_rows($result);
        if($rows > 0){
          header('Location: clinician/');
        }
      }
      elseif($id == 1) {
        header('Location: admin/');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="assets/auth/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/auth/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/auth/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/auth/css/style.css">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h3 style="color:#524FCE;">TB TRACING</h3>
              </div>
              <h4>SIGN IN</h4>
              <?php
                if($level != 0){
                ?>
                <div class="alert <?php echo ($level == 2 ? 'alert-danger alert-dismissible':($level == 1 ? 'alert-success alert-dismissible':'alert-warning alert-dismissible'));?> show fade" role="alert"><button type="button" class="close" data-dismiss="alert" arial-label="close"><span>&times;</span></button><?php echo $message;?></div>
                <?php
                }
              ?>
              <form class="pt-3" method="POST">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required>
                </div>
                <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit">SIGN IN</button>                </div>
                <div class="my-4 d-flex justify-content-center align-items-center">
                Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
</body>

</html>
