<?php
    session_start();
    require('../config/db.php');
    if(!isset($_SESSION['user_id'])){
      header("location:../");
    }

    $id = $_SESSION['user_id'];
    $sqlX = $connect->query("SELECT * FROM user WHERE user_id = '$id'");
    $row = $sqlX->fetch_object();

    if(isset($_POST['save'])){
      $fname = $_POST['firstName'];
      $mname = $_POST['middleName'];
      $lname = $_POST['lastName'];
      $gender = $_POST['gender'];
      $email = $_POST['email'];

      $connect->query("UPDATE user
                       SET first_name= $fname, middle_name=$mname, last_name=$lname, gender=$gender, email=$email
                       WHERE user_id=$id");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Profile | Page</title>
  <link href="../assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/admin/css/ruang-admin.min.css" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="../assets/profile/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/profile/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
        <?php include('layouts/sidebar.php');?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
          <?php include('layouts/header.php');?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">profile</h1>
          </div>
          <!-- profile -->
  <main id="main" class="main">
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img class="img-profile rounded-circle" src="../assets/admin/img/boy.png" style="max-width: 60px">
              <hr>
              <h2 class="text-gray-900 text-uppercase"><?php echo $_SESSION['name']?></h2>
              <h4 class="text-gray-500"><?php echo $_SESSION['email']; ?></h4>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-4">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title text-gray-900">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label text-primary">Fisrt Name</div>
                    <div class="col-lg-9 col-md-8 text-uppercase"><?php echo $row->first_name;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label text-primary">Middle Name</div>
                    <div class="col-lg-9 col-md-8 text-uppercase"><?php echo $row->middle_name;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label text-primary">Last Name</div>
                    <div class="col-lg-9 col-md-8 text-uppercase"><?php echo $row->last_name;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label text-primary">Gender</div>
                    <div class="col-lg-9 col-md-8 text-uppercase"><?php echo $row->gender;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label text-primary">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row->email;?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="profile.php">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label text-primary">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstName" type="text" class="form-control" value="<?php echo $row->first_name;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label text-primary">Middle Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="middleName" type="text" class="form-control" value="<?php echo $row->middle_name;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label text-primary">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastName" type="text" class="form-control" value="<?php echo $row->last_name;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label text-primary">Gender</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="gender" type="text" class="form-control" id="company" value="<?php echo $row->gender;?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label text-primary">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="Country" value="<?php echo $row->email;?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" nam="save">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label text-primary">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label text-primary">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label text-primary">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
          <!-- profile -->
          <!--Row-->
          <!-- Modal Logout -->
          <?php include('layouts/modal-logout.php');?>
        </div>
        <!---Container Fluid-->
      </div>
    </div>
  </div>
  <!-- Footer -->
    <?php include('layouts/footer.php');?>
  <!-- Footer -->
  
  <script src="../assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../assets/admin/js/ruang-admin.min.js"></script>

  <!-- Vendor JS Files -->
  <script src="../assets/profile/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/profile/vendor/quill/quill.min.js"></script>
  <script src="../assets/profile/vendor/tinymce/tinymce.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>