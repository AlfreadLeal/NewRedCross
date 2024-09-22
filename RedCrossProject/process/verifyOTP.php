<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['ver-otp'])) {
        header('location: ../VerifyOTP.php');
        exit();
    }

    $otp = htmlspecialchars($_POST['ver-otp']);

    require '../classes/model.class.php';
    require '../classes/view.class.php';
    require '../classes/otp-control.class.php';

    $otp = new OTPProcess($otp);
    $otp->creatingAcc();



    // ?//?/?
} else {
    header('location: ../VerifyOTP.php');
    exit();
}
