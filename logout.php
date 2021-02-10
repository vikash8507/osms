<?php
session_start();
include('./dbconnection.php');

if (!isset($_SESSION['is_login'])) {
    echo '<script> location.href="./requesterLogin.php"; </script>';
    exit;
}

session_destroy();
echo '<script> location.href="/osms"; </script>';
?>