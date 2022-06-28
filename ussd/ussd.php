<?php
    header('content-type: text/plain');

    // include function file
    include 'function.php';

    // config database
    include '../config/db.php';

    // for service pporviders
    // $sessionId = $_POST['sessionId'];
    // $serviceCode = $_POST['serviceCode'];
    $phone = $_POST['phoneNumber'];
    $text = $_POST['text'];

    // variables
    $data = explode('*', $text);
    $level = 0;
    $level = count($data);

    if($level == 0 || $level == 1){
        main_menu();
    }

    if($level > 1){
        switch($data[1]){
            case 1:
                code($data);
                register($data);
                break;
            
            case 2:
                code($data);
                screening($data);
                break;

            case 3:
                code($data);
                risk($data);
                break;

            case 4:
                code($data);
                labresult($data);
                break;

            default:
                $text = "Invalid input";
                session_ends($text);
        }
    }
?>