<?php

session_start();
include('./../dbconnection.php');
if (!isset($_SESSION['is_admin_login'])) {
    echo '<script> location.href="./adminLogin.php"; </script>';
}

?>

Admin login done!