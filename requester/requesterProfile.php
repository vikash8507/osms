<?php
session_start();
include('./../dbconnection.php');

if (!isset($_SESSION['is_login'])) {
    echo '<script> location.href="./requesterLogin.php"; </script>';
    exit;
}

if (isset($_SESSION['is_login'])) {
    $is_login = $_SESSION['is_login'];
    $email = $_SESSION['email'];
    echo "Authorized user\n";
    echo $is_login . " " . $email;
} else {
    echo "Unauthorized user";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <p>Profile</p>
</body>

</html>