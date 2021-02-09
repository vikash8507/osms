<?php

session_start();
include('./../dbconnection.php');

if (!isset($_SESSION['is_login'])) {
    echo '<script> location.href="./requesterLogin.php"; </script>';
    exit;
}
$email = $_SESSION['email'];

if (isset($_REQUEST['submitrequest'])) {
    $requestinfo = $_REQUEST['requestinfo'];
    $requestdesc = $_REQUEST['requestdesc'];
    $requestername = $_REQUEST['requestername'];
    $requesteradd = $_REQUEST['requesteradd'];
    $requestercity = $_REQUEST['requestercity'];
    $requesterstate = $_REQUEST['requesterstate'];
    $requesterzip = $_REQUEST['requesterzip'];
    $requestermobile = $_REQUEST['requestermobile'];
    $requestdate = $_REQUEST['requestdate'];
    if (($requestinfo == '') || ($requestdesc == '') || ($requestername == '') || ($requestercity == '') || ($requesteradd == '') || ($requesterstate == '') || ($requesterzip == '') || ($requestermobile == '') || ($requestdate == '')) {
        $error = "All fields are required!";
    } else {
        $q = "INSERT INTO request(req_info, req_desc, req_name, req_add, req_city, req_state, req_zip, req_mobile, req_date) 
        VALUES ('$requestinfo', '$requestdesc', '$requestername', '$requesteradd', '$requestercity', '$requesterstate', '$requesterzip', '$requestermobile', '$requestdate')";

        if ($conn->query($q)) {
            $msg = "Request submit successfully! Please wait We try to solve your problem as soon as possible.";
        } else {
            $error = "Request not submit now! Please wait after some time.";
        }
    }
}

include('./includes/header.php'); ?>

<div class="col-sm-9 col-md-10 mt-5">
    <form class="mx-5 mb-2" action="" method="POST">
        <div class="form-group">
            <label for="inputRequestInfo">Request Info</label>
            <input type="text" class="form-control" id="inputRequestInfo" placeholder="Request Info" name="requestinfo">
        </div>
        <div class="form-group">
            <label for="inputRequestDescription">Description</label>
            <input type="text" class="form-control" id="inputRequestDescription" placeholder="Write Description" name="requestdesc">
        </div>
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="inputName" placeholder="Rahul" name="requestername">
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputAddress">Address Line</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="House No. 123" name="requesteradd">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="requestercity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <input type="text" class="form-control" id="inputState" name="requesterstate">
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip" name="requesterzip" onkeypress="isInputNumber(event)">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputMobile">Mobile</label>
                <input type="text" class="form-control" id="inputMobile" name="requestermobile" onkeypress="isInputNumber(event)">
            </div>
            <div class="form-group col-md-6">
                <label for="inputDate">Date</label>
                <input type="date" class="form-control" id="inputDate" name="requestdate">
            </div>
        </div>

        <button type="submit" class="btn btn-danger" name="submitrequest">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
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
<!-- Only Number for input fields -->
<script>
    function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);
        if (!(/[0-9]/.test(ch))) {
            evt.preventDefault();
        }
    }
</script>

<?php include('./includes/footer.php'); ?>