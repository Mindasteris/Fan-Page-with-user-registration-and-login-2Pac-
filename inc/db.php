<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('NAME', 'db_tupac');

    $conn = new mysqli(HOST, USER, PASS, NAME);

    if(!$conn) {
        die("Connection Failed: " . $conn->connet_error());
    }
?>