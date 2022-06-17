<?php
    // connecting to the postgres database

    // create connection
    // $conn_string = "host=localhost port=5432 dbname=tracing user=postgres password=shija123";
    $connect = pg_connect("host=localhost port=5432 dbname=tracing user=postgres password=shija123");

    if($connect == false ){
        die('error'.pg_last_error());
    }

?>