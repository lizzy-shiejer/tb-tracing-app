<?php
session_start();
unset($_SESSION['message']);
header("location:./clincian/contact-indexing.php");
