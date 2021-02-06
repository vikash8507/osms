<?php

include('./dbconnection.php');

if (isset($_REQUEST['submit'])) {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];

    if (($name == '') || ($email == '') || ($subject == '') || ($message == '')) {
        $contact_error = "All fields are required!";
    } else {
        $sql = "INSERT INTO contact(c_name, c_email, c_subject, c_message) VALUES ('$name', '$email', '$subject', '$message')";
        if ($conn->query($sql) == TRUE) {
            $contact_msg = "Message send to administrator!";
        } else {
            $contact_error = "Error in sending contact!";
        }
    }
}

?>


<div class="col-md-8">
    <?php
    if (isset($contact_error)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error: </strong> <?php echo $contact_error; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php }
    if (isset($contact_msg)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success: </strong> <?php echo $contact_msg; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php }
    ?>
    <form action="" method="post">
        <input type="text" class="form-control" name="name" placeholder="Name"><br>
        <input type="text" class="form-control" name="subject" placeholder="Subject"><br>
        <input type="email" class="form-control" name="email" placeholder="E-mail"><br>
        <textarea class="form-control" name="message" placeholder="How can we help you?" style="height:150px;"></textarea><br>
        <input class="btn btn-primary" type="submit" value="Send" name="submit"><br><br>
    </form>
</div>