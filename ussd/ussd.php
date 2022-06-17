<?php
    header("content-type: text/plain");

    // config database
    include('../config/db.php');

    // functions 
    include('function.php');

    // for the serice providers...
    // $session_id = $_POST['sessionId'];
    // $service_code  = $_POST['serviceCode'];
    $phone = $_POST['phoneNumber'];
    $text = $_POST['text'];
    
    $data = explode('*', $text); //data come in form of array the explode() is required to separate the data

    $level = 0;
    $level = count($data);

    // echo $levegitl. " ";

    if($level == 0 || $level == 1)
    {
        main_menu();
    }

    if($level > 1)
    {
        switch($data[1])
        {
            // if the user select 1 for registering
            case 1:
                check_contact($phone);
                register_contact($data, $phone);
                break;

            // if the user select 2 for sysmptom screening
            case 2:
                check_password($data, $phone);
                symptom_screening($data, $phone);
                break;
            
            // if the user select 3 for risk _fator assesment
            case 3:
                check_password($data, $phone);
                risk_factor($data, $phone);
                break;
            
            // if the user select 4 for labaratory test results
            // case 3:
            //     check_password($data, $phone);
            //     labtest($data, $phone);
            //     break;

            // if the user select 4 for status
            // case 4:
            //     check_password($data, $phone);
            //     status($data, $phone);
            //     break;

            case 4:
                check_password($data,$phone);
                labtest($data, $phone);
                break;

            default:
                $text = "Invalid input";
                ussd_stop($text);
                break;
        }
    }

     
?>
