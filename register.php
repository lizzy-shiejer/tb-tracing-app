<?php
  include('config/db.php');

  // assign variable for alert messages
  $message = "";
  $level = 0;

  // registering user once the submmit button is clicked
  if(isset($_POST['submit'])){
    // removing special charaters from the input for sql query
    $firstName = mysqli_real_escape_string($connect, $_POST['firstname']);
    $middleName = mysqli_real_escape_string($connect, $_POST['middlename']);
    $lastName = mysqli_real_escape_string($connect, $_POST['lastname']);
    $gender = mysqli_real_escape_string($connect, $_POST['gender']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    // $clinicName = mysqli_real_escape_string($connect, $_POST['clinicName']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $password_encrypt = sha1($password);

    // validating email if it already exist before inserting into the database
      $check_email = "SELECT * FROM user WHERE email='$email'";
      $result = $connect->query($check_email);
      if($result->num_rows > 0){
        $message = "This email already exists.".$level = 2; //this message is now not showing
      }else{
        $sql_query = "INSERT INTO user(role_id, first_name, middle_name, last_name, gender, email, password)
                      VALUES(2, '$firstName', '$middleName', '$lastName', '$gender', '$email', '$password_encrypt')";
        $result = $connect->query($sql_query);

        if(!$connect->connect_error){
          $message = "You're registered successfully !"; $level = 1;
          header("Refresh:.5; url=./index.php");
        }else{
          $message = "There is an error"; $level = 2;
          // echo 'There is an error'.pg_last_error($connect);
          $connect->connect_error;
        }
      }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sign up</title>
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
            <div class="auth-form-light text-left py-4 px-3 px-sm-4">
              <div class="brand-logo">
                <h3 style="color:#524FCE;">TB TRACING</h3>
              </div>
              <h4>SIGN UP</h4>
              <?php
                if($level != 0){
                ?>
                <div class="alert <?php echo ($level == 2 ? 'alert-danger alert-dismissible':($level == 1 ? 'alert-success alert-dismissible':'alert-warning alert-dismissible'));?> fade show" role="alert"><button type="button" class="close" data-dismiss="alert" arial-label="close"><span>&times;</span></button><?php echo $message;?></div>
                <?php
                }
              ?>
              <form class="pt-3"method="POST">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="firstname" placeholder="First Name" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="middlename" placeholder="Middle Name" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="lastname" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                  <select class="form-control form-control-lg" name="gender" required>
                    <option>Gender</option>
                    <option name="gender">Female</option>
                    <option name="gender">Male</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="submit">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="index.php" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/auth/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/auth/js/off-canvas.js"></script>
  <script src="assets/auth/js/hoverable-collapse.js"></script>
  <script src="assets/auth/js/template.js"></script>
  <script src="assets/auth/js/settings.js"></script>
  <script src="assets/auth/js/todolist.js"></script>
</body>

</html>
