<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $module = htmlspecialchars($_POST['module']);
    $title = htmlspecialchars($_POST['title']);

    $fileTmpPath = htmlspecialchars($_FILES['module']['tmp_name']);
    $fileName = htmlspecialchars($_FILES['module']['name']);

    include '../classes/model.class.php';
    include '../classes/view.class.php';
    include '../classes/edit-module-control.php';

    $update = new EditModule($module, $title, $fileTmpPath, $fileName);

    var_dump($update->moduleAttr());


    //
} else {
    header('location: ../admin/EditModule.php');
    exit();
}
