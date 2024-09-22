<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: ../RedCross.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="css/dashboard.css">
</head>


<body>
    <!-- header and container -->
    <?php include 'includes/admin.header.php'; ?>
    <section class="page-content">

        <h1>Module</h1>

        <?php
        include 'admin/EditModule.php';
        ?>

        <?php
        // include 'includes/widget.php';
        ?>

    </section>
</body>

</html>