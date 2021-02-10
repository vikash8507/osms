<?php

session_start();
include('./../dbconnection.php');
include('./includes/header.php');

if (!isset($_SESSION['is_login'])) {
    echo '<script> location.href="./requesterLogin.php"; </script>';
    exit;
}
$email = $_SESSION['email'];
$req_id = $_SESSION['req_id'];

$sql = "SELECT * FROM request where req_id = '$req_id'";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    echo "<div class='ml-5 mt-5'>
        <table class='table'>
        <tbody>
        <tr>
            <th>Request ID</th>
            <td>" . $row['req_id'] . "</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>" . $row['req_name'] . "</td>
        </tr>
        <tr>
        <th>Email ID</th>
        <td>" . $email . "</td>
        </tr>
        <tr>
            <th>Request Info</th>
            <td>" . $row['req_info'] . "</td>
        </tr>
        <tr>
            <th>Request Description</th>
            <td>" . $row['req_desc'] . "</td>
        </tr>

        <tr>
            <td><form class='d-print-none'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'></form></td>
        </tr>
        </tbody>
        </table> </div>";
} else {
    echo "Request not found!";
}
?>

<?php include('./includes/footer.php') ?>