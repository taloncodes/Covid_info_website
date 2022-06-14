<?php
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db); //new sqli obj, passed the credentials to log in to db

    if ($conn->connect_error) die($conn->connect_error);
?>