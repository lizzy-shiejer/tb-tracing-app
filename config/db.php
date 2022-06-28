<?php
    // connecting to the postgres database

    // connecting with mysql database
    // $connect = new mysqli('localhost', 'root', '', 'tbt');

    // connecting to pgsql localhost
    $connect = pg_connect("host=localhost port=5432 dbname=tracing user=postgres password=shija123");

    // connecting with postgresql
    // $connect = pg_connect("host=ec2-3-224-8-189.compute-1.amazonaws.com port=5432 dbname=dfokskml2eml7l user=vbdhdhvbgqhpec password=8ac72f40ab031d792f5cb3a456895892b846550b5a43ded5bc3c194e91f82ba9");