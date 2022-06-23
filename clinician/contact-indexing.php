<?php
  session_start();
  require('../config/db.php');
  if(!isset($_SESSION['user_id'])){
    header("location:../");
  }

  $message = " ";

  if(isset($_POST['submit']))
  {
    $registryNumber = pg_escape_string($connect, $_POST['registryNumber']);
    $firstName = pg_escape_string($connect, $_POST['firstName']);
    $middleName = pg_escape_string($connect, $_POST['middleName']);
    $lastName = pg_escape_string($connect, $_POST['lastName']);
    $clinicName = pg_escape_string($connect, $_POST['clinicName']);
    $interviewDate = pg_escape_string($connect, $_POST['interviewDate']);
    $gender = pg_escape_string($connect, $_POST['gender']);
    $phone = pg_escape_string($connect, $_POST['phone']);
    $occupation = pg_escape_string($connect, $_POST['occupation']);
    $mobile = array($_POST['mobile']);
    $mbl = implode(',', $mobile);
    $code = rand(1111,9999);

    // check if the patient already exists
    $checkPatient = "SELECT * FROM patient WHERE registry_number=$registryNumber";
    $result = pg_query($connect, $checkPatient);
    if(pg_num_rows($result) > 0){
      $massage = "Patient already exists.";
    }
    else {
      $sq = pg_query($connect, "INSERT INTO users(role_id, first_name, middle_name, last_name, gender, phone)
                                VALUES (3, '$firstName', '$middleName', '$lastName', '$gender', '$phone') RETURNING user_id");
      $user = pg_fetch_assoc($sq)['user_id'];
      $sql = pg_query($connect, "INSERT INTO patient(user_id, registry_number, prev_hospt, interview_date, occupation)
                                 VALUES ('$user', '$registryNumber', '$clinicName', '$interviewDate', '$occupation') RETURNING patient_id");
      $patient = pg_fetch_assoc($sql)['patient_id'];
      $sqlX = pg_query($connect, "INSERT INTO patient_info(patient_id, code, phone)
                                  VALUES ('$patient', '$code', '$mbl')");
      // if($sql == true){
      //   // message inayosema = Patient added successfully;
      // }
      // if(isset($_POST['sendText'])){
      //   $mobile = pg_escape_string($connect, $_POST['mobile']);
      //   $code = rand(1000);
      //   pg_query($connect, "INSERT INTO patient_info(patient_id, code, phone)
      //                    VALUES ('$patient', '$code', '$mobile')");
      //   header('Location: contact-indexing.php');
      // }
    } 
  }

  // if(isset($_POST['sendText']))
  // { 
  //   $mobile = pg_escape_string($connect, $_POST['mobile']);

  //   // $patient = mysqli_insert_id($connect);
  //   $code = rand();

  //   $addContact = "INSERT INTO patient_info(patient_id, code, phone)
  //                  VALUES('$patient', '$code', '$mobile')";
  //   $result = pg_query($connect, $addContact);
  //   if($result > 0){
  //   header('Location: contact-indexing.php');
  //   }
  // }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Contact-indexing | Page</title>
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/flag-icon-css/css/flag-icon.min.css" />
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/css/vendor.bundle.base.css" />
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/select2/select2.min.css" />
    <link rel="stylesheet" href="../assets/clinician/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="../assets/clinician/assets/css/style.css" /> -->

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
              <h1 class="h3 mb-0 text-gray-800">CONTACT INDEXING</h1>
            </div> 
            <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <form class="form-sample" method="POST">
                      <p class="card-description" style="color:blue;">TB Indexing</p>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Registry Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="registryNumber" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="firstName" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Middle Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="middleName" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="lastName" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="gender">
                                <option></option>
                                <option name="gender">Male</option>
                                <option name="gender">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- <hr> -->
                      <p class="card-description" style="color:blue;">Demographic Data</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Interview Date</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" name="interviewDate" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Clinic Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="clinicName" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="phone" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Occupation</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="occupation" />
                            </div>
                          </div>
                        </div>
                      </div> 
                      <button type="submit" class="btn btn-primary mr-2" name="submit"> Submit </button>  
                      <hr>
                      <p class="card-description text-uppercase" style="color:blue;">People you came in contact with</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="mobile" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mr-2" name="sendText"> Send Text </button>
                        </div>
                      </div>
                      <!-- <hr> -->
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
    <script src="../assets/admipg_query/$pg_query.$connect, min.js"></script>
    <script src="../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/admipg_query-$connectpg_query.$connect, easing.min.js"></script>
    <script src="../assets/admin/js/ruang-admin.min.js"></script>
    <!-- Page level plugins -->
    <script src="../assets/admin/vendor/dapg_query.$connect, dataTables.min.js"></script>
    <script src="../assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
  </body>
</html>