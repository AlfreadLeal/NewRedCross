<?php
if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    if (!isset($_POST['firstname'])) {
        header('location: ../Register.php');
        exit();
    }
    if (!isset($_POST['lastname'])) {
        header('location: ../Register.php');
        exit();
    }
    if (!isset($_POST['username'])) {
        header('location: ../Register.php');
        exit();
    }
    if (!isset($_POST['email'])) {
        header('location: ../Register.php');
        exit();
    }
    if (!isset($_POST['password'])) {
        header('location: ../Register.php');
        exit();
    }
    if (!isset($_POST['confirm-password'])) {
        header('location: ../Register.php');
        exit();
    }


    $fname = htmlspecialchars($_POST['firstname']);
    $lname = htmlspecialchars($_POST['lastname']);
    $uname = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirm-password']);



    // echo $confirmPassword;

    require '../classes/model.class.php';
    require '../classes/view.class.php';
    require '../classes/register-control.class.php';


    $data = new ControlRegister($fname, $lname, $uname, $email, $password, $confirmPassword);

    $data->validateData();




    // kjjkj
} else {
    header('location: ../Register.php');
    exit();
}
