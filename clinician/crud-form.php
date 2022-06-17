<?php

    session_start();
    require('../config/db.php');

    // script for editting
    if(isset($_POST['edit'])){
    $id = pg_escape_string($connect, $_POST['id']);
    $sql = "SELECT * FROM contacts WHERE contact_id = $id";
    $run = pg_query($connect, $sql);
    $row = pg_fetch_object($run);
    }
    else if(isset($_POST['save'])){
    $labtest = pg_escape_string($connect, $_POST['status']);
    $sql = pg_query($con, "UPDATE contacts SET labtest_status = '".$labtest."' WHERE contact_id = '".$_POST['id']."'");
    header("location:labtests.php");
    }       
    else{
    header("location:labtests.php");
    }
     
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Labtest | Status</title>
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/flag-icon-css/css/flag-icon.min.css" />
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/css/vendor.bundle.base.css" />
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/select2/select2.min.css" />
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <!--  -->
    <link href="../assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/admin/css/ruang-admin.min.css" rel="stylesheet">
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
              <h1 class="h3 mb-0 text-gray-800">LABTEST STATUS</h1>
            </div> 
            <div class="col-6 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <form class="form-sample" method="POST" action="">
                        <input type="hidden" name="id" value="<?php echo $row->contact_id;?>">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                              <input class="form-control text-uppercase" name="name" value="<?php echo $row->first_name.'&nbsp;'.$row->last_name ;?>" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                              <input class="form-control" name="gender" value="<?php echo $row->gender ;?>" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Number</label>
                            <div class="col-sm-9">
                              <input class="form-control" name="phone" value="<?php echo $row->phone ;?>" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Labtest Status</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="status" value="<?php echo $row->labtest_status ;?>"/>
                            </div>
                          </div>
                        </div>
                      <button type="submit" class="btn btn-primary mr-2" name="save"> Update </button>
                    </form>
                  </div>
                </div>
            </div>
            <!-- End of the form -->

          <!-- Modal Logout -->
          <?php include('layouts/modal-logout.php');?>
        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
        <?php include('layouts/footer.php');?>
      <!-- Footer -->
    </div>
    </div>
    <!-- container-scroller -->
    <script src="../assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/admin/js/ruang-admin.min.js"></script>
    <!-- Page level plugins -->
    <script src="../assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
  </body>
</html>