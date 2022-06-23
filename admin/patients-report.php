<?php
  session_start();
  require('../config/db.php');
  if(!isset($_SESSION['user_id'])){
    header("location:../");
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
  <title>Patients | Report</title>
  <link href="../assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/admin/css/ruang-admin.min.css" rel="stylesheet">
  <link href="../assets/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">patients</h1>
          </div>
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">patients</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Registry No</th>
                        <th>Clinic Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $patients = "SELECT  first_name, last_name, gender, registry_number, prev_hospt, occupation
                                     FROM patient
                                     INNER JOIN user
                                     ON patient.user_id=user.user_id";
                        $result = $connect->query($patients);
                        $i = 1;
                        while($data = $result->fetch_array()){
                      ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td><?= $data['first_name']; ?></td>
                          <td><?= $data['last_name']; ?></td>
                          <td><?= $data['gender']; ?></td>
                          <td><?= $data['registry_number']; ?></td>
                          <td><?= $data['prev_hospt']; ?></td>
                          <form action="" method="post">
                          <td>
                                <a href="#" class="btn btn-sm btn-primary">Update</a>
                                <a href="#" class="btn btn-sm btn-primary">Delete</a>
                          </td>
                          </form>
                        </tr>
                      <?php
                        $i++;
                        }
                      ?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
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
 
  <script src="../assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../assets/admin/js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="../assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>