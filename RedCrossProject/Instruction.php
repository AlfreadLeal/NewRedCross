<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: ../RedCross.php');
    exit();
}

// echo $_SESSION['user_id'];
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
    <?php include 'includes/header.php'; ?>
    <section class="page-content">

        <?php include('quiz/Instruction.php'); ?>
    </section>
</body>

</html>