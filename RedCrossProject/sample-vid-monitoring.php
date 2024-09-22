<?php


echo "here";







/////
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <video width="600" controls poster="poster.jpg" id="videoplayer">
        <source src="video/Rust.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>


</body>

<script>
    var video = document.getElementById('videoplayer');

    video.addEventListener('play', function() {
        // sendPlaybackData('play');
        console.log('play');
    });

    video.addEventListener('pause', function() {
        // sendPlaybackData('pause');
        console.log('pause');
    });

    video.addEventListener('ended', function() {
        // sendPlaybackData('ended');
        console.log('ended');
    });
</script>

</html>