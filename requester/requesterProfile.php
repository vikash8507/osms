<?php
session_start();
include('./../dbconnection.php');

if (!isset($_SESSION['is_login'])) {
    echo '<script> location.href="./requesterLogin.php"; </script>';
    exit;
}
$email = $_SESSION['email'];

$q1 = "SELECT * FROM requester WHERE r_email = '$email'";
$r1 = $conn->query($q1);

if ($r1->num_rows > 0) {
    $data = $r1->fetch_assoc();
    $name = $data['r_name'];
} else {
    $email = "Unknown";
    $name = "Unknown";
}

if (isset($_REQUEST['update'])) {
    $name = $_REQUEST['name'];
    if (($name == "") || (strlen($name) < 3)) {
        $error = "Please enter name atleast 3 characters long!";
    } else {
        $q2 = "UPDATE requester SET r_name = '$name' WHERE r_email = '$email'";
        if ($conn->query($q2)) {
            $msg = "Profile updated successfully!";
        } else {
            $error = "Error in update request!";
        }
    }
}

include('./includes/header.php') ?>

<div class="col-sm-6 mt-5">
    <form class="mx-5" method="POST">
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" value="<?php echo $email; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $name; ?>">
        </div>
        <button type="submit" class="btn btn-danger mb-2" name="update">Update</button>
        <?php
        if (isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error: </strong> <?php echo $error; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php }
        if (isset($msg)) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success: </strong> <?php echo $msg; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
    </form>
</div>
</div>
</div>

<?php include('./includes/footer.php') ?>