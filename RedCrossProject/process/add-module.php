<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $title = htmlspecialchars($_POST['title']);

    $fileTmpPath = htmlspecialchars($_FILES['module']['tmp_name']);
    $fileName = htmlspecialchars($_FILES['module']['name']);

    include '../classes/model.class.php';
    include '../classes/view.class.php';
    include '../classes/add-module-control.php';

    $add = new AddModule($title, $fileTmpPath, $fileName);

    $add->moduleAttr();
} else {
    header('location: ../AddModule.php');
    exit();
}
