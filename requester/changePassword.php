<?php

session_start();
include('./../dbconnection.php');
include('./includes/header.php');

if (!isset($_SESSION['is_login'])) {
    echo '<script> location.href="./requesterLogin.php"; </script>';
    exit;
}
$email = $_SESSION['email'];
if (isset($_REQUEST['passupdate'])) {
    $pass = $_REQUEST['npassword'];
    $cpass = $_REQUEST['ncpassword'];
    if ($pass == '') {
        $error = "Please enter new password!";
    } else if ($pass != $cpass) {
        $error = "Password and confirm password must match!";
    } else {
        $q = "UPDATE requester SET r_password = '$pass' where r_email = '$email'";
        if ($conn->query($q)) {
            $msg = "Password update successfully!";
        } else {
            $error = "Password not updated successfully! Please try again.";
        }
    }
}
?>

<div class="col-sm-9 col-md-10">
    <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5" method="POST">
                <div class="form-group">
                    <label for="inputnewpassword">New Password</label>
                    <input type="password" class="form-control" id="inputnewpassword" placeholder="********" name="npassword">
                </div>
                <div class="form-group">
                    <label for="inputnewconfpassword">Confirm Password</label>
                    <input type="password" class="form-control" id="inputnewconfpassword" placeholder="New Password" name="ncpassword">
                </div>
                <button type="submit" class="btn btn-danger mr-4 mt-4" name="passupdate">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
            </form>
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
        </div>
    </div>
</div>
</div>
</div>

<?php include('./includes/footer.php') ?>