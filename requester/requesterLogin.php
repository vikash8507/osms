<?php
session_start();
include('./../dbconnection.php');

if (isset($_SESSION['is_login'])) {
    echo '<script> location.href="./requesterProfile.php"; </script>';
    exit;
}

if (isset($_REQUEST['login'])) {
    $email = mysqli_real_escape_string($conn, trim($_REQUEST['email']));
    $password = mysqli_real_escape_string($conn, trim($_REQUEST['password']));

    $q1 = "SELECT * FROM requester WHERE r_email = '$email'";
    $r1 = $conn->query($q1);
    if ($r1->num_rows > 0) {
        $q2 = "SELECT * FROM requester WHERE r_email = '$email' AND r_password = '$password'";
        $r2 = $conn->query($q2);
        if ($r2->num_rows > 0) {
            $data = $r2->fetch_assoc();
            $_SESSION['is_login'] = true;
            $_SESSION['email'] = $data['r_email'];
            // echo $data['r_email'];
            echo '<script> location.href="./requesterProfile.php"; </script>';
        } else {
            $loginError = "Email or password incorrect!";
        }
    } else {
        $loginError = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <style>
        .custom-margin {
            margin-top: 8vh;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="mb-3 text-center mt-5" style="font-size: 30px;">
        <i class="fas fa-stethoscope"></i>
        <span>Online Maintenance Managment System</span>
    </div>
    <p class="text-center" style="font-size: 20px;"> <i class="fas fa-user-secret text-danger"></i> <span>Requester
            Area(Demo)</span>
    </p>
    <?php
    if (isset($loginError)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error: </strong> <?php echo $loginError; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <div class="container-fluid mb-5">
        <div class="row justify-content-center custom-margin">
            <div class="col-sm-6 col-md-4">
                <form action="" class="shadow-lg p-4" method="POST">
                    <div class="form-group">
                        <i class="fas fa-user"></i><label for="email" class="pl-2 font-weight-bold">Email</label><input type="email" class="form-control" placeholder="Email" name="email">
                        <!--Add text-white below if want text color white-->
                        <small class="form-text">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Password</label><input type="password" class="form-control" placeholder="********" name="password">
                    </div>
                    <button type="submit" class="btn btn-outline-danger mt-3 btn-block shadow-sm font-weight-bold" name='login'>Login</button>
                </form>
                <div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold" href="./../index.php">Back
                        to Home</a></div>
            </div>
        </div>
    </div>

    <!-- Boostrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>