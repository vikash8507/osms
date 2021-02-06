<?php

include('./dbconnection.php');

if (isset($_REQUEST["signup"])) {
    $name = $_REQUEST["name"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    if (($name == '') || ($email == '') || ($password == '')) {
        $signup_error = "All fields are required!";
    } else if (strlen($password) < 8) {
        $signup_error = "Password is must be at least 8 characters!";
    } else {
        $sql = "SELECT * FROM requester WHERE r_email = '$email'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $signup_error = "Email already exists!";
        } else {
            $sql = "INSERT INTO requester(r_name, r_email, r_password) VALUES('$name', '$email', '$password')";
            if ($conn->query($sql) == TRUE) {
                $signup_msg = "Signup successed! You are now able to login!";
            } else {
                $signup_error = 'Error in signup! Please contact to administrator!';
            }
        }
    }
}

?>

<div class="container pt-5" id="registration">
    <h2 class="text-center">Create an Account</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <?php
            if (isset($signup_error)) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error: </strong> <?php echo $signup_error; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php }
            if (isset($signup_msg)) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success: </strong> <?php echo $signup_msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php }
            ?>
            <form action="" class="shadow-lg p-4" method="POST">
                <div class="form-group">
                    <i class="fas fa-user"></i><label for="name" class="pl-2 font-weight-bold">Name</label><input type="text" class="form-control" placeholder="Name" name="name">
                </div>
                <div class="form-group">
                    <i class="fas fa-user"></i><label for="email" class="pl-2 font-weight-bold">Email</label><input type="email" class="form-control" placeholder="Email" name="email">
                    <!--Add text-white below if want text color white-->
                    <small class="form-text">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">New
                        Password</label><input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-danger mt-5 btn-block shadow-sm font-weight-bold" name="signup">Sign Up</button>
                <em style="font-size:10px;">Note - By clicking Sign Up, you agree to our Terms, Data
                    Policy and Cookie Policy.</em>
            </form>
        </div>
    </div>
</div>