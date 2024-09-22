<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['username'])) {
        header('location: ../RedCross.php?ijijusername');
        exit();
    }
    if (!isset($_POST['password'])) {
        header('location: ../RedCross.php?ijij');
        exit();
    }

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    require '../classes/model.class.php';
    require '../classes/view.class.php';
    require '../classes/login-control.class.php';

    $login = new ControlLogin($username, $password);

    var_dump($login->validateData());

    ///////
} else {
    header('location: ../RedCross.php?ijij');
    exit();
}
