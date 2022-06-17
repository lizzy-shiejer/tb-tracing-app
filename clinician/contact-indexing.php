<?php
  session_start();
  require('../config/db.php');

  $message = " ";

  // adding a contact into the database ad sed them text messages
  if(isset($_POST['addContact']))
  {
    // removing special charaters from the input for sql query
    $fName = pg_escape_string($connect, $_POST['fName']);
    $lName = pg_escape_string($connect, $_POST['lName']);
    $age = pg_escape_string($connect, $_POST['age']);
    $mobile = pg_escape_string($connect, $_POST['mobile']);

    // checking if the contact as already been added

    // inserting the data into the database 
    $addContact = "INSERT INTO contacts(first_name, last_name, age, phone)
                   VALUES('$fName', '$lName', '$age', '$mobile')";
    $result = pg_query($connect, $addContact);
    if($result > 0){
    header('Location: contact-indexing.php');
    }

  }

  // adding the patient into the database and capturing the contacts that are related to the patient
  if(isset($_POST['submit']))
  {
    // removing special charaters from the input for sql query
    $idNumber = pg_escape_string($connect, $_POST['idNumber']);
    $registryNumber = pg_escape_string($connect, $_POST['registryNumber']);
    $firstName = pg_escape_string($connect, $_POST['firstName']);
    $lastName = pg_escape_string($connect, $_POST['lastName']);
    $clinicName = pg_escape_string($connect, $_POST['clinicName']);
    $interviewDate = pg_escape_string($connect, $_POST['interviewDate']);
    $birthDate = pg_escape_string($connect, $_POST['birthDate']);
    $gender = pg_escape_string($connect, $_POST['gender']);
    $district = pg_escape_string($connect, $_POST['district']);
    $region = pg_escape_string($connect, $_POST['region']);
    $phone = pg_escape_string($connect, $_POST['phone']);
    $occupation = pg_escape_string($connect, $_POST['occupation']);

    // function for accessing the foreign key
    function fetchClinicianId()
    {
      global $connect;
      $sql = pg_query($connect, "SELECT user_id as id FROM users WHERE user_id = '".$_SESSION['user_id']."' ");
      $clinicianId = pg_fetch_assoc($sql)['id'];
      return $clinicianId;
    }

    // check if the patient already exists
    $checkPatient = "SELECT * FROM patients WHERE registry_number=$registryNumber AND id_number=$idNumber";
    $result = pg_query($connect, $checkPatient);
    if(pg_num_rows($result) > 0){
      $massage = "Patient already exists.";
    }
    else{
      // inserting the data into the database
      $submitPatient = "INSERT INTO patients(user_id,first_name, last_name, gender, date_of_birth, id_number, registry_number, clinic_name, interview_date, phone, district, region, occupation)
      VALUES('".fetchClinicianId()."','$firstName', '$lastName', '$gender', '$birthDate', '$idNumber', '$registryNumber', '$clinicName', '$interviewDate', '$phone', '$district', '$region', '$occupation')";
      $result = pg_query($connect, $submitPatient);
      if($result > 0){
      header('Location: contact-indexing.php');
      }
    } 
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Contact-indexing | TB-patient</title>
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
             <!--alert  message  -->
             <!-- <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> -->
                    <!-- there is an issue hee that need to be solved -->
                    <!-- shija yooo -->
                    <!-- i want to diplay an alert message here -->
              <!-- </div> -->
             <!--alert  message  -->
                  
            <!-- form that captue tb-patiennt details -->
            <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <form class="form-sample" method="POST">
                      <p class="card-description" style="color:blue;">TB Indexing</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ID Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="idNumber" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Registry Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="registryNumber" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="firstName" />
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
                      <hr>
                      <p class="card-description" style="color:blue;">Demographic Data</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" name="birthDate" />
                            </div>
                          </div>
                        </div>
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
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">District</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="district" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Region</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="region">
                              <option></option>
                              <option name="region">Arusha</option>
                              <option name="region">Mwanza</option>
                              <option name="region">Dodoma</option>
                              <option name="region">Dar es salaam</option>
                              </select>
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
                      <hr>
                      <p class="card-description" style="color:blue;">Household Contact</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="fName" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="lName" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Age</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="age" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="mobile" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mr-2" name="addContact"> Add Contact </button>
                        </div>
                      </div>
                      <hr>
                      <button type="submit" class="btn btn-primary mr-2" name="submit"> Submit </button>
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