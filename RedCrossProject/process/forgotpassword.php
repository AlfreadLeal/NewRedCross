<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['email'])) {
        header('location: ../Forgotpassword.php?okoko');
        exit();
    }

    $email = htmlspecialchars($_POST['email']);

    require '../classes/model.class.php';
    require '../classes/view.class.php';
    require '../classes/forgot-control.class.php';

    $forgot = new ControlForgot($email);


    $forgot->validateEmail();




    ///////
} else {
    header('location: ../Forgotpassword.php');
    exit();
}
