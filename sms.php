<!-- NGFkMDVhYzQ3Mjg5ZDU0M2FjMjgyNTViOWMzYTE5YWM1OTEwYWJhOWI0OWJlOGUzNDNhMTQyYjFjZTM2MmY3Nw== (sk) -->


<?php
session_start();

if (isset($_SESSION['code']) && !empty($_SESSION['mobile'])) {
    $api_key = '3e37b715bae594b5';
    $secret_key = 'NGFkMDVhYzQ3Mjg5ZDU0M2FjMjgyNTViOWMzYTE5YWM1OTEwYWJhOWI0OWJlOGUzNDNhMTQyYjFjZTM2MmY3Nw==';

    $postData = array(
        'source_addr' => 'INFO',
        'encoding' => 0,
        'schedule_time' => '',
        'message' => 'Habari ngudu' . $_SESSION['code'],
        'recipients' => [array('recipient_id' => '1', 'dest_addr' => $_SESSION['mobile'])]
    );

    $Url = 'https://apisms.beem.africa/v1/send';

    $ch = curl_init($Url);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));

    $response = curl_exec($ch);

    if ($response === FALSE) {
        echo $response;

        die(curl_error($ch));
    }
    var_dump($response);
    $_SESSION['message'] = "SMS";
    header("location: ./clinician/contact-indexing.php");
} else {

    header("location: ./clinician/contact-indexing.php");
}
