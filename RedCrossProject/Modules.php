<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: ../RedCross.php');
    exit();
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modules</title>
    <link rel="stylesheet" href="css/module.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <?php include 'includes/header.php'; ?>
    <section class="page-content">




        <div class="news-feed"></div>

        <script>
            $(document).ready(function() {

                $.ajax({
                    url: 'ajax/modules.php',
                    success: function(modules) {
                        $('.news-feed').html(modules);
                    }
                });

            });
        </script>








        <?php
        include 'includes/widget.php';
        ?>

    </section>
</body>

<script src="javascript/list-item.js"></script>

</html>