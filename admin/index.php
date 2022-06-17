<?php
  session_start();
  require('../config/db.php');


  $tbContacts = "SELECT COUNT(*) AS a FROM contacts";
  $result = pg_query($connect, $tbContacts);
  $countContacts = pg_fetch_assoc($result)['a'];
  // for symptomatic contacts
  $symptomaticContacts = "SELECT COUNT(*) AS b
                          FROM symptoms";
  $result = pg_query($connect, $symptomaticContacts);
  $countSymptoms = pg_fetch_assoc($result)['b'];

  // for contacts at risk
  $riskContacts = "SELECT COUNT(*) AS c
                   FROM risk_factor";
  $result = pg_query($connect, $riskContacts);
  $countRisks = pg_fetch_assoc($result)['c'];

  // for traced contacts (this takes data from labtest_status column.... there is an issue here)
  $tracedContacts = "SELECT COUNT(*) AS d 
                     FROM contacts 
                     WHERE labtest_status != 'pending'";
  $result = pg_query($connect, $tracedContacts);
  $countTraced = pg_fetch_assoc($result)['d'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Home | Page</title>
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
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Summary Reports</h1>
          </div>
          <div class="row mb-3">
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">tb contacts</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $countContacts; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">symptomatic contacts</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $countSymptoms; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">contacts at risk</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $countRisks;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">traced contacts</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $countTraced;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- Row -->
          <div class="row">
            <!-- Area Charts -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">Tb contacts</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
            <!-- Bar Chart -->
            <div class="col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">Traced contacts</h6>
                </div>
                <div class="card-body">
                  <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                  </div>
                  <hr>
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
  <!-- scripts -->
    <?php include('layouts/scripts.php');?>
  <!-- Page level plugins -->
  <script src="../assets/admin/vendor/chart.js/Chart.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="../assets/admin/js/demo/chart-area-demo.js"></script>
  <script src="../assets/admin/js/demo/chart-bar-demo.js"></script>
  <!-- scripts -->
</body>

</html>