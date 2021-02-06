<?php

    $host = "127.0.0.1";
    $user = 'root';
    $password = '';
    $db = 'osms';
    $port = '3306';

    $conn = new mysqli($host, $user, $password, $db, $port);

    if ($conn->connect_error) {
        die('Connection failed!');
    }
?>