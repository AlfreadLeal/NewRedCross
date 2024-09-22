<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {


    $module = htmlspecialchars($_POST['module']);

    echo 'here';


    include '../classes/model.class.php';
    include '../classes/view.class.php';
    include '../classes/delete-module-control.php';

    $delete = new DeleteModule($module);

    var_dump($delete->moduleAttr());





    //
} else {
    header('location: ../admin/AddModule.php');
    exit();
}
