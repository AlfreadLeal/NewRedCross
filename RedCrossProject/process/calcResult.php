<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    session_start();
    unset($_SESSION['timer']);


    //
} else {
    header('location: ../Quiz.php');
}
