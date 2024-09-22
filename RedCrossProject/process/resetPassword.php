<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo $_POST['new-password'];


    if (!isset($_POST['new-password'])) {
        header('location: ../ResetPassword.php???');
        exit();
    }
    if (!isset($_POST['confirm-password'])) {
        header('location: ../ResetPassword.php??');
        exit();
    }

    $newPassword = htmlspecialchars($_POST['new-password']);
    $confirmPassword = htmlspecialchars($_POST['confirm-password']);

    require '../classes/model.class.php';
    require '../classes/view.class.php';
    require '../classes/reset-password.class.php';

    $reset = new ControlResetPassword($newPassword, $confirmPassword);

    $reset->resetAttr();






    ///////////
} else {
    header('location: ../ResetPassword.php??????????');
    exit();
}
