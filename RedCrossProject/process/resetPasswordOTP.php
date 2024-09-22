<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['otp'])) {
        header('location: ../ResetPasswordOTP.php');
        exit();
    }

    $otp = htmlspecialchars($_POST['otp']);

    require '../classes/model.class.php';
    require '../classes/view.class.php';
    require '../classes/otp-forgot-control.class.php';

    $otp = new ControlOTPForgot($otp);

    $otp->validateotp();







    ////////
} else {
    header('location: ../ResetPasswordOTP.php');
    exit();
}
