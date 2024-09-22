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
        <div class="news-feed">
            <table class="table-feed">
                <tr>
                    <td class="news-feed">
                        <div class="header-news-content">
                            <h1>Title</h1>
                            <div class="date-time">1hr</div>

                        </div>
                        <div class="body-news-content">
                            sample data
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="news-feed">
                        <div class="header-news-content">
                            <h1>Title</h1>
                            <div class="date-time">1hr</div>

                        </div>
                        <div class="body-news-content">
                            sample data
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="news-feed">
                        <div class="header-news-content">
                            <h1>Title</h1>
                            <div class="date-time">1hr</div>

                        </div>
                        <div class="body-news-content">
                            sample data
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="news-feed">
                        <div class="header-news-content">
                            <h1>Title</h1>
                            <div class="date-time">1hr</div>

                        </div>
                        <div class="body-news-content">
                            sample data
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php
        include 'includes/widget.php';
        ?>

    </section>
</body>

</html>