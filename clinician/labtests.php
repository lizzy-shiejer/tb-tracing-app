<?php
  session_start();
  require('../config/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Contacts | Report</title>
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
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">labtest results</h1>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">contacts</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Labtest Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $labtestResult = "SELECT contacts.contact_id as id, contacts.first_name, contacts.last_name, contacts.gender, contacts.phone, contacts.labtest_status   
                                          FROM symptoms
                                          INNER JOIN contacts 
                                          ON symptoms.contact_id=contacts.contact_id
                                          WHERE labtest_status = 'pending'";
                        $result = pg_query($connect,  $labtestResult);
                        if(pg_num_rows($result) == 0){
                          echo "<tr><td>No Contacts!</td></tr>";
                        }
                        else{
                          $i = 1;
                          while($data = pg_fetch_array($result)){
                      ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?= $data['first_name']; ?></td>
                            <td><?= $data['last_name']; ?></td>
                            <td><?= $data['gender']; ?></td>
                            <td><?= $data['phone']; ?></td>
                            <td><span class="badge badge-info"><?= $data['labtest_status']; ?></span></td>
                            
                              <form action="crud-form.php" method="post">
                              <td>
                                <input type="text" name="id" value="<?php echo $data['id'];?>" hidden>
                                <button class="btn btn-sm btn-primary" name="edit" type="submit">Edit</button>
                            </td>
                              </form>
                                
                          </tr>
                      <?php
                        $i++;
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
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

</body>

</html>